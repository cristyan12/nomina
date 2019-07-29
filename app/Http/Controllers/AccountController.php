<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Account, Bank, Company, Employee};
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
        $auth1 = Employee::orderBy('id')->get();
        $auth2 = Employee::orderBy('id')->get();

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
        //
    }

    public function edit(Account $account)
    {
        //
    }

    public function update(Request $request, Account $account)
    {
        //
    }

    public function destroy(Account $account)
    {
        //
    }
}
