<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('id', 'DESC')->paginate(10);

        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create', ['branch' => new Branch]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        Branch::create($data);

        return redirect()->route('branches.index')
            ->with('success', 'Sucursal creada con éxito.');
    }

    public function show(Branch $branch)
    {
        return view('branches.show', compact('branch'));
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $data = request()->validate([
            'name' => 'required|unique:branches,name,' . $branch->id
        ]);

        $branch->update($data);

        return redirect()->route('branches.show', $branch)
            ->with('success', 'Sucursal actualizada con éxito');
    }
}
