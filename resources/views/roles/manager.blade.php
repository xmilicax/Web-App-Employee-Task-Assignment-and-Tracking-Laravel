@extends('dashboard')

@section('title')
    <title>Rukovodilac odeljenja - Panel</title>
@endsection

@section('naslov_stranice')
    <h1>Dobrodošli.</h1>
    <h2>Vaša uloga je rukovodilac odeljenja.</h2>
@endsection

@section('content')
    <h3>Odaberite radnju koju želite da izvršite:</h3>

    <nav>
        <ul>
            <li class="dropdown">
                <a href="#">Grupe</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_task_group_mng') }}">Napravi grupu</a> <br>
                    <a href="{{ route('update_task_group_mng') }}">Izmeni grupu</a> <br>
                    <a href="{{ route('delete_task_group_mng') }}">Izbriši grupu</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Zadaci</a>
                <div class="dropdown-content">
                    <a href="{{ route('create_task_mng') }}">Napravi zadatak</a> <br>
                    <a href="{{ route('pre_update_task_mng') }}">Izmeni zadatak</a> <br>
                    <a href="{{ route('delete_task_mng') }}">Izbriši zadatak</a> <br>
                </div>
            </li>
            <li class="dropdown">
                <a href="{{ route('task_list_mng') }}">Lista zadataka</a>
            </li>
            <li class="dropdown">
                <a href="{{ route('filter_mng') }}">Filtriranje zadataka</a>
            </li>
        </ul>
    </nav>
@endsection
