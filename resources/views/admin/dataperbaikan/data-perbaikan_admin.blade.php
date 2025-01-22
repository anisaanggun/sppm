@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Perbaikan | Mesinify</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                        <h4>Data Perbaikan</h4>
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
                            <div class="row g-1">
                                <div class="col-auto mb-3">
                                    <a href="{{ route('data-perbaikan_admin.create') }}" class="btn btn-md mb-0 mt-1"
                                        style="background-color: #FF9B50; color: #FFFFFF; border-radius: 10px;">Tambah
                                        Data</a>
                                </div>
                                <div class="col-auto mb-3">
                                    <a href="{{ route('data-perbaikan.export_excel') }}"
                                        class="btn btn-success btn-md mb-0 mt-1" style="border-radius: 10px;"
                                        target="_blank">Export Excel</a>
                                </div>
                            </div>
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="dataPerbaikanTable">
                                            <thead>
                                                <tr class="text">
                                                    <th scope="col">Pelanggan</th>
                                                    <th scope="col">Nama Mesin</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Kerusakan</th>
                                                    <th scope="col">Catatan</th>
                                                    <th scope="col">Status Perbaikan</th>
                                                    <th scope="col">Teknisi</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text">
                                                @forelse ($data_perbaikans as $data_perbaikan)
                                                    <tr>
                                                        <td>{{ $data_perbaikan->nama }}</td>
                                                        <td>{{ $data_perbaikan->nama_mesin }}</td>
                                                        <td>{{ $data_perbaikan->tanggal }}</td>
                                                        <td>{{ $data_perbaikan->kerusakan }}</td>
                                                        <td>{{ $data_perbaikan->catatan }}</td>
                                                        <td>
                                                            @php
                                                                $statusClasses = [
                                                                    3 => [
                                                                        'class' => 'badge-secondary',
                                                                        'text' => 'Pending',
                                                                    ],
                                                                    2 => [
                                                                        'class' => 'badge-primary',
                                                                        'text' => 'Diproses',
                                                                    ],
                                                                    1 => [
                                                                        'class' => 'badge-success',
                                                                        'text' => 'Selesai',
                                                                    ],
                                                                ];

                                                                $status = $statusClasses[
                                                                    $data_perbaikan->status_perbaikan
                                                                ] ?? [
                                                                    'class' => 'badge-light',
                                                                    'text' => 'Status tidak diketahui',
                                                                ];
                                                            @endphp
                                                            <span
                                                                class="badge {{ $status['class'] }}">{{ $status['text'] }}</span>
                                                        </td>
                                                        <td>{{ $data_perbaikan->user->name }}</td>
                                                        <td>
                                                            <form
                                                                onsubmit="event.preventDefault(); confirmDelete(this);"
                                                                action="{{ route('data-perbaikan.destroy', $data_perbaikan->id) }}"
                                                                method="POST">
                                                                <a href="{{ route('data-perbaikan.edit', $data_perbaikan->id) }}"
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
                                                        <td colspan="8" class="text-center">Data Perbaikan belum
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
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
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
            DataTable.ext.errMode = 'none';
            $('#dataPerbaikanTable').DataTable({
                "paging": true, // Untuk tampilan Previous, angka, dan Next
                "ordering": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "order": [
                    [2, 'desc'] // Mengurutkan berdasarkan kolom Tanggal (indeks 2)
                ],
            });
        });
    </script>

</body>

</html>
