@extends('dashboard')

@section('title')
    <title>Admin - Izmena tipa korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Izmena tipa korisnika</h1>
@endsection

@section('content')
    <form action="{{ route('update_user_type_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif

            <label for="id">ID tipa korisnika za izmenu:</label>
            <select name="id" id="id" required>
                <option value="">Odaberi tip korisnika</option>
                @foreach ($user_types as $user_type)
                    <option value="{{ $user_type->id }}">{{ $user_type->user_type }}</option>
                @endforeach
            </select>

            <br><br>
            @error('id')
            <div class="status_greska">{{ $message }}</div>
            @enderror

            <br>
            <label for="user_type">Novi naziv tipa korisnika:</label>
            <input type="text" name="user_type" id="user_type"  required>

            @error('name')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Izmeni grupu zadataka</button>
    </form>

@endsection
