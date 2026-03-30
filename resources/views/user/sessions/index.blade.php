@extends('layouts.app')

@section('title', 'Minhas Sessões')

@section('content')

<div class="user-wrapper">
    <div class="container-custom">

        {{-- Cabeçalho --}}
        <div class="header-section mb-5">
            <h1 class="page-title">Minhas Sessões 💬</h1>
            <p class="page-subtitle">Acompanhe e gerencie suas interações no MySkills.</p>
        </div>

        @php
            $userId = auth()->id();
            $solicitadas = $sessions->filter(fn($s) => $s->skillRequest->from_user_id === $userId && $s->status === 'pendente');
            $recebidas  = $sessions->filter(fn($s) => $s->skillRequest->to_user_id === $userId && $s->status === 'pendente');
            $confirmadas = $sessions->filter(fn($s) => ($s->skillRequest->from_user_id === $userId || $s->skillRequest->to_user_id === $userId) && $s->status === 'concluida');
        @endphp

        {{-- Sessões que você recebeu (PRIORIDADE VISUAL) --}}
        <div class="section-group">
            <h2 class="section-title"><i class="bi bi-arrow-down-left-circle text-primary"></i> Solicitações Recebidas</h2>
            @if($recebidas->count() > 0)
                <div class="sessions-grid">
                    @foreach($recebidas as $session)
                        <div class="session-card received">
                            <div class="card-status">
                                <span class="status-dot pulse"></span> Pendente de sua aprovação
                            </div>
                            <div class="card-content">
                                <h3 class="user-name">{{ $session->skillRequest->fromUser->name }}</h3>
                                <div class="skill-info-box">
                                    <div class="skill-item">
                                        <small>VOCÊ ENSINA</small>
                                        <span>{{ $session->skillRequest->skillWanted->name ?? '-' }}</span>
                                    </div>
                                    <div class="skill-divider"><i class="bi bi-arrow-left-right"></i></div>
                                    <div class="skill-item">
                                        <small>VOCÊ APRENDE</small>
                                        <span>{{ $session->skillRequest->skillOffer->name ?? '-' }}</span>
                                    </div>
                                </div>
                                <p class="timestamp"><i class="bi bi-clock"></i> Recebida em {{ $session->skillRequest->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="card-actions">
                                @if($session->status === 'pendente')
                                    <form method="POST" action="{{ route('sessions.conclude', $session->id) }}">
                                        @csrf
                                        <button type="submit" class="btn-confirm-action">Confirmar Troca</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Nenhuma nova solicitação recebida.</div>
            @endif
        </div>

        {{-- Sessões solicitadas --}}
        <div class="section-group mt-5">
            <h2 class="section-title"><i class="bi bi-send text-secondary"></i> Sessões que Você Solicitou</h2>
            @if($solicitadas->count() > 0)
                <div class="sessions-grid">
                    @foreach($solicitadas as $session)
                        <div class="session-card sent">
                            <div class="card-content">
                                <h3 class="user-name">{{ $session->skillRequest->toUser->name }}</h3>
                                <div class="skill-info-box">
                                    <div class="skill-item">
                                        <small>VOCÊ APRENDE</small>
                                        <span>{{ $session->skillRequest->skillWanted->name ?? '-' }}</span>
                                    </div>
                                    <div class="skill-item">
                                        <small>VOCÊ ENSINA</small>
                                        <span>{{ $session->skillRequest->skillOffer->name ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="waiting-badge">Aguardando resposta...</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">Você não tem solicitações enviadas pendentes.</div>
            @endif
        </div>

        {{-- Sessões confirmadas --}}
        @if($confirmadas->count() > 0)
            <div class="section-group mt-5">
                <h2 class="section-title"><i class="bi bi-check2-all text-success"></i> Sessões Confirmadas ✅</h2>
                <div class="sessions-grid">
                    @foreach($confirmadas as $session)
                        <div class="session-card confirmed">
                            <div class="card-content">
                                <h3 class="user-name">
                                    {{ $session->skillRequest->from_user_id === $userId ? $session->skillRequest->toUser->name : $session->skillRequest->fromUser->name }}
                                </h3>
                                <p class="success-text">Troca de habilidades aceita!</p>
                                <div class="date-badge">
                                    {{ $session->skillRequest->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="pagination-wrapper">
            {{ $sessions->links() }}
        </div>
    </div>
</div>

<style>
/* Base */
.user-wrapper { background-color: #f4f7fa; border-radius: 20px; min-height: 100vh; padding: 40px 0; font-family: 'Inter', system-ui, sans-serif; }
.container-custom { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

/* Cabeçalho */
.header-section { text-align: left; border-left: 4px solid #6366f1; padding-left: 20px; }
.page-title { font-weight: 800; color: #1e293b; font-size: 2rem; margin: 0; }
.page-subtitle { color: #64748b; font-size: 1rem; }

/* Títulos de Seção */
.section-title { font-size: 1.25rem; font-weight: 700; color: #334155; margin-top: 24px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.section-group { margin-bottom: 40px; }

/* Grid e Cards */
.sessions-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }

.session-card { 
    background: white; 
    border-radius: 16px; 
    border: 1px solid #e2e8f0; 
    transition: all 0.3s ease; 
    display: flex; 
    flex-direction: column;
    overflow: hidden;
}

.session-card:hover { transform: translateY(-3px); box-shadow: 0 12px 20px -5px rgba(0,0,0,0.05); }

/* Detalhes por tipo de card */
.session-card.sent { border-top: 4px solid #94a3b8; opacity: 0.9; }
.session-card.confirmed { border-top: 4px solid #10b981; }

.card-status { background: #f8fafc; padding: 8px 16px; font-size: 0.75rem; font-weight: 600; color: #475569; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px; }
.status-dot { width: 8px; height: 8px; background: #1adf23; border-radius: 50%; }
.pulse { animation: pulse-animation 2s infinite; }

@keyframes pulse-animation {
  0% { box-shadow: 0 0 0 0px rgba(99, 102, 241, 0.4); }
  100% { box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
}

.card-content { padding: 20px; }
.user-name { font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 15px; }

/* Skill Info Box */
.skill-info-box { background: #f8fafc; border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; border: 1px solid #f1f5f9; }
.skill-item { display: flex; flex-direction: column; }
.skill-item small { font-size: 0.65rem; color: #94a3b8; font-weight: 700; margin-bottom: 2px; }
.skill-item span { font-size: 0.85rem; font-weight: 600; color: #334155; }
.skill-divider { color: #cbd5e1; font-size: 1rem; }

.timestamp { font-size: 0.75rem; color: #94a3b8; margin: 0; }
.waiting-badge { font-size: 0.8rem; color: #64748b; font-style: italic; }
.success-text { color: #059669; font-weight: 600; font-size: 0.9rem; }
.date-badge { display: inline-block; background: #ecfdf5; color: #065f46; margin-top: 8px; padding: 4px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }

/* Botões */
.card-actions { padding: 0 20px 20px 20px; }
.btn-confirm-action { 
    width: 100%; 
    background: #6366f1; 
    color: white; 
    border: none; 
    padding: 10px; 
    border-radius: 10px; 
    font-weight: 700; 
    cursor: pointer; 
    transition: background 0.2s;
}
.btn-confirm-action:hover { background: #4f46e5; }

.empty-state { padding: 30px; background: white; border-radius: 12px; border: 2px dashed #e2e8f0; color: #94a3b8; text-align: center; }
.pagination-wrapper { margin-top: 40px; display: flex; justify-content: center; }

@media (max-width: 640px) { .sessions-grid { grid-template-columns: 1fr; } }
</style>
@endsection