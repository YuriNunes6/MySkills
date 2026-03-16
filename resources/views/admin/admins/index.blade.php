@extends('layouts.app')

@section('title', 'Administradores do Sistema')

@section('content')
<div class="admin-page">

    <div class="page-header">
        <div class="container header-content">
            <div class="header-text">
                <span class="badge-admin">Sistema & Segurança</span>
                <h1>Administradores do Sistema</h1>
                <p class="header-description">Gerencie os níveis de acesso e visualize a equipe técnica da plataforma.</p>
                <div class="header-actions">
                    <a href="{{ route('admin.admins.create') }}" class="btn-create">
                        <i class="bi bi-person-plus-fill"></i> Novo Administrador
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="admins-grid">

            @foreach($admins as $admin)
            <div class="admin-card">
                <div class="card-overlay"></div>
                <div class="card-inner">
                    <div class="admin-avatar">
                        {{ strtoupper(substr($admin->name,0,1)) }}
                        <span class="verified-dot"><i class="bi bi-shield-check"></i></span>
                    </div>

                    <div class="admin-info">
                        <h3>{{ $admin->name }}</h3>
                        <p><i class="bi bi-envelope"></i> {{ $admin->email }}</p>
                    </div>

                    <div class="admin-badge">Acesso Total</div>
                </div>
            </div>
            @endforeach

        </div>

        @if($admins->hasPages())
        <div class="pagination-box">
            {{ $admins->links() }}
        </div>
        @endif
    </div>
</div>

<style>
/* Variáveis de Cores Administrativas */
:root {
    --admin-dark: #0f172a;
    --admin-accent: #3b82f6;
    --admin-bg: #f1f5f9;
    --text-main: #1e293b;
    --text-muted: #64748b;
}

.admin-page {
    background: var(--admin-bg);
    min-height: 100vh;
    font-family: 'Inter', system-ui, sans-serif;
    padding-bottom: 80px;
}

/* Header Estilo Dark Modern */
.page-header {
    background: var(--admin-dark);
    padding: 60px 0;
    margin-bottom: 50px;
    color: white;
    position: relative;
    overflow: hidden;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    position: relative;
    z-index: 1;
}

.header-text{
    margin-left: 28px;
}

.header-text h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 12px 0;
    letter-spacing: -1px;
}

.header-description {
    color: #94a3b8;
    font-size: 1rem;
    margin-bottom: 0;
}

.badge-admin {
    background: rgba(59, 130, 246, 0.2);
    color: #60a5fa;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Botão de Criação */
.btn-create {
    background: var(--admin-accent);
    color: white;
    margin-top: 16px;
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s;
}

.btn-create:hover {
    background: #2563eb;
    color: white;
}

/* Grid de Admins */
.admins-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    margin-left: 26px;
    margin-right: 26px;
}

/* Card Administrativo */
.admin-card {
    background: white;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.admin-card:hover {
    border-color: var(--admin-accent);
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
}

.card-inner {
    padding: 35px 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 2;
}

/* Avatar com Badge de Verificado */
.admin-avatar {
    width: 80px;
    height: 80px;
    border-radius: 24px;
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
}

.verified-dot {
    position: absolute;
    bottom: -5px;
    right: -5px;
    background: #10b981;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    border: 3px solid white;
}

/* Informações */
.admin-info h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 6px;
}

.admin-info p {
    font-size: 0.85rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 6px;
    justify-content: center;
}

.admin-badge {
    margin-top: 20px;
    padding: 4px 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
}

/* Paginação */
.pagination-box {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    padding: 20px;
}

@media (max-width: 768px) {
    .header-content { text-align: center; justify-content: center; }
    .btn-create { width: 100%; justify-content: center; }
}
</style>
@endsection