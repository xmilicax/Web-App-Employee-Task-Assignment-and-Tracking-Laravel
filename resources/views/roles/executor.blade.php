@extends('dashboard')

@section('title')
    <title>Izvršilac - Panel</title>
@endsection

@section('naslov_stranice')
    <h1>Dobrodošli.</h1>
    <h2>Vaša uloga je izvršilac.</h2>
@endsection

@section('content')
    <h3>Odaberite radnju koju želite da izvršite:</h3>
    <nav>
        <ul>
            <li><a href="{{ route('tasks.index') }}">Spisak zadataka</a></li>
            <li><a href="{{ route('filter') }}">Filtriranje zadataka</a></li>
        </ul>
    </nav>
@endsection
