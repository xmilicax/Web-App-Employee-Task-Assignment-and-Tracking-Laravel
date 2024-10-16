@extends('dashboard')

@section('title')
    <title>Admin - Izmena korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Izmena korisnika</h1>
@endsection

@section('content')
    <form action="{{ route('pre_update_user_admin') }}" method="POST">
        @csrf
        <div>
            <label for="user_id">Odaberite korisnika kojeg želite da izmenite:</label>
            <select name="user_id" id="user_id" required>
                <option value="">Odaberi korisnika</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }}) </option>
                @endforeach
            </select>

            <br><br>
            @error('user_id')
            <div class="status_greska">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button">Sledeći korak</button>
    </form>

@endsection
