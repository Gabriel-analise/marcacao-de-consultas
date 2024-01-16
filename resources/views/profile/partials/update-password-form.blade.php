<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random senha to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('senha.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current senha')" />
            <x-text-input id="update_password_current_password" name="senha_atual" type="senha" class="mt-1 block w-full" autocomplete="current-senha" />
            <x-input-error :messages="$errors->updatePassword->get('senha_atual')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New senha')" />
            <x-text-input id="update_password_password" name="senha" type="senha" class="mt-1 block w-full" autocomplete="new-senha" />
            <x-input-error :messages="$errors->updatePassword->get('senha')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm senha')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="senha" class="mt-1 block w-full" autocomplete="new-senha" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'senha-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
