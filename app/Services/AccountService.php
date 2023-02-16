<?php

namespace App\Services;

use App\Enums\AccountStatus;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    public function getAccount()
    {
        $accounts = Account::where('user_id', Auth::id())->where('active_status', AccountStatus::ACTIVE)->get();

        if ($accounts->isEmpty()) {
            return null;
        }

        return $accounts[0];
    }
}
