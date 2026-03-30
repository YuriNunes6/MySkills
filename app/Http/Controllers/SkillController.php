<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Services\SkillService;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::paginate(10);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request, SkillService $skillService)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
        ]);

        Skill::create([
            'name' => $request->name,
            'icon' => $skillService->getIconByName($request->name),
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Habilidade criada!');
    }

    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, string $id, SkillService $skillService)
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $skill->id,
        ]);

        $skill->update([
            'name' => $request->name,
            'icon' => $skillService->getIconByName($request->name),
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Habilidade atualizada!');
    }

    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill->users()->count() > 0) {
            return back()->with('error', 'Não é possível deletar habilidade associada a usuários.');
        }

        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Habilidade removida!');
    }
}