@extends('dashboard')

@section('title')
    <title>Admin - Napravi korisnika</title>
@endsection

@section('naslov_stranice')
    <h1>Napravi korisnika</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('create_user_admin') }}">
        @csrf

        @if(session('success'))
            <div class="status_uspesno" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Korisničko ime')"/>
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                          required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Lozinka')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Ime i prezime')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('ime_prezime')" required autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="user_type_id" :value="__('Tip korisnika')"/>
            <select name="user_type_id" id="user_type_id" required>
                <option value="">Odaberi tip korisnika</option>
                @foreach ($user_types as $user_type)
                    <option value="{{ $user_type->id }}">{{ $user_type->user_type }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('user_type_id')" class="mt-2"/>
        </div>



        <!-- Broj telefona-->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Broj telefona')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                          :value="old('broj_telefona')" autocomplete="phone"/>
        </div>

        <!-- Datum rođenja -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Datum rođenja')"/>
            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday"
                          :value="old('datum_rodjenja')" autocomplete="birthday"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Napravi korisnika') }}
            </x-primary-button>
        </div>
    </form>
@endsection
