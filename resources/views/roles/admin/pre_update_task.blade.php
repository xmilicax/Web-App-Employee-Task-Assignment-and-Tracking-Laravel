@extends('dashboard')

@section('title')
    <title>Admin - Izmena zadatka</title>
@endsection

@section('naslov_stranice')
    <h1>Izmena zadatka</h1>
@endsection

@section('content')
    <form action="{{ route('pre_update_task_admin') }}" method="POST">
        @csrf
        <div>
            <label for="task_id">Odaberite zadatak koji želite da izmenite:</label>
            <select name="task_id" id="task_id" required>
                <option value="">Odaberi zadatak</option>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}">{{ $task->title }} (ID: {{ $task->id }}) </option>
                @endforeach
            </select>

            <br><br>
            @error('id')
            <div class="status_greska">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button">Sledeći korak</button>
    </form>

@endsection
