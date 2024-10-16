@extends('dashboard')

@section('title')
    <title>Admin - Izmena grupe zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Izmena grupe zadataka</h1>
@endsection

@section('content')
    <form action="{{ route('update_task_group_admin') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif

            <label for="id">ID grupe za izmenu:</label>
            <select name="task_group_id" id="task_group_id" required>
                <option value="">Odaberi grupu zadataka</option>
                @foreach ($task_groups as $task_group)
                    <option value="{{ $task_group->id }}">{{ $task_group->name }}</option>
                @endforeach
            </select>

            <br><br>
            @error('id')
            <div class="status_greska">{{ $message }}</div>
            @enderror

            <br>
            <label for="name">Novi naziv grupe:</label>
            <input type="text" name="name" id="name"  required>
            @error('name')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Izmeni grupu zadataka</button>
    </form>

@endsection
