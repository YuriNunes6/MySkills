@extends('layouts.app')

@section('title', 'MySkills')

@section('content')
<div class="skill-dashboard">
    <div class="dashboard-header">
        <div class="container">
            <span class="badge-role {{ auth()->user()->is_admin ? 'badge-admin' : '' }}">
                {{ auth()->user()->is_admin ? 'Painel Administrativo' : 'Meu Perfil' }}
            </span>
            <h1>Olá, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
            <p>Gerencie suas trocas de conhecimento e conexões em um só lugar.</p>
        </div>
    </div>

    <div class="container">
        <div class="action-grid">
            @if(auth()->user()->is_admin)
                <div class="skill-card admin-card">
                    <div class="card-icon icon-admin-skills"><i class="bi bi-layers"></i></div>
                    <h3>Habilidades Globais</h3>
                    <p>Crie, edite ou remova as categorias de habilidades do sistema.</p>
                    <a href="{{ route('admin.skills.index') }}" class="btn-main admin-btn">Gerenciar Skills</a>
                </div>

                <div class="skill-card admin-card">
                    <div class="card-icon icon-admin-users"><i class="bi bi-people"></i></div>
                    <h3>Comunidade</h3>
                    <p>Controle de perfis, remoção de usuários e listagem de administradores.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn-main admin-btn">Ver Usuários</a>
                </div>
            @else
                <div class="skill-card">
                    <div class="card-icon icon-user-skills"><i class="bi bi-lightning"></i></div>
                    <h3>Minhas Skills</h3>
                    <p>Atualize o que você sabe e o que deseja aprender na plataforma.</p>
                    <div class="btn-group-vertical">
                        <a href="{{ route('user.skills.index') }}" class="btn-main">Ver Minhas Skills</a>
                        <a href="{{ route('user.skills.edit') }}" class="btn-sub">Editar Níveis</a>
                    </div>
                </div>

                <div class="skill-card">
                    <div class="card-icon icon-user-request"><i class="bi bi-search"></i></div>
                    <h3>Nova Solicitação</h3>
                    <p>Busque usuários e peça uma nova sessão de aprendizado mútuo.</p>
                    <a href="{{ route('skill-requests.create') }}" class="btn-main">Solicitar Troca</a>
                </div>

                <div class="skill-card">
                    <div class="card-icon icon-user-sessions"><i class="bi bi-calendar-check"></i></div>
                    <h3>Sessões de Troca</h3>
                    <p>Visualize suas aulas agendadas e avalie seus parceiros de treino.</p>
                    <a href="{{ route('sessions.index') }}" class="btn-main">Minha Agenda</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    :root {
        --primary: #4f46e5;
        --primary-hover: #4338ca;
        --admin: #111827;
        --admin-light: #f3f4f6;
        --text-main: #111827;
        --text-sub: #6b7280;
        --bg-page: #f9fafb;
    }

    .container h1 { margin-top: 10px; margin-bottom: 10px; }

    .skill-dashboard { background-color: var(--bg-page); min-height: 100vh; padding-bottom: 60px; }

    .dashboard-header { background: white; padding: 50px 0; margin-bottom: 40px; border-bottom: 1px solid #e5e7eb; text-align: center; }
    
    .badge-role { background: #eef2ff; color: var(--primary); padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .badge-admin { background: #111827; color: #fff; }

    .action-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; }

    .skill-card { background: white; border-radius: 16px; padding: 32px; border: 1px solid #e5e7eb; display: flex; flex-direction: column; align-items: center; text-align: center; transition: transform 0.2s, box-shadow 0.2s; }
    .skill-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .skill-card h3{ margin-bottom: 6px; }
    .skill-card p{ margin-bottom: 24px; }
    
    /* Destaque Admin */
    .admin-card { border: 2px solid var(--admin); }

    .card-icon { width: 56px; height: 56px; background: #eef2ff; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary); margin-bottom: 20px; }
    
    .btn-main { background: var(--primary); color: white; padding: 12px 20px; border-radius: 10px; font-weight: 600; text-decoration: none; width: 100%; transition: background 0.2s; }
    .btn-main:hover { background: var(--primary-hover); color: white; }
    
    .admin-btn { background: var(--admin); }
    .admin-btn:hover { background: #000; }

    .btn-sub { margin-top: 12px; color: var(--text-sub); font-size: 0.85rem; text-decoration: underline; }
    .btn-sub:hover { color: var(--primary); }

    .btn-group-vertical { margin-top: 12px; }

    /* Classes específicas para cada ícone */
    .icon-admin-skills { background: #fee2e2 !important; color: #dc2626 !important; }
    .icon-admin-users { background: #fef3c7 !important; color: #d97706 !important; }
    .icon-user-skills { background: #dcfce7 !important; color: #16a34a !important; }
    .icon-user-request { background: #dbeafe !important; color: #2563eb !important; }
    .icon-user-sessions { background: #f3e8ff !important; color: #9333ea !important; }

    @media (max-width: 768px) { .dashboard-header h1 { font-size: 2rem; } }
</style>
@endsection