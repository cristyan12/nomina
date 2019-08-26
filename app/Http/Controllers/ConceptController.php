<?php

namespace App\Http\Controllers;

use App\Concept;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
    public function index()
    {
        $concepts = Concept::orderBy('id')->paginate(10);

        return view('concepts.index', compact('concepts'));
    }

    public function create()
    {
        return view('concepts.create', ['concept' => new Concept()]);
    }

    public function store(Request $request)
    {
        $concept = new Concept($request->all());
        
        auth()->user()->concepts()->save($concept);
        
        return redirect()->route('concepts.index');
    }

    public function show(Concept $concept)
    {
        //
    }

    public function edit(Concept $concept)
    {
        //
    }

    public function update(Request $request, Concept $concept)
    {
        //
    }

    public function destroy(Concept $concept)
    {
        //
    }
}
