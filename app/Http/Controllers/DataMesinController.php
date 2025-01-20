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

        public function downloadQr($id)
    {
        // Ambil data mesin berdasarkan ID
        $data_mesin = DataMesin::findOrFail($id);

        // Buat URL untuk QR Code
        $url = route('data-mesin.detail', $data_mesin->id);
        $dataToEncode = $url;

        // Generate QR Code dalam format SVG
        $qrCodeSvg = QrCode::size(300)->generate($dataToEncode);

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
        $html .= 'h1 { text-align: center; margin: 0; font-size: 25px; color: #333; }'; // Penataan h1
        $html .= 'div.qr-code-container { margin-top: 20px; }'; // Memberikan jarak antara teks dan QR Code
        $html .= '</style></head><body>';
        $html .= '<h1>QR Code ' . $data_mesin->nama_mesin . '</h1>';
        $html .= '<div class="qr-code-container">';
        $html .= '<img src="data:image/svg+xml;base64,' . base64_encode($qrCodeSvg) . '" style="width: 300px; height: 300px;" />';
        $html .= '</div>';
        $html .= '</body></html>';

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas menjadi ukuran kustom (misalnya 5x5 cm)
        $dompdf->setPaper([0, 40, 500, 500], 'portrait'); // [x0, y0, x1, y1] dalam satuan poin

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        return $dompdf->stream('qr_code_' . $data_mesin->id . '.pdf');
    }


    public function create(): View
    {
        //Daftar brand_name untuk select
        $brands = Brand::get();
        $data_pelanggans = DataPelanggan::where('user_id', Auth::user()->id)->get();

        return view('admin.datamesin.create', compact('brands', 'data_pelanggans'));
    }

    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
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
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'deskripsi.nullable' => 'Silahkan masukkan deskripsi',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());


        //create data mesin
        DataMesin::create([
            'user_id' => Auth::user()->id,
            'nama_mesin' => $request->nama_mesin,
            'brand_id' => $request->brand_id,
            'model' => $request->model,
            'pemilik_id' => $request->pemilik_id,
            'deskripsi' => $request->deskripsi,
            'image' => $image->hashName(),

        ]);

        $selectednama_mesin = $request->input('nama_mesin');
        session()->flash('selectednama_mesin', $request->nama_mesin);

        return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' berhasil ditambahkan!');
    }

    public function edit(string $id): View
    {
        $data_mesins = DataMesin::findOrFail($id);
        $brands = Brand::get();
        $data_pelanggans = DataPelanggan::where('user_id', Auth::user()->id)->get();


        return view('admin.datamesin.edit', compact('data_mesins', 'brands', 'data_pelanggans'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_mesin' => 'required|string',
            'brand_id' => 'required',
            'model' => 'required|string',
            'pemilik_id' => 'required',
            'deskripsi' => 'nullable|string',
            'image' => 'image|mimes:jpeg,jpg,png|max:1999',
        ], [
            'nama_mesin.required' => 'Silahkan pilih setidaknya satu nama mesin.',
            'brand_id.required' => 'Silahkan pilih nama brand mesin.',
            'model.required' => 'Silahkan pilih nama model mesin.',
            'pemilik_id.required' => 'Silahkan masukkan nama pelanggan.',
            'deskripsi.nullable' => 'Silahkan masukan deskripsi',
        ]);

        $data_mesins = DataMesin::findOrFail($id);

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

    $selectednama_mesin = $request->input('nama_mesin');
    session()->flash('selectednama_mesin', $request->nama_mesin);

    return redirect()->route('data-mesin.index')->with('success', 'Data mesin  ' . $selectednama_mesin . ' berhasil diubah!');
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
        return view('admin.data-mesin.detail', compact('data_mesin'));
    }

    public function export_excel()
    {
        // $data_mesins = DataMesin::where('user_id', Auth::user()->id)->get();
        $data_mesins = DataMesin::with(['pemilik', 'brand'])
        ->where('user_id', Auth::user()->id)
        ->get();

        return Excel::download(new DataMesinExport($data_mesins), 'data_mesins.xlsx');
    }
}
