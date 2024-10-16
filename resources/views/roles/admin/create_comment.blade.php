@extends('dashboard')

@section('title')
    <title>Admin - Kreiranje grupe zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Napravi komentar</h1>
@endsection

@section('content')
    <form action="{{ route('create_comment_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif
            <br>

            <label for="task_id">Zadatak na kom želite ostaviti komentar:</label>
                <select name="task_id" id="task_id" required>
                    <option value="">Odaberi zadatak</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->title }} (ID: {{ $task->id }}) </option>
                    @endforeach
                </select>

            <label for="content">Sadržaj komentara:</label>
            <input type="text" name="content" id="content" class="form-control" required>

            @error('name')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Napravi komentar</button>
    </form>
@endsection
