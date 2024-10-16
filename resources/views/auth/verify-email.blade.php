<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center dark:text-gray-400">
        {{ __('Uspešno ste se registrovali na platformu. ') }}
        <br>
        {{ __('Pre nego što počnete sa aktivnostima, preostao je još jedan korak
        - verifikacija profila. Ona se odvija putem klika na link koji poslat na Vašu e-mail adresu. Ukoliko ne vidite
        mejl, pošaljite zahtev za ponovno slanje mejla.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-center dark:text-green-400">
            {{ __('Novi verifikacioni link je poslat na Vašu email adresu.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Ponovo pošalji verifikacioni link') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-secondary-button type="submit">
                {{ __('Odjavi se') }}
            </x-secondary-button>
        </form>
    </div>
</x-guest-layout>
