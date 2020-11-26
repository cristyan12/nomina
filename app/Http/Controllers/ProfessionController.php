<?php

namespace App\Http\Controllers;

use App\Models\Profession;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::orderBy('id', 'desc')->paginate(10);

        return view('professions.index', compact('professions'));
    }

    public function create()
    {
        return view('professions.create', ['profession' => new Profession]);
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|unique:professions,title'
        ], [
            'title.required' => 'El campo Título de la profesión es requerido',
            'title.unique' => 'El campo Título de la profesión ya está en uso.',
        ]);

        Profession::create($data);

        return redirect()->route('professions.index');
    }

    public function show(Profession $profession)
    {
        return view('professions.show', compact('profession'));
    }

    public function edit(Profession $profession)
    {
        return view('professions.edit', compact('profession'));
    }

    public function update(Profession $profession)
    {
        $data = request()->validate([
            'title' => 'required|unique:professions,title,'.$profession->id
        ], [
            'title.required' => 'El campo Título de la profesión es requerido',
            'title.unique' => 'El campo Título de la profesión ya está en uso.',
        ]);

        $profession->update($data);

        return redirect()->route('professions.show', $profession)
            ->with('success', 'Profesión actualizada con éxito');
    }
}
