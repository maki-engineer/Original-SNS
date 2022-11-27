<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Good;
use App\Models\FollowerRelationship;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Account\CreateRequest;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        $userId  = (int)$request->route('userId');
        $account = Account::where('id', $userId)->firstOrFail();

        $tweets = Tweet::orderBy('created_at', 'DESC')->where('user_id', $userId)->take(50)->get();
        $tweetsToArray = $tweets->toArray();

        // いいねの数
        $goods = [];

        // いいねしたかどうか
        $isGoods = [];

        // アカウントをフォローしているかどうか
        $isFollow = (bool)FollowerRelationship::where('follower_id', Auth::id())->where('user_id', $userId)->count();

        foreach (array_values($tweetsToArray) as $tweet) {
            $goods[]   = Good::where('tweet_id', $tweet['tweet_id'])->count();
            $isGoods[] = (bool)Good::where('user_id', $userId)->where('tweet_id', $tweet['tweet_id'])->count();
        }

        return view('user.show', ['account' => $account, 'tweets' => $tweets, 'goods' => $goods, 'isGoods' => $isGoods, 'isFollow' => $isFollow]);
    }

    public function following(Request $request)
    {
        return view('user.following', []);
    }

    public function followers(Request $request)
    {
        return view('user.followers', []);
    }

    public function follow(Request $request)
    {
        $userId  = (int)$request->route('userId');

        $followAccount = new FollowerRelationship;
        $followAccount->follower_id = Auth::id();
        $followAccount->user_id     = $userId;
        $followAccount->save();

        return redirect()->back();
    }

    public function unfollow(Request $request)
    {
        $userId  = (int)$request->route('userId');

        $unfollowAccount = FollowerRelationship::where('follower_id', Auth::id())->where('user_id', $userId)->firstOrFail();
        $unfollowAccount->delete();

        return redirect()->back();
    }

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
