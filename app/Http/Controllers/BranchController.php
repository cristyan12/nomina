<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('id')->paginate(10);

        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Branch::create([
            'name' => $request['name']
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Sucursal creada con éxito.');
    }

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $branch->update($request->only('name'));

        return redirect()->route('branches.index')
            ->with('success', 'Sucursal actualizada con éxito');
    }
}
