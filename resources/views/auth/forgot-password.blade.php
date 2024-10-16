@section('link-naslov', 'href=login')

@section('naslov')
    <h1 id="naslov">{{ 'Promena lozinke' }}</h1>
@endsection

<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
        {{ __('Unesite email adresu Vašeg profila.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="inline-block flex items-center justify-end mt-4">
            <x-secondary-button class="ms-3">
                <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Znaš lozinku? Prijavi se') }}</a>
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Resetuj lozinku') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
