@extends('layouts.app')

@section('title', 'Novo Administrador')

@section('content')
<div class="admin-page">

    <div class="page-header">
        <div class="container">
            <span class="badge-admin">Administração</span>
            <h1>Criar Novo Administrador</h1>
            <p>Adicione um novo usuário com permissões administrativas.</p>
        </div>
    </div>

    <div class="container form-container">

        <div class="form-card">

            <form method="POST" action="{{ route('admin.admins.store') }}">
                @csrf

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-submit">
                    Criar Administrador
                </button>

            </form>

        </div>

    </div>

</div>


<style>

:root{
    --primary:#4f46e5;
    --admin:#111827;
    --bg:#f9fafb;
    --text:#111827;
    --sub:#6b7280;
}

.admin-page{
    background:var(--bg);
    min-height:100vh;
    font-family:'Segoe UI',Roboto,Arial;
}

/* HEADER */

.page-header{
    background: #1e293b; /* Slate Dark */
    padding: 50px 0;
    margin-bottom: 50px;
    color: white;
    border-bottom: 4px solid #3b82f6;
    text-align: center;
}

.page-header h1{
    font-size:2.4rem;
    font-weight:800;
    margin:10px 0;
}

.page-header p{
    color:var(--sub);
}

.badge-admin{
    background: rgba(59, 130, 246, 0.2);
    color: #60a5fa;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* FORM CARD */

.form-container{
    display:flex;
    justify-content:center;
}

.form-card{
    background:white;
    width:420px;
    padding:40px;
    border-radius:18px;
    box-shadow:0 15px 30px rgba(0,0,0,0.05);
    border:1px solid #f3f4f6;
}

/* FORM */

.form-group{
    display:flex;
    flex-direction:column;
    margin-bottom:20px;
}

.form-group label{
    font-weight:600;
    margin-bottom:6px;
    font-size:.9rem;
}

.form-group input{
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    font-size:.9rem;
    transition:.2s;
}

.form-group input:focus{
    outline:none;
    border-color:var(--primary);
    box-shadow:0 0 0 2px rgba(79,70,229,.15);
}

/* BUTTON */

.btn-submit{
    width:100%;
    background:var(--admin);
    color:white;
    padding:12px;
    border:none;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-submit:hover{
    transform:translateY(-2px);
    filter:brightness(1.1);
}

</style>

@endsection