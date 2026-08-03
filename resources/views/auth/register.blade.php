<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nom & prénom')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Login -->
            <div class="mt-4">
                <x-label for="login" :value="__('login')" />

                <x-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required />
            </div>


            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />
                <select id="role" name="role"  class="block mt-1 w-full" required>
                    <option value="">ROLE DE L'UTILISATEUR</option>
                    <option value="admin">ADMIN</option>
                    <option value="selection">CENTRE DE SELECTION</option>
                </select>
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-label for="centre" :value="__('Centre')" />
                <select id="centre" name="centre"  class="block mt-1 w-full">
                    <option value="">CENTRE DE L'UTILISATEUR</option>
                    @foreach($centres as $centre)
                        <option value="{{$centre->centre}}">{{$centre->centre}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mot de passe')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>


            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                 <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
