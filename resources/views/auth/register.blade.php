@section('link-naslov', 'href=../public/')

@section('naslov')
    <h1 id="naslov">{{ 'Registracija' }}</h1>
@endsection

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Ponovljena lozinka')"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Ime i prezime')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('ime_prezime')" required autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('ime_prezime')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100
            rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}">
                {{ __('Imaš profil?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registruj se') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
