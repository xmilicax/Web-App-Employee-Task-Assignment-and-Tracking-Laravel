@extends('dashboard')

@section('title')
    <title>Admin - Kreiranje tipa korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Kreiranje tipa korisnika</h1>
@endsection

@section('content')
    <form action="{{ route('create_user_type_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif
            <br>
            <label for="user_type">Naziv tipa korisnika:</label>
            <input type="text" name="user_type" id="user_type" class="form-control" required>

            @error('name')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Kreiraj tip korisnika</button>
    </form>
@endsection
