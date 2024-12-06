@extends('layouts.main')

@section('contents')
    <div class="d-flex justify-content-center align-items-center vh-100" style="padding-top: 5px;">
        <div class="card  p-3 mb-5 bg-body-tertiary rounded"
            style="overflow-y:auto; border: 2px solid #1E56A0; border-radius:15px !important;">

            {{-- <div class="card-header text-center">
              Login
            </div> --}}

            <div style="text-align:center;" style="padding:20px;">
                <img src="/img/Logo.png" alt="" style="width: 50px; height:auto; margin-top:5px;">
                <b>
                    <p style="color: #1E56A0;">Daftar</p>
                </b>
            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form method="post" action="{{ route('daftar-proses') }}" style="max-width: 300px; margin:auto;">
                    @csrf
                    <div class="mb-3">

                        {{-- <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"> --}}

                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Nama" aria-label="nama" id="nama" style="border-radius: 8px;">

                        @error('nama')
                            <div class="invalid-feedback">
                                <p>Masukan nama anda</p>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        {{-- <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"> --}}

                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" aria-label="email" id="email" style="border-radius: 8px;">

                        @error('email')
                            <div class="invalid-feedback">
                                Masukkan email anda
                            </div>
                        @enderror
                    </div>



                    <div class="mb-3">

                        {{-- <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"> --}}

                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" aria-label="password" id="password" style="border-radius: 8px;">

                        @error('password')
                            <div class="invalid-feedback">
                                Masukkan password
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        {{-- <label for="no.hp" class="form-label">No.Hp</label>
                        <input type="no.hp" name="no.hp" class="form-control @error('no.hp') is-invalid @enderror" id="no.hp"> --}}

                        <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                            placeholder="No.Hp" aria-label="no_hp" id="no_hp" style="border-radius: 8px;">

                        @error('no_hp')
                            <div class="invalid-feedback">
                                Masukan no hp anda
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2" style="margin-top: 10px;">
                        <button type="submit" class="btn"
                            style="border-radius: 25px; background-color: #1E56A0; color: white; border: none;">Daftar</button>
                    </div>

                    <div style="margin-top: 20px; text-align:center;">
                        <p>
                            Sudah mempunyai akun?<b><a style="text-decoration: none;"
                                    href="{{ route('login') }}">Masuk</a></b>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
