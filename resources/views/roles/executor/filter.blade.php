@extends('dashboard')

@section('title')
    <title>Izvršilac - Filter zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Filter zadataka</h1>
@endsection

@section('content')
    <div class="form-container">
        <form method="POST" action="{{ route('filterByDeadlineExec') }}">
            @csrf
            <label for="date">Datum:</label>
            <input type="date" name="date" placeholder="Datum završetka:">
            <button type="submit" class="button3">Filtriraj</button>
        </form>

        <form method="POST" action="{{ route('filterByExecExec') }}">
            @csrf
            <label for="executor">Izvršilac:</label>
            <input type="text" name="executor" placeholder="Unesite ID izvršioca:">
            <button type="submit" class="button3">Filtriraj</button>
        </form>

        <form method="POST" action="{{ route('filterByManagerExec') }}">
            @csrf
            <label for="manager">Rukovodioci:</label>
            <input type="text" name="manager" placeholder="Unesite ID rukovodioca">
            <button type="submit" class="button3">Filtriraj</button>
        </form>
    </div>
    <a class="left text-pink-700" href="{{route('filter')}}">Poništi filter</a>


    <h3 class="filter">Rezultati pretrage:</h3>
    <div class="rezultati">
        @if($tasks->isEmpty())
            <p id="bez_rezultata">Nema pronađenih zadataka za traženi kriterijum.</p>
        @else
            <table>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Opis</th>
                    <th>Lista izvršioca</th>
                    <th>Rukovodilac</th>
                    <th>Rok izvršenja</th>
                    <th>Prioritet</th>
                    <th>Grupa zadataka</th>
                    <th>Status</th>
                    <th>Fajl</th>
                </tr>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ \App\Models\User::returnNameList($task->list_executors) }}</td>
                        <td>{{ \App\Models\User::returnName($task->manager)}}</td>
                        <td>{{ $task->deadline }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ \App\Models\TaskGroup::returnGroupName($task->task_group_id)}}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->file ?? '/' }}</td>
                @endforeach
            </table>
        @endif
    </div>

@endsection

