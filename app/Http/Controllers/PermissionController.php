<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index', [
            'permissions' => Permission::orderBy('id')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('permissions.create', [
            'permission' => new Permission
        ]);
    }

    public function store(Request $request)
    {
        Permission::create($request->all());

        return redirect()->route('permissions.index')
            ->with('info', 'Permiso creado con éxito');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('permissions.index')
            ->with('info', 'Permiso actualizado con éxito');
    }
}
