@extends('layouts.main')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mesin | Pantau Mesin</title>
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
            {{-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row mt-3 " style="margin-left: 26px">
                        <h4>Data Mesin</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    {{-- <div class="mt-2" style="margin-left: 40px">
                        <a href="{{ route('jadwal.create') }}" class="btn btn-md mb-3"
                            style="background-color: #FF9B50; color: #FFFFFF; border-radius: 25px;">Tambah Data</a>
                    </div> --}}
                    <div class="row ml-4 mr-4">
                        <div class="col-md-6 form-group mt-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <h5>Jadwal Hari Ini</h5>
                                        <p>Rabu, 29 Oktober 2024</p>
                                    </div>

                                    <div class="sticky-top mb-2 external-event"
                                        style="background-color:#FF9B50; border-radius: 10px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            {{-- @forelse ($jadwals as $item)
                                                <td>{{ $item->nama_pemilik }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->tempat }}</td>
                                                <td>{{ $item->jenis_jasa }}</td>
                                            @empty
                                                <div class="alert alert-danger">
                                                    Data Mesin belum Tersedia.
                                                </div>
                                            @endforelse --}}
                                            <div>
                                                <span class="name"
                                                    style="margin-left: 7px; font-size: 17px font-weight: normal;">Radiman</span>
                                                <span class="phone-number"
                                                    style="font-weight: normal; font-size: 14px">+62
                                                    8123456789</span>
                                            </div>
                                            <div class="dropdown">
                                                <a class="" href="#" role="button" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" style="color: white"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="?cs=Edit-Jadwal">
                                                        <span class="text-primary">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </span>
                                                    </a>
                                                    <a class="dropdown-item" href="?cs=Hapus-Jadwal">
                                                        <span class="text-danger">
                                                            <i class="fas fa-trash"></i>
                                                            Hapus
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; display: flex; flex-direction: column;">
                                            <p><span style="margin-left: 7px; font-size: 14px">AC
                                                    Midea</span><span
                                                    style="margin-left: 80px; font-size: 14px">Perawatan</span>
                                            </p>
                                            <p><span style="margin-left: 7px; font-size: 14px">MSAF-05CRN2</span><span
                                                    style="margin-left: 42px; font-size: 14px">Jl. Kartini no 10
                                                    Sidoarjo</span></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <h5>Kalender</h5>
                                </div>

                            </div>
                            <div class="card border-0 mt-2"
                                style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <h5>Buat Jadwal</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-3">
                                        <img src="/img/gambarJ.png" alt="" class="img-fluid ml-5">
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                        <div>
                                            <b>
                                                <h5 class="text-center">BUAT JADWAL <br> SERVIS ANDA!</h>
                                            </b>

                                        </div>
                                        <div class="mt-4 text-center">
                                            <a href="{{ route('jadwal.create') }}" class="btn btn-success btn-md mb-3"
                                                style=" color: #FFFFFF; border-radius: 25px;">Tambah
                                                Data</a>
                                        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
