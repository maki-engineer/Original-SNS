<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    public function getAccount()
    {
        $accounts = Account::where('user_id', Auth::id())->get();

        if ($accounts->isEmpty()) {
            return null;
        }

        return $accounts[0];
    }
}
