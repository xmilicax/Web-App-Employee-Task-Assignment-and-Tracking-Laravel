<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Izbriši profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Trajno izbriši profil i sve podatke. ') }}
            <br>
            {{ __('Preporučujemo da preuzmete sve podatke koje želite da sačuvate pre brisanja.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Izbriši profil') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Da li ste sigurni da želite trajno da izbrišete profil?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Nakon brisanja svi podaci će biti obrisani i nećete imati mogućnost povraćaja istih.') }}
                <br>
                {{ __('Radi potvrde unesite trenutnu lozinku profila.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Lozinka') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Unesite lozinku') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Odustani') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Trajno izbriši profil') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
