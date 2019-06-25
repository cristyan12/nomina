<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\{Permission, Role};

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::orderBy('id')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')
            ->with('info', 'Role creado correctamente');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::get(),
        ]);
    }

    public function update(Request $request, Role $role) 
    {
        $role->update($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')
            ->with('info', 'Role actualizado correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
