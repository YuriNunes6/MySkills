@extends('layouts.app')

@section('title', 'Terminal de Controle - Admin')

@section('content')
<div class="admin-dark-terminal">

    <div class="terminal-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-section">
                <h1>Gerenciamento de Usuários</h1>
                <p class="text-muted">Monitoramento de competências e acesso de alto nível.</p>
            </div>
            <div class="header-tools">
                <div class="user-count-badge">
                    <span class="label">DATABASE</span>
                    <span class="value">{{ count($users) }} USERS</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="terminal-grid">

            @foreach($users as $user)
                @if($user->id !== auth()->id())

                <div class="operator-card">
                    <div class="card-glow"></div>
                    
                    <div class="operator-header">
                        <div class="operator-avatar">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="operator-meta">
                            <h3 class="operator-name">{{ $user->name }}</h3>
                            <span class="operator-id">{{ $user->email }}</span>
                        </div>
                        <div class="status-dot"></div>
                    </div>

                    <div class="skills-matrix">
                        <div class="matrix-label">COMPETÊNCIAS REGISTRADAS</div>
                        <div class="matrix-list">
                            @foreach($user->skills as $skill)
                                <div class="matrix-item">
                                    <span class="m-name">{{ $skill->name }}</span>
                                    <span class="m-line"></span>
                                    <span class="m-level">{{ $skill->pivot->nivel_academico }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @endif
            @endforeach

        </div>
    </div>

</div>

<style>
    :root {
        --dark-pure: #f8fafc;   
        --dark-deep: #e2e8f0;       
        --dark-surface: #f1f5f9;    
        --dark-elevated: #e2e8f0;    
        --accent-primary: #1e293b;   
        --accent-soft: #64748b;      
        --text-dim: #475569;         
        --border-color: #cbd5e1;    
        --status-online: #22c55e;
    }

    .admin-dark-terminal {
        background-color: var(--dark-pure);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
        color: var(--accent-primary);
        padding-bottom: 50px;
    }

    /* Header Estilo Terminal */
    .terminal-header {
        background: var(--dark-deep);
        padding: 40px 60px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 40px;
    }

    .system-status {
        font-size: 0.65rem;
        letter-spacing: 2px;
        color: var(--status-online);
        font-weight: 800;
        display: block;
        margin-bottom: 8px;
    }

    .terminal-header h1 {
        font-weight: 900;
        font-size: 2rem;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .text-muted{
        margin-top: 6px;
        margin-bottom: 12px;
    }

    .user-count-badge {
        background: var(--dark-surface);
        border: 1px solid var(--border-color);
        padding: 10px 20px;
        border-radius: 4px;
        text-align: right;
    }

    .user-count-badge .label {
        display: block;
        font-size: 0.6rem;
        color: var(--text-dim);
    }

    .user-count-badge .value {
        font-weight: 800;
        color: var(--accent-primary);
    }

    /* Grid Layout */
    .terminal-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 25px;
        padding: 0 60px;
    }

    /* Operator Card */
    .operator-card {
        background: var(--dark-surface);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .operator-card:hover {
        border-color: var(--accent-soft);
        transform: translateY(-5px);
        background: var(--dark-elevated);
    }

    /* Efeito de brilho sutil no hover */
    .card-glow {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at 50% 0%, rgba(255,255,255,0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .operator-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .operator-avatar {
        width: 56px;
        height: 56px;
        background: var(--accent-primary);
        color: var(--dark-pure);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.1rem;
        border-radius: 4px;
    }

    .operator-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }

    .operator-id {
        font-size: 0.8rem;
        color: var(--text-dim);
        font-family: 'JetBrains Mono', monospace; /* Estilo código */
    }

    .status-dot {
        margin-left: auto;
        width: 8px;
        height: 8px;
        background: var(--status-online);
        border-radius: 50%;
        box-shadow: 0 0 10px var(--status-online);
    }

    /* Skills Matrix Estilizada */
    .skills-matrix {
        margin-bottom: 30px;
    }

    .matrix-label {
        font-size: 0.65rem;
        font-weight: 800;
        color: var(--text-dim);
        margin-bottom: 15px;
        letter-spacing: 1.5px;
    }

    .matrix-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .matrix-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
    }

    .m-name { font-weight: 500; }

    .m-line {
        flex-grow: 1;
        height: 1px;
        background: var(--border-color);
        margin: 0 15px;
        border-bottom: 1px dashed rgba(255,255,255,0.05);
    }

    .m-level {
        color: var(--accent-primary);
        font-weight: 700;
        font-size: 0.75rem;
        background: var(--dark-elevated);
        padding: 2px 8px;
        border-radius: 4px;
    }

    /* Botões */
    .operator-actions {
        display: flex;
        gap: 12px;
    }

    .btn-terminal-primary {
        flex: 1;
        background: var(--accent-primary);
        color: var(--dark-pure);
        border: none;
        padding: 12px;
        font-weight: 800;
        font-size: 0.8rem;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-terminal-primary:hover {
        background: #e4e4e7;
    }

    .btn-terminal-outline {
        flex: 1;
        background: transparent;
        color: var(--accent-primary);
        border: 1px solid var(--accent-soft);
        padding: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-terminal-outline:hover {
        background: var(--dark-elevated);
        border-color: var(--accent-primary);
    }

    @media (max-width: 768px) {
        .terminal-grid { padding: 0 20px; }
        .terminal-header { padding: 30px 20px; }
    }
</style>
@endsection