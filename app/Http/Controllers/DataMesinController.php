<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DataMesin;
use App\Models\Brand;
use App\Models\DataPelanggan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exports\DataMesinExport;
use Maatwebsite\Excel\Facades\Excel;

class DataMesinController extends Controller
{
    public function index(Request $request): View
    {
        if (Auth::check()) {
            // Ambil role user yang sedang login
            $role_id = Auth::user()->role_id;

            // Jika role_id adalah 2 (admin), ambil semua pelanggan
            if ($role_id == 2) {
                $query = DataMesin::select('data_mesins.*', 'brands.brand_name', 'data_pelanggans.nama', 'users.name')
                ->leftJoin('brands', 'brand_id', '=', 'brands.id')
                ->leftJoin('data_pelanggans', 'pemilik_id', '=', 'data_pelanggans.id')
                ->leftJoin('users', 'data_mesins.user_id', '=', 'users.id');

                $data_mesins = $query->get();
                // dd($data_mesins); 
                // Array untuk menyimpan QR Code
                $qrCode = [];

                // Generate QR Code untuk setiap mesin
                foreach ($data_mesins as &$data_mesin) {
                    $data_mesin->url = route('data-mesin.detail', $data_mesin->id); // Pastikan route ini ada
                    $dataToEncode = $data_mesin->url;

                    $data_mesin->qr_code = QrCode::size(300)->generate($dataToEncode);
                    $data_mesin->svg = base64_encode($data_mesin->qr_code);
                }

                // dd($data_mesins);
                return view('admin.datamesin.data-mesin_admin', compact('data_mesins'));
            }
            // Jika role_id adalah 1 (user biasa), ambil pelanggan berdasarkan user_id
            elseif ($role_id == 1) {
                $query = DataMesin::select('data_mesins.*', 'brands.brand_name', 'data_pelanggans.nama')
                    ->leftJoin('brands', 'brand_id', '=', 'brands.id')
                    ->leftJoin('data_pelanggans', 'pemilik_id', '=', 'data_pelanggans.id')
                    ->where('data_mesins.user_id', Auth::user()->id);

                $data_mesins = $query->get();

                // Array untuk menyimpan QR Code
                $qrCode = [];

                // Generate QR Code untuk setiap mesin
                foreach ($data_mesins as &$data_mesin) {
                    $data_mesin->url = route('data-mesin.detail', $data_mesin->id); // Pastikan route ini ada
                    $dataToEncode = $data_mesin->url;

                    $data_mesin->qr_code = QrCode::size(300)->generate($dataToEncode);
                    $data_mesin->svg = base64_encode($data_mesin->qr_code);
                }

                // dd($data_mesins);
                return view('admin.datamesin.data-mesin', compact('data_mesins'));
            }
        }
        
    }

    public function downloadQr($id)
    {
        // Ambil data mesin berdasarkan ID
        $data_mesin = DataMesin::findOrFail($id);

        // Buat URL untuk QR Code
        $url = route('data-mesin.detail', $data_mesin->id);
        $dataToEncode = $url;

        // Generate QR Code dalam format SVG
        $qrCodeSvg = QrCode::size(88)  // Mengatur ukuran QR Code menjadi lebih kecil (150px)
                        ->margin(1)  // Mengurangi margin untuk mengecilkan canvas
                        ->generate($dataToEncode);

        // Simpan QR Code sebagai file SVG
        $fileName = 'qr_code_' . $data_mesin->id . '.svg';
        // $path = public_path('storage/qr_codes/' . $fileName);

        //  // Simpan SVG ke file
        // if (file_put_contents($path, $qrCodeSvg) === false) {
        //     return response()->json(['error' => 'Gagal menyimpan QR Code.'], 500);
        // }

        // // Cek apakah file berhasil disimpan
        // if (!file_exists($path)) {
        //     return response()->json(['error' => 'QR Code tidak ditemukan di path: ' . $path], 404);
        // }

        // Buat instance Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Buat HTML untuk PDF
        $html = '<html><head><style>';
        $html .= 'body { font-family: Arial, sans-serif; text-align: center; }';
        $html .= 'h1 { text-align: center; margin: 0; font-size: 18px; color: #333; }'; // Penataan h1
        $html .= 'div.qr-code-container { margin-top: 10px; }'; // Memberikan jarak antara teks dan QR Code
        $html .= '</style></head><body>';
        $html .= '<h1>QR Code ' . $data_mesin->nama_mesin . '</h1>';
        $html .= '<div class="qr-code-container">';
        $html .= '<img src="data:image/svg+xml;base64,' . base64_encode($qrCodeSvg) . '" style="width: 210px; height: 210px;" />';
        $html .= '</div>';
        $html .= '</body></html>';

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas menjadi ukuran kustom (misalnya 5x5 cm)
        $dompdf->setPaper([0, 0, 295, 255], 'portrait'); // [x0, y0, x1, y1] dalam satuan poin

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        return $dompdf->stream('qr_code_' . $data_mesin->id . '.pdf');
    }


    public function create(): View
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            if ($role_id == 2) {
                // Ambil semua pelanggan atau teknisi untuk admin
                $brands = Brand::get();
                $teknisis = User::where('role_id', 1)->get();
                $data_pelanggans = DataPelanggan::get();


                return view('admin.datamesin.create_admin', compact('brands', 'teknisis', 'data_pelanggans'));

            } elseif ($role_id == 1) {
                //Daftar brand_name untuk select
                $brands = Brand::get();
                $data_pelanggans = DataPelanggan::where('user_id', Auth::user()->id)->get();

                return view('admin.datamesin.create', compact('brands', 'data_pelanggans'));
            }
        }
        
    }

    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // validasi form
            $validatedData = $request->validate([
                'nama_mesin' => 'required|string',
                'brand_id' => 'required',
                'model' => 'required|string',
                'pemilik_id' => 'required',
                'deskripsi' => 'nullable|string',
                'image' => 'image|mimes:jpeg,jpg,png|max:1999',
            ], [
                'brand_id.required' => 'Silahkan pilih nama brand mesin.',
                'nama_mesin.required' => 'Silahkan masukkan nama mesin.',
                'model.required' => 'Silahkan pilih nama model mesin.',
                'pemilik_id.required' => 'Silahkan pilih nama pelanggan.',
                'deskripsi.nullable' => 'Silahkan masukkan deskripsi',
            ]);

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());

            // Proses data sesuai dengan role_id
            if ($role_id == 2) {
                // Jika admin (role_id == 2), ambil user_id dari request
                //create data mesin
                DataMesin::create([
                    'user_id' => $request->user_id,
                    'nama_mesin' => $validatedData['nama_mesin'],
                    'brand_id' => $validatedData['brand_id'],
                    'model' => $validatedData['model'],
                    'pemilik_id' => $validatedData['pemilik_id'],
                    'deskripsi' => $validatedData['deskripsi'],
                    'image' => $image->hashName(),
                ]);

                return redirect()->route('data-mesin_admin.index')->with('success', 'Data mesin baru berhasil ditambahkan!');

            } elseif ($role_id == 1) {
                // Jika user (role_id == 1), gunakan Auth::user()->id untuk user_id
                DataMesin::create([
                    'user_id' => Auth::user()->id,
                    'nama_mesin' => $validatedData['nama_mesin'],
                    'brand_id' => $validatedData['brand_id'],
                    'model' => $validatedData['model'],
                    'pemilik_id' => $validatedData['pemilik_id'],
                    'deskripsi' => $validatedData['deskripsi'],
                    'image' => $image->hashName(),
                ]);

                return redirect()->route('data-mesin.index')->with('success', 'Data mesin baru berhasil ditambahkan!');
            }
        }
    }

    public function edit(string $id): View
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
    
            if ($role_id == 2) {
                $data_mesins = DataMesin::findOrFail($id);

                $brands = Brand::get();
                $teknisis = User::where('role_id', 1)->get();
                $data_pelanggans = DataPelanggan::get();


                return view('admin.datamesin.edit_admin', compact('data_mesins', 'brands', 'teknisis', 'data_pelanggans'));

            } elseif ($role_id == 1) {
                $data_mesins = DataMesin::findOrFail($id);

                $brands = Brand::get();
                $data_pelanggans = DataPelanggan::where('user_id', Auth::user()->id)->get();


                return view('admin.datamesin.edit', compact('data_mesins', 'brands', 'data_pelanggans'));
            }
        }
        
        
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // validasi form
            $validatedData = $request->validate([
                'nama_mesin' => 'required|string',
                'brand_id' => 'required',
                'model' => 'required|string',
                'pemilik_id' => 'required',
                'deskripsi' => 'nullable|string',
                'image' => 'image|mimes:jpeg,jpg,png|max:1999',
            ], [
                'brand_id.required' => 'Silahkan pilih nama brand mesin.',
                'nama_mesin.required' => 'Silahkan masukkan nama mesin.',
                'model.required' => 'Silahkan pilih nama model mesin.',
                'pemilik_id.required' => 'Silahkan pilih nama pelanggan.',
                'deskripsi.nullable' => 'Silahkan masukkan deskripsi',
            ]);

            $data_mesins = DataMesin::findOrFail($id);

            if ($role_id == 2) {
                

                //check if image is uploaded
                if ($request->hasFile('image')) {
        
                    //upload new image
                    $image = $request->file('image');
                    $image->storeAs('public/images', $image->hashName());
        
                    //delete old image
                    Storage::delete('public/images/'.$data_mesins->image);
        
        
                    $data_mesins->update([
                        'user_id' => $request->user_id,
                        'nama_mesin' => $request->nama_mesin,
                        'brand_id' => $request->brand_id,
                        'model' => $request->model,
                        'pemilik_id' => $request->pemilik_id,
                        'deskripsi' => $request->deskripsi,
                        'image'     => $image->hashName(),
                    ]);
        
                } else {
        
                    $data_mesins->update([
                        'user_id' => $request->user_id,
                        'nama_mesin' => $request->nama_mesin,
                        'brand_id' => $request->brand_id,
                        'model' => $request->model,
                        'pemilik_id' => $request->pemilik_id,
                        'deskripsi' => $request->deskripsi,
                    ]);
                }
        
                return redirect()->route('data-mesin_admin.index')->with('success', 'Data mesin berhasil diubah!');
            
            } elseif ($role_id == 1) {
                

                //check if image is uploaded
                if ($request->hasFile('image')) {
        
                    //upload new image
                    $image = $request->file('image');
                    $image->storeAs('public/images', $image->hashName());
        
                    //delete old image
                    Storage::delete('public/images/'.$data_mesins->image);
        
        
                    $data_mesins->update([
                        'nama_mesin' => $request->nama_mesin,
                        'brand_id' => $request->brand_id,
                        'model' => $request->model,
                        'pemilik_id' => $request->pemilik_id,
                        'deskripsi' => $request->deskripsi,
                        'image'     => $image->hashName(),
                    ]);
        
                } else {
        
                    $data_mesins->update([
                        'nama_mesin' => $request->nama_mesin,
                        'brand_id' => $request->brand_id,
                        'model' => $request->model,
                        'pemilik_id' => $request->pemilik_id,
                        'deskripsi' => $request->deskripsi,
                    ]);
                }
        
            return redirect()->route('data-mesin.index')->with('success', 'Data mesin berhasil diubah!');
            }
        }
    }

    public function destroy($id): RedirectResponse
    {
        $data_mesins = DataMesin::findOrFail($id);

        Storage::delete('public/images/' . $data_mesins->image);

        $data_mesins->delete();

        return redirect()->route('data-mesin.store')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->input('cari');
    //     $data_mesins = DataMesin::where('nama_mesin', 'like', "%" . $keyword . "%")->paginate(10);

    //     return view('admin.datamesin.data-mesin', compact('data_mesins'));
    // }

    public function detail($id)
    {
        $data_mesin = DataMesin::with('brand')->findOrFail($id);
        return view('admin.datamesin.detail', compact('data_mesin'));
    }

    public function export_excel()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Ambil role_id dari pengguna yang sedang login
            $role_id = Auth::user()->role_id;

            if ($role_id == 2) {
                // Jika role adalah admin (role_id == 2), ambil semua data pelanggan
                $data_mesins = DataMesin::with(['pemilik', 'brand', 'user'])
                ->get();
            } elseif ($role_id == 1) {
                // $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();
                $data_mesins = DataMesin::with(['pemilik', 'brand'])
                ->where('user_id', Auth::user()->id)
                ->get();
            }

            // Mengunduh file Excel
            return Excel::download(new DataMesinExport($data_mesins), 'data_mesins.xlsx');
            
        }
    }
    
    public function getMesins($pemilik_id)
    {
        $mesins = DataMesin::where('pemilik_id', $pemilik_id)->get();

        return response()->json($mesins);
        
    }

    public function getTeknisiByMesin($mesin_id)
    {
        $mesin = DataMesin::with('user')->find($mesin_id); 

        if ($mesin && $mesin->user) {
            return response()->json($mesin->user);
        }

        return response()->json(null); 
    }
}
