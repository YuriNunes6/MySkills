@extends('layouts.app')

@section('title', 'Redefinir Senha')

@section('content')
<div class="auth-wrapper">
    <div class="container-custom">
        <div class="auth-card">

            {{-- Header --}}
            <div class="auth-header">
                <div class="brand-logo">
                    <img src="{{ asset('images/MySkills-logo.png') }}" alt="myskills-logo">
                </div>
                <h1 class="auth-title">Redefinir Senha</h1>
                <p class="auth-subtitle">Escolha uma nova senha para sua conta.</p>
            </div>

            {{-- Mensagem de erro --}}
            @if($errors->any())
                <div class="alert-custom error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Formulário --}}
            <form class="form-grid" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group-custom">
                    <label for="email">E-mail</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email"
                               placeholder="exemplo@gmail.com"
                               value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="input-group-custom">
                    <label for="password">Nova Senha</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-key"></i>
                        <input type="password" name="password" id="password"
                               placeholder="Mínimo 8 caracteres..." required>
                    </div>
                </div>

                <div class="input-group-custom">
                    <label for="password_confirmation">Confirmar Nova Senha</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-key-fill"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="Repita a nova senha..." required>
                    </div>
                </div>

                <button type="submit" class="btn-login-main">
                    Redefinir Senha <i class="bi bi-check-lg"></i>
                </button>
            </form>

            {{-- Rodapé --}}
            <div class="auth-footer">
                <div class="divider"><span>Lembrou a senha?</span></div>
                <a href="{{ route('login') }}" class="btn-register-link">
                    Voltar para o login
                </a>
            </div>

        </div>
    </div>
</div>
@endsection