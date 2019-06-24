<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\SaveUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(SaveUserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('users.index')
            ->with('info', 'Creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaveUserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, User $user)
    {
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.show', $user)
            ->with('info', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
