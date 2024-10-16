@extends('dashboard')

@section('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Izvršilac - Lista zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Lista zadataka</h1>
@endsection

@section('content')
    <div>
        <table>
            <tr>
                <th>Naslov</th>
                <th>Opis</th>
                <th>
                    <a href="#" onclick="toggleSort('list_executors')">Lista izvršilaca
                        <i class="fa-solid fa-sort {{ request('sort') === 'list_executors' ? (request('order', 'asc') === 'asc' ? '-up' : '-down') : '' }}"></i>
                    </a>
                </th>
                <th>
                    <a href="#" onclick="toggleSort('manager')">Rukovodilac
                        <i class="fa-solid fa-sort {{ request('sort') === 'manager' ? (request('order', 'asc') === 'asc' ? '-up' : '-down') : '' }}"></i>
                    </a>
                </th>
                <th>
                    <a href="#" onclick="toggleSort('deadline')">Rok izvršenja
                        <i class="fa-solid fa-sort {{ request('sort') === 'deadline' ? (request('order', 'asc') === 'asc' ? '-up' : '-down') : '' }}"></i>
                    </a>
                </th>
                <th>Prioritet</th>
                <th>Grupa zadataka</th>
                <th>Status</th>
                <th>Komentar</th>
                <th>Akcija</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>
                        <a href="{{ route('task-detail', $task) }}">{{ $task->title }}</a>
                    </td>
                    <td>{{ $task->description }}</td>
                    <td>{{ \App\Models\User::returnNameList($task->list_executors) }}</td>
                    <td>{{ \App\Models\User::returnName($task->manager)}}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ \App\Models\TaskGroup::returnGroupName($task->task_group_id)}}</td>
                    <td>{{ $task->status }}</td>
                    <td><a href="{{ route('task-detail', $task) }}">Prikaži komentare</a></td>
                    <td>
                        @if ($task->status !='Otkazano')
                        <form action="{{ route('executor-complete', $task) }}" method="POST" class="clear">
                            @csrf
                            <button type="submit" class="button">Završeno</button>
                        </form>
                        @else
                            <p>/</p>
                        @endif
                    </td>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // naizmenično sortiranje putem kliktanja na naslov
        function toggleSort(column) {
            var currentUrl = window.location.href;
            var newUrl;

            if (currentUrl.includes('?')) {
                if (currentUrl.includes('sort=' + column)) {
                    if (currentUrl.includes('order=asc')) {
                        newUrl = currentUrl.replace('order=asc', 'order=desc');
                    } else {
                        newUrl = currentUrl.replace('order=desc', 'order=asc');
                    }
                } else {
                    newUrl = currentUrl.includes('sort=') ?
                        currentUrl.replace(/sort=[^&]*/, 'sort=' + column).replace(/order=[^&]*/, 'order=asc') :
                        currentUrl + '&sort=' + column + '&order=asc';
                }
            } else {
                newUrl = currentUrl + '?sort=' + column + '&order=asc';
            }
            window.location.href = newUrl;
        }
    </script>
@endsection
