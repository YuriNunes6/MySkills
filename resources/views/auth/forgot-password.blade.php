@extends('layouts.app')

@section('title', 'MySkills - Recuperar Senha')

@section('content')
<div class="auth-wrapper">
    <div class="container-custom">
        <div class="auth-card">

            {{-- Header --}}
            <div class="auth-header">
                <div class="brand-logo">
                    <img src="{{ asset('images/MySkills-logo.png') }}" alt="myskills-logo">
                </div>
                <div class="icon-circle">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h1 class="auth-title">Recuperar Senha</h1>
                <p class="auth-subtitle">Informe seu e-mail cadastrado e enviaremos um link para você criar uma nova senha.</p>
            </div>

            {{-- Mensagem de Sucesso --}}
            @if(session('status'))
                <div class="alert-custom success">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <span>{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            {{-- Mensagens de Erro/Validação --}}
            @if(session('error') || $errors->any())
                <div class="alert-custom error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>
                        @if(session('error'))
                            <span>{{ session('error') }}</span>
                        @else
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Formulário de Recuperação --}}
            <form class="form-grid" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group-custom">
                    <label for="email">E-mail cadastrado</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email"
                               placeholder="exemplo@gmail.com"
                               value="{{ old('email') }}" 
                               required autofocus
                               class="@error('email') is-invalid @enderror">
                    </div>
                </div>

                <button type="submit" class="btn-login-main">
                    Enviar link de recuperação <i class="bi bi-send"></i>
                </button>
            </form>

            {{-- Rodapé --}}
            <div class="auth-footer">
                <div class="divider"><span>Lembrou a senha?</span></div>

                <div class="register-cta">
                    <p>Volte para a tela de login e acesse sua conta.</p>
                    <a href="{{ route('login') }}" class="btn-register-link">
                        <i class="bi bi-arrow-left"></i> Voltar para o Login
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Base e Respiro */
    .auth-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
        font-family: 'Inter', sans-serif;
    }

    .container-custom {
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .auth-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* Cabeçalho */
    .auth-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .brand-logo img {
        width: 100%;
        max-width: 120px;
        height: auto;
        display: block;
        margin: 0 auto 10px;
    }

    .icon-circle {
        width: 64px;
        height: 64px;
        background: #eef4fd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 16px auto 20px;
        border: 2px solid #c7daf5;
    }

    .icon-circle i {
        font-size: 1.7rem;
        color: #1b5fa7;
    }

    .auth-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .auth-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Formulário e Inputs Corrigidos */
    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .input-group-custom label {
        display: block;
        font-weight: 600;
        color: #334155;
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.1rem;
        pointer-events: none; /* Impede que o ícone intercepte o clique */
        z-index: 2;
    }

    .input-icon-wrapper input {
        width: 100%;
        padding: 16px 16px 16px 48px; 
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.2s ease;
        background: #fcfdfe;
        display: block;
    }

    .input-icon-wrapper input:focus {
        outline: none;
        border-color: #1b5fa7;
        background: white;
        box-shadow: 0 0 0 4px rgba(27, 95, 167, 0.1);
    }

    /* Estilo para erro de validação */
    .input-icon-wrapper input.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    /* Botão Principal */
    .btn-login-main {
        background: #1b5fa7;
        color: white;
        border: none;
        padding: 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-login-main:hover {
        background: #14437a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(27, 95, 167, 0.3);
    }

    /* Rodapé e Link */
    .auth-footer {
        margin-top: 35px;
        text-align: center;
    }

    .divider {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        color: #cbd5e1;
    }

    .divider::before, .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #e2e8f0;
    }

    .divider span {
        padding: 0 12px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .register-cta p {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    .btn-register-link {
        color: #1b5fa7;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        transition: color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-register-link:hover {
        color: #14437a;
        text-decoration: underline;
    }

    /* Alertas */
    .alert-custom {
        display: flex;
        gap: 12px;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .alert-custom.error {
        background: #fff1f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .alert-custom.success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    /* Responsividade */
    @media (max-width: 480px) {
        .auth-card {
            padding: 30px 20px;
        }
    }
</style>
@endsection