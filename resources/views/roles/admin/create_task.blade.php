@extends('dashboard')

@section('title')
    <title>Admin - Napravi zadatka</title>
@endsection

@section('naslov_stranice')
    <h1>Napravi zadatak</h1>
@endsection

@section('content')
    <form action="{{ route('create_task_admin') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf

        @if(session('success'))
            <div class="status_uspesno" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <!-- omogućavamo Laravelu da prevede naslov, ukoliko prepoznaje jezik (nije neophodno u ovoj aplikaciji) -->
            <label for="title">{{ __('Naslov') }}</label>


            <input id="title" type="text"
                   class="form-control @error('title') is-invalid @enderror"
                   name="title"
                   value="{{ old('title') }}" required autofocus>
            <!-- u slučaju neuspelog kreiranja, čuvaju se uneti podaci u polju  -->

            @error('title')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="description">{{ __('Opis zadatka') }}</label>


            <textarea id="description"
                      class="form-control @error('description') is-invalid @enderror"
                      name="description"
                      value="{{ old('description') }}" required>
            </textarea>

            @error('description')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <!-- demonstracija da nije neophodno imati naslov za prevod -->
            <br>
            <label for="list_executors">Odaberite izvršioce:</label>
            <p>CTRL + click za više korisnika</p>

            <select name="list_executors[]" id="list_executors" multiple>
                @foreach ($executors as $executor)
                    @if ($executor->user_type_id === 3)
                        <option value="{{ $executor->id }}">{{ $executor->name }} (ID: {{ $executor->id }})</option>
                    @endif
                @endforeach
            </select>

            @error('list_executors')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="manager">{{ __('Rukovodilac') }}</label>

            <select name="manager" id="manager" required>
                <option value="">Odaberi rukovodioca zadatka</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
            </select>

            @error('manager')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="deadline">{{ __('Rok izvršenja') }}</label>
            <input id="deadline"
                   type="datetime-local"
                   class="form-control @error('deadline') is-invalid @enderror"
                   name="deadline"
                   value="{{ old('deadline') }}" required>

            @error('deadline')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="priority">{{ __('Prioritet') }}</label>

            <input id="priority"
                   type="number"
                   class="form-control @error('priority') is-invalid @enderror"
                   name="priority"
                   min="1"
                   max="10"
                   placeholder="1-10"
                   value="{{ old('priority') }}" required>

            @error('priority')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="task_group_id">{{ __('Grupa zadatka') }}</label>

            <select name="task_group_id" id="task_group_id" required>
                <option value="">Odaberi grupu zadataka</option>
                @foreach ($task_groups as $task_group)
                    <option value="{{ $task_group->id }}">{{ $task_group->name }}</option>
                @endforeach
            </select>

            @error('task_group_id')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label for="file">{{ __('Fajl') }}</label>

            <input id="file" type="file"
                   class="form-control-file @error('file') is-invalid @enderror" name="file">

            @error('file')
            <span class="status_greska" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <button type="submit" class="button">Napravi zadatak</button>
    </form>
@endsection
