<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillRequestController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\SkillController as UserSkillController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Página inicial → Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cadastro
Route::get('/cadastro', [AuthController::class, 'showCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastroSubmit'])->name('cadastro.submit');
 // Páagina de esqueci minha senha

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


/*

|--------------------------------------------------------------------------
| ÁREA DE USUÁRIO LOGADO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard usuário comum
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Usuários
    Route::get('users', [UserController::class,'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class,'show'])->name('users.show');

    // Perfil
    Route::get('/meu-perfil', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/meu-perfil/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/meu-perfil/editar', [UserController::class, 'update'])->name('users.update');

    // Requests
    Route::get('skill-requests/create', [SkillRequestController::class,'create'])->name('skill-requests.create');
    Route::post('skill-requests', [SkillRequestController::class,'store'])->name('skill-requests.store');
    Route::post('skill-requests/{id}/accept', [SkillRequestController::class,'accept'])->name('skill-requests.accept');
    Route::post('skill-requests/{id}/reject', [SkillRequestController::class,'reject'])->name('skill-requests.reject');

    // Sessões
    Route::get('sessions', [SessionController::class,'index'])->name('sessions.index');
    Route::get('sessions/{session}', [SessionController::class,'show'])->name('sessions.show');
    Route::post('sessions/{id}/conclude', [SessionController::class,'conclude'])->name('sessions.conclude');

    // Avaliações
    Route::get('avaliacoes/create', [AvaliacaoController::class,'create'])->name('avaliacoes.create');
    Route::post('avaliacoes', [AvaliacaoController::class,'store'])->name('avaliacoes.store');

    // Skills (visualização e edição)
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('skills', [UserSkillController::class,'index'])->name('skills.index');
        Route::get('skills/edit', [UserSkillController::class, 'edit'])->name('skills.edit');
        Route::put('skills/edit', [UserSkillController::class, 'update'])->name('skills.update');
    });

});

/*
|--------------------------------------------------------------------------
| ÁREA ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Usuários (admin)
    Route::get('users', [UserController::class,'index'])->name('users.index');

    // Skills
    Route::get('skills', [SkillController::class,'index'])->name('skills.index');
    Route::get('skills/create',[SkillController::class,'create'])->name('skills.create');
    Route::post('skills',[SkillController::class,'store'])->name('skills.store');
    Route::get('skills/{skill}/edit',[SkillController::class,'edit'])->name('skills.edit');
    Route::put('skills/{skill}',[SkillController::class,'update'])->name('skills.update');
    Route::delete('skills/{skill}',[SkillController::class,'destroy'])->name('skills.destroy');

    // Admins
    Route::get('admins', [AdminController::class,'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class,'showCreate'])->name('admins.create');
    Route::post('admins/create', [AdminController::class,'store'])->name('admins.store');
    Route::get('admins/{admin}/edit', [AdminController::class,'edit'])->name('admins.edit');
    Route::put('admins/{admin}', [AdminController::class,'update'])->name('admins.update');
    Route::delete('admins/{admin}', [AdminController::class,'destroy'])->name('admins.destroy');
});
