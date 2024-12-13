@extends('layouts.main')

@section('contents')
    <div class="d-flex justify-content-center align-items-center vh-100" style="padding-top: 5px;">
        <div class="card  p-3 mb-5 bg-body-tertiary"
            style="overflow-y:auto; border: 2px solid #1E56A0; border-radius:15px !important;">

            {{-- <div class="card-header text-center">
              Login
            </div> --}}
            <div style="text-align:center; padding: 20px;">
                <img src="{{ asset('/img/Logo.png') }}" alt="" style="width: 50px; height:auto; margin-top:5px;">
                <b>
                    <p style="color: #1E56A0;">Masuk</p>
                </b>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <form action="{{ route('dologin') }}" method="post">
                            @csrf

                            <div class="mb-3">

                                {{-- <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"> --}}

                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    aria-label="email" id="email" style="border-radius: 8px;">

                                @error('email')
                                    <div class="invalid-feedback">
                                        <p>Masukan email anda</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">

                                {{-- <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"> --}}

                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    aria-label="password" id="password" style="border-radius: 8px;">

                                @error('password')
                                    <div class="invalid-feedback">
                                        <p>Masukan password anda</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2" style="margin-top: 20px;">
                                <button type="submit" class="btn"
                                    style="border-radius: 25px; background-color: #1E56A0; color: white; border: none;">Masuk</button>
                            </div>

                            <div style="margin-top: 20px; text-align:center;">
                                <p>
                                    Belum mempunyai akun?<b><a style="text-decoration:none;"
                                            href="{{ route('daftar') }}">Daftar</a></b>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
