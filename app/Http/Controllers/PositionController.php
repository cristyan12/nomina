<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

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
        Position::create([
            'code' => $request['code'],
            'name' => $request['name'],
            'basic_salary' => $request['basic_salary'],
        ]);

        return redirect()->route('positions.index')
            ->with('info', 'Cargo creado con éxito!');
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
        $position->update($request->only('code', 'name', 'basic_salary'));

        return redirect()->route('positions.show', $position);
    }
}
