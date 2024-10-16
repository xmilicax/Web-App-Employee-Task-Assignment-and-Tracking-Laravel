@extends('dashboard')

@section('title')
    <title>Admin - Izmena komentara</title>
@endsection

@section('naslov_stranice')
    <h1>Izmena komentara</h1>
@endsection

@section('content')
    <form action="{{ route('update_comment_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif

            <label for="id">Odaberi komentar za izmenu:</label>
            <select name="id" id="id" required>
                <option value="">Odaberi komentar</option>
                @foreach ($comments as $comment)
                    <option value="{{ $comment->id }}">{{ $comment->content }}</option>
                @endforeach
            </select>

            <br><br>
            @error('id')
                <div class="status_greska">{{ $message }}</div>
            @enderror

            <br>
            <label for="content">Novi sadržaj komentara:</label>
            <input type="text" name="content" id="content"  required>
            @error('content')
                <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Izmeni komentar</button>
    </form>

@endsection
