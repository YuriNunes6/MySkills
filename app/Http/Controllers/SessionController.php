<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
       $sessions = Session::with(['skillRequest.fromUser', 'skillRequest.toUser', 'skillRequest.skillOffer', 'skillRequest.skillWanted'])
            ->whereHas('skillRequest', function($q) {
                $q->where('from_user_id', Auth::id())
                ->orWhere('to_user_id', Auth::id());
            })
            ->paginate(10);
        return view('user.sessions.index', compact('sessions'));
    }

    public function conclude($id)
    {
        $session = Session::with('skillRequest')->findOrFail($id);

        if ($session->skillRequest->from_user_id !== Auth::id() && $session->skillRequest->to_user_id !== Auth::id()) {
            abort(403);
        }

        if ($session->status === 'concluida' || $session->status === 'cancelada') {
            return back()->with('error', 'Sessão não pode ser concluída.');
        }

        $session->update(['status' => 'concluida']);

        return back()->with('success', 'Sessão concluída com sucesso!');
    }
}