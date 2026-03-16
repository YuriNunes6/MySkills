@extends('layouts.app')

@section('title', 'Nova Solicitação - SkillSwap')

@section('content')
<div class="skill-dashboard">

    <div class="dashboard-header">
        <div class="container">
            <span class="badge-role">Explorar Usuários</span>
            <h1>Escolha um parceiro de aprendizado 👋</h1>
            <p>Conecte-se com pessoas incríveis e troque conhecimentos de forma colaborativa.</p>
        </div>
    </div>

    <div class="container">
        <div class="users-grid"> 
            @foreach($users as $user)
                <div class="skill-card">
                    <div class="card-body">
                        <div class="user-avatar-wrapper">
                            <div class="card-icon">
                                @php
                                    // Extrai as iniciais do nome (até 2 letras)
                                    $words = explode(' ', $user->name);
                                    $initials = mb_substr($words[0], 0, 1);
                                    if (count($words) > 1) {
                                        $initials .= mb_substr(end($words), 0, 1);
                                    }
                                @endphp
                                <span class="user-initials">{{ strtoupper($initials) }}</span>
                            </div>
                            <div class="user-info-text">
                                <h3>{{ $user->name }}</h3>
                                <span class="user-status">
                                    <span class="status-pulse"></span> 
                                    Disponível para troca
                                </span>
                            </div>
                        </div>

                        <div class="skills-section">
                            <span class="section-title">Habilidades</span>
                            <div class="skills-tags">
                                @if($user->skills->count() > 0)
                                    @foreach($user->skills as $skill)
                                        <span class="skill-tag">{{ $skill->name }}</span>
                                    @endforeach
                                @else
                                    <span class="no-skills">Nenhuma habilidade listada</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        @if(auth()->user()->skills->count() > 0 && $user->skills->count() > 0)
                            <form method="POST" action="{{ route('skill-requests.store') }}">
                                @csrf
                                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                <input type="hidden" name="skill_offer_id" value="{{ auth()->user()->skills->first()->id }}">
                                <input type="hidden" name="skill_wanted_id" value="{{ $user->skills->first()->id }}">

                                <button type="submit" class="btn-main">
                                    <i class="bi bi-lightning-charge-fill"></i> Solicitar Sessão
                                </button>
                            </form>
                        @else
                            <div class="alert-unavailable">
                                <i class="bi bi-exclamation-circle"></i>
                                Troca indisponível
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<style>
/* Estrutura Geral */
.skill-dashboard {
    background-color: #f8fafc;
    min-height: 100vh;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    padding-bottom: 50px;
}

.dashboard-header {
    background: #ffffff;
    padding: 60px 0;
    margin-bottom: 40px;
    border-bottom: 1px solid #e2e8f0;
    text-align: center;
}

.dashboard-header h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1e293b;
    letter-spacing: -0.025em;
    margin: 10px 0;
}

.dashboard-header p {
    color: #64748b;
    max-width: 500px;
    margin: 0 auto;
}

.badge-role {
    background: #eff6ff;
    color: #2563eb;
    padding: 6px 16px;
    border-radius: 100px;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Grid */
.users-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Card */
.skill-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}

.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.05);
    border-color: #3b82f6;
}

.card-body { padding: 24px; }

/* Avatar e Iniciais */
.user-avatar-wrapper {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.card-icon {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.user-initials {
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}

.user-info-text h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

/* Bolinha Pulsante */
.user-status {
    font-size: 0.8rem;
    color: #10b981;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 2px;
}

.status-pulse {
    width: 8px;
    height: 8px;
    background-color: #10b981;
    border-radius: 50%;
    position: relative;
}

.status-pulse::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #10b981;
    border-radius: 50%;
    animation: ripple 1.5s infinite ease-out;
}

@keyframes ripple {
    0% { transform: scale(1); opacity: 0.8; }
    100% { transform: scale(3); opacity: 0; }
}

/* Habilidades */
.skills-section {
    border-top: 1px solid #f1f5f9;
    padding-top: 15px;
}

.section-title {
    display: block;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 10px;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.skill-tag {
    background: #f1f5f9;
    color: #475569;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Footer e Botão */
.card-footer { padding: 0 24px 24px 24px; }

.btn-main {
    background: #2563eb;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 12px;
    font-weight: 600;
    width: 100%;
    cursor: pointer;
    transition: 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-main:hover { background: #1d4ed8; transform: scale(1.02); }

.alert-unavailable {
    background: #fff1f2;
    color: #e11d48;
    padding: 10px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
}

@media (max-width: 640px) {
    .users-grid { grid-template-columns: 1fr; }
    .dashboard-header h1 { font-size: 1.8rem; }
}
</style>