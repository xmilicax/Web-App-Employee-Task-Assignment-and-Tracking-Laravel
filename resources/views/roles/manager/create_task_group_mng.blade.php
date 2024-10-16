@extends('dashboard')

@section('title')
    <title>Rukovodilac odeljenja - Kreiranje grupe zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Kreiranje grupe zadataka</h1>
@endsection

@section('content')
    <form action="{{ route('create_task_group_mng') }}" method="POST">
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
        <button type="submit" class="button">Kreiraj grupu zadataka</button>
    </form>
@endsection
