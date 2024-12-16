@extends('layouts.main')

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Pribadi | Pantau Mesin</title>
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
    <!-- Font Iconify Icons -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <div class="row mt-3 " style="margin-left: 28px">
                        <h4>Edit Data Pribadi</h4>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container mt-3 mb-3">
                        <div class="row ml-3 mr-3">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card border-0"
                                    style="border-radius: 15px !important; box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);">
                                    <div class="card-body">
                                        <form action="{{ route('profil.update', Auth::user()) }}" method="POST"
                                            enctype="multipart/form-data" class="needs-validation" novalidate>
                                            @method('PUT')
                                            <div class="container mt-2">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Nama</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', Auth::user()->name) }}"
                                                            placeholder="">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Alamat</label>
                                                        <input type="text" class="form-control" name="alamat"
                                                            placeholder="Masukan alamat anda"
                                                            value="{{ old('alamat', Auth::user()->alamat) }}">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">E-mail</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ old('email', Auth::user()->email) }}"
                                                            placeholder="">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">No HP</label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                                            placeholder="">
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Password Lama</label>
                                                        <div class="password-wrapper">
                                                            <input type="password" id="passLama" class="form-control"
                                                                name="password"
                                                                value="{{ old('password', Auth::user()->ulangi_password) }}"><i
                                                                id="eyeIconLama" class="fa fa-eye password-icon"
                                                                onclick="showPass()"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-3">
                                                        <label class="font-weight-bold">Password Baru</label>
                                                        <div class="password-wrapper">
                                                            <input type="password" id="passBaru" class="form-control"
                                                                name="password_baru" value="">
                                                            <i id="eyeIconBaru" class="fa fa-eye password-icon"
                                                                onclick="showPassBaru()"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-right mt-3 mb-3">
                                                        <button type="submit" class="btn btn-md btn-success"
                                                            onclick="showSuccessMessage()">Edit</button>
                                                        <a href="{{ url('/beranda') }}"
                                                            class="btn btn-md btn-danger">Batal</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <script>
        function showPass() {
            const passwordInput = document.getElementById('passLama');
            const eyeIcon = document.getElementById('eyeIconLama');

            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            eyeIcon.classList.toggle('fa-eye'); // Ganti ikon mata terbuka
            eyeIcon.classList.toggle('fa-eye-slash'); // Ganti ikon mata tertutup
        }
    </script>
    <script>
        function showPassBaru() {
            const passwordInput = document.getElementById('passBaru');
            const eyeIcon = document.getElementById('eyeIconBaru');

            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            eyeIcon.classList.toggle('fa-eye'); // Ganti ikon mata terbuka
            eyeIcon.classList.toggle('fa-eye-slash'); // Ganti ikon mata tertutup
        }
    </script>
    <script>
        function showSuccessMessage() {
            Swal.fire({
                title: 'Sukses!',
                text: 'Data telah berhasil diubah.',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#FF9B50'
            });
        }
    </script>
</body>

</html>
