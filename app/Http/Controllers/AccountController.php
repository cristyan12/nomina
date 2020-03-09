<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Account, Bank, Company, Employee, Position};
use App\Http\Requests\CreateAccountRequest;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('id')->paginate(10);

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        $banks = Bank::orderBy('id')->get();
        $company = Company::first();
        $auth1 = Employee::whereHas('profile.position', function ($query){
            $query->where('position_id', Position::where('name', 'Presidente')->value('id'));
        })->get();

        $auth2 = Employee::whereHas('profile.position', function ($query){
            $query->where('position_id', Position::where('name', 'Vice Presidente')->value('id'));
        })->get();

        $account = new Account();

        return view('accounts.create', compact('banks', 'company', 'auth1', 'auth2', 'account'));
    }

    public function store(CreateAccountRequest $request)
    {
        $company = Company::first();

        $account = new Account($request->validated());

        $account->fill(['company_id' => $company->id]);

        auth()->user()->accounts()->save($account);

        return redirect()->route('accounts.index')
            ->with('info', 'Cuenta creada con éxito');
    }

    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        $banks = Bank::orderBy('id')->get();
        $company = Company::first();
        $auth1 = Employee::whereHas('profile.position', function ($query){
            $query->where('position_id', Position::where('name', 'Presidente')->value('id'));
        })->get();

        $auth2 = Employee::whereHas('profile.position', function ($query){
            $query->where('position_id', Position::where('name', 'Vice Presidente')->value('id'));
        })->get();

        return view('accounts.edit', compact('account', 'company', 'banks', 'auth1', 'auth2'));
    }

    public function update(Request $request, Account $account)
    {
        $data = $request->validate([
            'auth_1' => 'required',
            'auth_2' => 'present',
        ]);

        $account->auth_1 = $data['auth_1'];
        $account->auth_2 = $data['auth_2'];

        auth()->user()->accounts()->save($account);

        return redirect()->route('accounts.show', $account)
            ->with('info', 'Cuenta actualizada con éxito');
    }
}
