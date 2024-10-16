@extends('dashboard')

@section('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Admin - Spisak grupa zadataka</title>
@endsection

@section('naslov_stranice')
    <h1>Spisak grupa zadataka</h1>
@endsection

@section('content')
    <div>
        <table class="skinny">
            <tr>
                <th>ID</th>
                <th>Naziv</th>
            </tr>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{{ $group->name }}</td>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
