@extends('dashboard')

@section('title')
    <title>Rukovodilac odeljenja - Brisanje grupe zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Brisanje grupe zadataka</h1>
@endsection

@section('content')
    <form action="{{ route('delete_task_group_mng') }}" method="POST">
        @csrf
        <div>
            @if(session('success'))
                <div class="status_uspesno">
                    {{ session('success') }}
                </div>
            @endif
            <br>
            <label for="task_group_id">ID grupe:</label>
                <select name="task_group_id" id="task_group_id" required>
                    <option value="">Odaberi zadatak</option>
                    @foreach ($task_groups as $task_group)
                        <option value="{{ $task_group->id }}">{{ $task_group->name }} (ID: {{ $task_group->id }})</option>
                    @endforeach
                </select>

            <br>
            @error('id')
            <div class="status_greska">{{ $message }}</div>
            @enderror
            <br>


        </div>
        <button type="submit" class="button">Izbriši grupu zadataka</button>
    </form>
@endsection
