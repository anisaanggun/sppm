@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Perawatan | Pantau Mesin</title>
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

    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('admin/header')

        {{-- Sidebar --}}
        @include('admin/sidebar')

        {{-- Content --}}


        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mt-3 " style="margin-left: 26px">
                        <h4>Data Perawatan</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
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
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('data-perawatan.create') }}" class="btn btn-md mb-0 mt-1"
                                                style="background-color: #FF9B50; color: #FFFFFF; border-radius: 10px;">Tambah
                                                Data
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <div class="search-container mb-3" style="float: right">
                                                <input type="text" placeholder="Cari..." class="search-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr class="text">
                                                    <th scope="col">Pemilik</th>
                                                    <th scope="col">Nama Mesin</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Teknisi</th>
                                                    <th scope="col">Aktivitas</th>
                                                    <th scope="col">Catatan</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text">
                                                @forelse ($data_perawatans as $data_perawatan)
                                                    <tr>
                                                        <td>{{ $data_perawatan->pemilik }}</td>
                                                        <td>{{ $data_perawatan->nama_mesin }}</td>
                                                        <td>{{ $data_perawatan->tanggal_perawatan }}</td>
                                                        <td>{{ $data_perawatan->teknisi }}</td>
                                                        <td>{{ $data_perawatan->aktivitas }}</td>
                                                        <td>{{ $data_perawatan->catatan }}</td>
                                                        <td>
                                                            <form
                                                                onsubmit="event.preventDefault(); confirmDelete(this);"
                                                                action="{{ route('data-perawatan.destroy', $data_perawatan->id) }}"
                                                                method="POST">
                                                                <a href="{{ route('data-perawatan.edit', $data_perawatan->id) }}"
                                                                    class="btn btn-sm btn-primary mt-1">
                                                                    <i class="fa-solid fa-pen-to-square"></i></a>
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
                                                    <div class="alert alert-danger">
                                                        Data Perawatan belum Tersedia.
                                                    </div>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    @foreach ($data_perawatans as $data_perawatan)
                                    @endforeach
                                    {{ $data_perawatans->links('pagination::bootstrap-5') }}
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

    <script src="/https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
    </script>

</body>

</html>
