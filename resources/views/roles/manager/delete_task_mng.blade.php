@extends('dashboard')

@section('title')
    <title>Rukovodilac odeljenja - Brisanje zadatka</title>
@endsection

@section('naslov_stranice')
    <h1>Brisanje zadatka</h1>
@endsection

@section('content')
    <form action="{{ route('delete_task_mng') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif
            <br>

            <label for="task_id">Odaberite zadatak za brisanje:</label>
                <select name="task_id" id="task_id" required>
                    <option value="">Odaberi zadatak</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->title }} (ID: {{ $task->id }})</option>
                    @endforeach
                </select>

            <br>
            @error('id')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br><br>

        </div>
        <button type="submit" class="button">Izbriši zadatak</button>
    </form>
@endsection
