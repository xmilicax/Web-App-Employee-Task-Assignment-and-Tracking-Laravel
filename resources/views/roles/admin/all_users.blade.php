@extends('dashboard')

@section('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Admin - Spisak korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Spisak korisnika</h1>
@endsection

@section('content')
    <div>
        <table >
            <tr>
                <th>ID</th>
                <th>Korisničko ime</th>
                <th>Email</th>
                <th>Ime i prezime</th>
                <th>Tip korisnika</th>
                <th>Telefon</th>
                <th>Datum rođenja</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ \App\Models\UserType::returnType($user->user_type_id ) }}</td>
                    <td>{{ $user->phone ?? '/' }}</td>
                    <td>{{ $user->birthday ?? '/' }}</td>
                    <td>{{ \App\Models\User::returnStatus($user->email_verified_at) }}</td>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
