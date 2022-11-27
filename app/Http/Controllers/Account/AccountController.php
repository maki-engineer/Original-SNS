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

        $account->user_id         = $request->user()->id;
        $account->name            = $request->input('name');
        $account->birthday        = $request->date('birthday');
        $account->icon_image_path = $request->input('icon_image_path', '');

        // 0 年齢非表示、1 年齢をあいまいに表示、2 年齢をはっきりと表示
        $account->show_age_obscure = 2;

        if ($request->input('show_age_obscure')) {
            $account->show_age_obscure = 1;
        }

        if ($request->input('not_show_age')) {
            $account->show_age_obscure = 0;
        }

        $account->active_status = 1;

        $account->save();

        return redirect()->route('tweet.index');
    }

    public function update(Request $request)
    {
        $account = Account::where('user_id', $request->user()->id);

        $account->name = $request->input('name');
        $account->birthday = $request->date('birthday');
        $account->icon_image_path = $request->input('icon_image_path', $account->icon_image_path);
        $account->show_age_obscure = $request->input('show_age_obscure', $account->show_age_obscure);
        $account->active_status = 1;

        $account->save();

        return redirect()->route('tweet.index');
    }
}
