<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Requests\Account\CreateRequest;

class AccountController extends Controller
{
    public function create(CreateRequest $request)
    {
        $account = new Account;
        $account->user_id = $request->user()->id;
        $account->name = $request->input('name');
        $account->birthday = $request->date('birthday');
        $account->icon_image_path = $request->input('icon_image_path', '');
        $account->show_age_obscure = $request->input('show_age_obscure', false);
        $account->active_status = 1;

        $account->save();

        return redirect()->route('tweet.index');
    }

    public function update(CreateRequest $request, string $account_id)
    {
        $account = Account::where('user_id', $account_id);

        $account->name = $request->input('name');
        $account->birthday = $request->date('birthday');
        $account->icon_image_path = $request->input('icon_image_path', $account->icon_image_path);
        $account->show_age_obscure = $request->input('show_age_obscure', $account->show_age_obscure);
        $account->active_status = 1;

        $account->save();

        return redirect()->route('tweet.index', ['account' => $account]);
    }
}
