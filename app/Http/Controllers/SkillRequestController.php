<?php

namespace App\Http\Controllers;

use App\Models\SkillRequest;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillRequestController extends Controller
{
    public function create()
    {
        $users = User::where('role', 'user')
            ->with('skills')
            ->where('id', '!=', Auth::id())
            ->get();

        return view('user.requests.create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'skill_offer_id' => 'required|exists:skills,id',
            'skill_wanted_id' => 'required|exists:skills,id',
        ]);

        if ($request->to_user_id == Auth::id()) {
            return back()->with('error','Você não pode enviar solicitação para si mesmo.');
        }

        $skillRequest = SkillRequest::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'skill_offer_id' => $request->skill_offer_id,
            'skill_wanted_id' => $request->skill_wanted_id,
            'status' => 'pendente'
        ]);

        // cria sessão automaticamente
        Session::create([
            'request_id' => $skillRequest->id,
            'data_sessao' => now(),
            'start_time' => now()->format('H:i:s'),
            'end_time' => now()->addHour()->format('H:i:s'),
            'status' => 'pendente',
            'observacoes' => null,
        ]);

        return redirect()
            ->route('sessions.index')
            ->with('success','Solicitação enviada com sucesso!');
    }

    public function accept($id)
    {
        $requestModel = SkillRequest::findOrFail($id);

        if ($requestModel->to_user_id !== Auth::id()) {
            abort(403);
        }

        $requestModel->update([
            'status' => 'aceita'
        ]);

        return back()->with('success','Solicitação aceita!');
    }

    public function reject($id)
    {
        $requestModel = SkillRequest::findOrFail($id);

        if ($requestModel->to_user_id !== Auth::id()) {
            abort(403);
        }

        $requestModel->update([
            'status' => 'recusada'
        ]);

        return back()->with('success','Solicitação recusada.');
    }
}