@extends('dashboard')

@section('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Admin - Spisak tipova korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Spisak tipova korisnika</h1>
@endsection

@section('content')
    <div>
        <table class="skinny">
            <tr>
                <th>ID</th>
                <th>Naziv</th>
            </tr>
            <tbody>
            @foreach($user_types as $user_type)
                <tr>
                    <td>{{ $user_type->id }}</td>
                    <td>{{ $user_type->user_type }}</td>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
