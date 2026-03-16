<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    // Página de visualização do portfólio do usuário
    public function index()
    {
        $user = auth()->user();
        $skills = $user->skills()->get(); // skills do usuário

        return view('user.skills.index', compact('skills'));
    }

    // Página de edição das skills
    public function edit()
    {
        $user = auth()->user();

        // Todas as skills do sistema
        $skills = Skill::all();

        // IDs das skills que o usuário já possui
        $userSkills = $user->skills()->pluck('skills.id')->toArray();

        return view('user.skills.edit_skills', compact('skills', 'userSkills'));
    }

    // Atualiza as skills do usuário
    public function update(Request $request)
    {
        $user = auth()->user();

        $selectedSkills = $request->input('skills', []);

        $levels = $request->input('nivel_academico', []);

        $syncData = [];
        foreach ($selectedSkills as $skillId) {
            $syncData[$skillId] = [
                'nivel_academico' => $levels[$skillId] ?? 'regular'
            ];
        }

        $user->skills()->sync($syncData);

        return redirect()->route('user.skills.index')
        ->with('success', 'Skills atualizadas com sucesso!');
    }
}
