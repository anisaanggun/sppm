
@extends('layouts.main')
<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>
@section('contents')
    <div class="container">
        <h2>Selamat Datang Teknisi</h2>
        <form action="/logout" method="post">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </div>
@endsection