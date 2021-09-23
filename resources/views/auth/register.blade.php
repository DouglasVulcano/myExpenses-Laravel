@section('title', 'Cadastre-se')
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/"><img src="/img/logo.png" class="img-fluid"  alt="Logo"></a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/register">

            @csrf
            <div>
                <label for="name">Nome</label>
                <input id="name" class="form-control" type="text" name="name"  required >
            </div>
            <div class="mt-4">
                <label for="email">E-mail</label>
                <input id="email" class="form-control" type="text" name="email"  required >
            </div>
            <div class="mt-4">
                <label for="password">Senha</label>
                <input id="password" class="form-control" type="password" name="password"  required >
            </div>
            <div class="mt-4">
                <label for="password_confirmation">Confirmar senha</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"  required >
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/login">
                    Já possui registro?
                </a>
                <button class="ml-4 btn btn-success btn-lg">
                    {{ __('Cadastrar-se') }}
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
