<x-guest-layout>
@section('title', 'Login')
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/"><img src="/img/logo.png" class="img-fluid"  alt="Logo"></a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email">E-mail</label>
                    <input id="email" class="form-control" type="email" name="email" required/>
                </div>

                <div class="mt-2">
                    <label for="password">Senha</label>
                    <input id="password" id="password" class="form-control" type="password" name="password" required>
                </div>

                <div class="mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">Lembrar senha</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="forgot-password">
                            {{ __('Esqueceu sua senha?') }}
                        </a>
                    @endif

                    <button class="ml-4 btn btn-success btn-lg"> Log in</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
