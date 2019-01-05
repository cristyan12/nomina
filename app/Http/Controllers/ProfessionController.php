<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function create()
    {
        return view('professions.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required'
        ], [
            'title.required' => 'El campo Título de la profesión es requerido'
        ]);

        Profession::create($data);

        return redirect()->route('professions.index');
    }
}
