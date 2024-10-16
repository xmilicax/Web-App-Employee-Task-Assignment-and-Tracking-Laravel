@extends('dashboard')

@section('title')
    <title>Admin - Panel</title>
@endsection

@section('naslov_stranice')
    <h1>Dobrodošli.</h1>
    <h2>Vaša uloga je admin.</h2>
@endsection

@section('content')
    <h3>Odaberite radnju koju želite da izvršite:</h3>

    <nav>
        <ul>
            <li class="dropdown">
                <a href="#">Grupe zadataka</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_task_group_admin') }}">Napravi grupu</a> <br>
                    <a href="{{ route('update_task_group_admin') }}">Izmeni grupu</a> <br>
                    <a href="{{ route('all_task_group_admin') }}">Spisak grupa</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Zadaci</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_task_admin') }}">Napravi zadatak</a> <br>
                    <a href="{{ route('pre_update_task_admin') }}">Izmeni zadatak</a> <br>
                    <a href="{{ route('all_tasks_admin') }}">Spisak zadataka</a>

                </div>
            </li>
            <li class="dropdown">
                <a href="#">Korisnici</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_user_admin') }}">Napravi korisnika</a> <br>
                    <a href="{{ route('pre_update_user_admin') }}">Izmeni korisnika</a> <br>
                    <a href="{{ route('all_users_admin') }}">Spisak korisnika</a>
                </div>
            </li>
            </li>
            <li class="dropdown">
                <a href="#">Tipovi korisnika</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_user_type_admin') }}">Napravi tip korisnika</a> <br>
                    <a href="{{ route('update_user_type_admin') }}">Izmeni tip korisnika</a> <br>
                    <a href="{{ route('all_user_types_admin') }}">Spisak tip korisnika</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Komentari</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_comment_admin') }}">Napravi komentar</a> <br>
                    <a href="{{ route('update_comment_admin') }}">Izmeni komentar</a> <br>
                    <a href="{{ route('all_comments_admin') }}">Spisak komentara</a>
                </div>
            </li>
        </ul>
    </nav>
@endsection
