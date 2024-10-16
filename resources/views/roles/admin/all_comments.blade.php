@extends('dashboard')

@section('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Admin - Spisak komentara</title>
@endsection

@section('naslov_stranice')
    <h1>Spisak komentara</h1>
@endsection

@section('content')
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>Zadatak</th>
                <th>Korisnik</th>
                <th>Sadržaj</th>
                <th>Vreme</th>
            </tr>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ \App\Models\Comment::returnTaskName($comment->task_id) }}</td>
                    <td>{{ \App\Models\Comment::returnUserName($comment->user_id) }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at }}</td>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
