@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mesin | Mesinify</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/Logo.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('admin/header')

        {{-- Sidebar --}}
        @include('admin/sidebar')

        {{-- Content --}}
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mt-3" style="margin-left: 26px">
                        <h4>Data Mesin</h4>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row ml-4 mr-4">
                        <div class="col-12 ml-1 mr-1">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <a href="{{ route('data-mesin.create') }}" class="btn btn-md mb-0 mt-1"
                                        style="background-color: #FF9B50; color: #FFFFFF; border-radius: 10px;">Tambah
                                        Data</a>
                                </div>
                            </div>
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="myTable">
                                            <thead>
                                                <tr class="text">
                                                    <th scope="col">Nama Mesin</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Pelanggan</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Gambar Mesin</th>
                                                    <th scope="col">QR Code</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text">
                                                @forelse ($data_mesins as $data_mesin)
                                                    <tr>
                                                        <td>{{ $data_mesin->nama_mesin }}</td>
                                                        <td>{{ $data_mesin->brand_name }}</td>
                                                        <td>{{ $data_mesin->model }}</td>
                                                        <td>{{ $data_mesin->nama}}</td>
                                                        <td>{{ $data_mesin->deskripsi }}</td>
                                                        <td>
                                                            @if($data_mesin->image)
                                                                <img src="{{ asset('storage/images/' . $data_mesin->image) }}" alt="Gambar Mesin" style="width: 100px; height: auto;">
                                                            @else
                                                                Tidak ada gambar
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#qrModal{{ $data_mesin->id }}">
                                                                Lihat
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="qrModal{{ $data_mesin->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="ModalLabel{{ $data_mesin->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="ModalLabel{{ $data_mesin->id }}">QR
                                                                                Code {{ $data_mesin->nama_mesin }}</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            {!! $qrCode[$data_mesin->id] !!}
                                                                            <div class="mt-2">
                                                                                <a href="{{ route('data-mesin.downloadQr', $data_mesin->id) }}" class="btn btn-success">Download QR Code as PDF</a>
                                                                                <button onclick="printQrCode('{{ asset('qr_codes/' . $data_mesin->id . '.png') }}')" class="btn btn-secondary">Print QR Code</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <form
                                                                onsubmit="event.preventDefault(); confirmDelete(this);"
                                                                action="{{ route('data-mesin.destroy', $data_mesin->id) }}"
                                                                method="POST">
                                                                <a href="{{ route('data-mesin.edit', $data_mesin->id) }}"
                                                                    class="btn btn-sm btn-primary mt-1">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger mt-1">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Data Mesin belum
                                                            Tersedia.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Footer --}}
        @include('admin/footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('/lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/lte/dist/js/adminlte.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika pengguna mengkonfirmasi, kirim form
                }
            });
        }

        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true, // Untuk tampilan Previous, angka, dan Next
                "ordering": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "order": [
                    [0, 'asc'] // Mengurutkan berdasarkan kolom pertama (Nama Mesin)
                ],
            });

            // Force hapus teks "Search" jika masih muncul
            // $('.dataTables_filter label').contents().filter(function() {
            //     return this.nodeType === 3;
            // }).remove();
        });
    </script>

<script>
    function printQrCode(qrCodeUrl) {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print QR Code</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h1>QR Code</h1>');
        printWindow.document.write('<img src="' + qrCodeUrl + '" alt="QR Code" />');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

</body>

</html>
