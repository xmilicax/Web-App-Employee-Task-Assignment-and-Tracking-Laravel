@extends('dashboard')

@section('title')
    <title>Admin - Napravi grupu zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Napravi grupu zadataka</h1>
@endsection

@section('content')
    <form action="{{ route('create_task_group_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif
            <br>
            <label for="name">Naziv grupe:</label>
            <input type="text" name="name" id="name" class="form-control" required>

            @error('name')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Napravi grupu zadataka</button>
    </form>
@endsection
