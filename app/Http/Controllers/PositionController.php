<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\{
    CreatePositionRequest, UpdatePositionRequest
};

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('id')->paginate(10);

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(CreatePositionRequest $request)
    {
        $position = new Position($request->validated());

        auth()->user()->positions()->save($position);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo creado con éxito!');
    }

    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Position $position, UpdatePositionRequest $request)
    {
        // $position->code = $request->code;
        // $position->name = $request->name;
        // $position->basic_salary = $request->basic_salary;

        $position->fill($request->validated());

        auth()->user()->positions()->save($position);

        return redirect()->route('positions.show', $position);
    }
}
