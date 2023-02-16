<?php

namespace App\Http\Controllers\Tweet;

use App\Enums\AccountStatus;
use App\Http\Controllers\Controller;
use App\Services\TweetService;
use App\Http\Requests\Tweet\CreateRequest;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use App\Models\Good;
use App\Services\AccountService;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    public function index(Request $request, TweetService $tweetService, AccountService $accountService)
    {
        $account = $accountService->getAccount();

        $tweets        = $tweetService->getTweets();
        $tweetsToArray = $tweets->toArray();

        $userId = Auth::id();

        // いいねの数
        $goods = [];

        // いいねしたかどうか
        $isGoods = [];

        foreach (array_values($tweetsToArray) as $tweet) {
            $goods[]   = Good::where('tweet_id', $tweet['tweet_id'])->count();
            $isGoods[] = (bool)Good::where('user_id', $userId)->where('tweet_id', $tweet['tweet_id'])->count();
        }

        return view('tweet.index', ['account' => $account,  'tweets' => $tweets, 'goods' => $goods, 'isGoods' => $isGoods]);
    }

    public function show(Request $request)
    {
        $tweetId = (int)$request->route('tweetId');
        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        $likes = Good::where('tweet_id', $tweetId)->count();

        $userId = Auth::id();
        $isGood = (bool)Good::where('user_id', $userId)->where('tweet_id', $tweet['tweet_id'])->count();

        return view('tweet.show', ['tweet' => $tweet, 'likes' => $likes, 'isGood' => $isGood]);
    }

    public function create(CreateRequest $request)
    {
        $tweet   = new Tweet;
        $account = Account::where('user_id', $request->userId())
            ->where('active_status', AccountStatus::ACTIVE)
            ->firstOrFail();

        if ($account == null) {
            return response()->view('layouts.error', ['msg' => "アカウント情報の取得に失敗しました"]);
        }

        $tweet->user_id = $account->id;
        $tweet->content = $request->tweet();
        $tweet->status  = 1;
        $tweet->save();

        return redirect()->route('tweet.index');
    }

    public function update(Request $request, TweetService $tweetService)
    {
        $tweetId = (int)$request->route('tweetId');

        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        $tweet = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        $account = Account::where('user_id', $tweet->user_id)->firstOrFail();

        return view('tweet.update', ['tweet' => $tweet, 'account' => $account]);
    }

    public function put(UpdateRequest $request, TweetService $tweetService)
    {

        if (!$tweetService->checkOwnTweet($request->user()->id, $request->id())) {
            throw new AccessDeniedHttpException();
        }

        $tweet          = Tweet::where('tweet_id', $request->id())->firstOrFail();
        $tweet->content = $request->tweet();
        $tweet->save();

        return redirect()
            ->route('tweet.index', ['tweetId' => $tweet->tweet_id])
            ->with('feedback.success', 'つぶやきを編集しました');
    }

    public function delete(Request $request, TweetService $tweetService)
    {
        $tweetId = (int)$request->route('tweetId');

        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        $tweet = Tweet::where('tweet_id', $tweetId)->firstOrFail();
        $tweet->delete();

        return redirect()
            ->route('tweet.index')
            ->with('feedback.success', 'つぶやきを削除しました');
    }

    public function like(Request $request)
    {
        $good           = new Good;
        $tweetId        = (int)$request->route('tweetId');
        $userId         = Auth::id();
        $good->tweet_id = $tweetId;
        $good->user_id  = $userId;
        $good->save();

        return redirect()->back();
    }

    public function unlike(Request $request)
    {
        $tweetId = (int)$request->route('tweetId');
        $userId  = Auth::id();

        $good = Good::where('user_id', $userId)->where('tweet_id', $tweetId)->firstOrFail();

        $good->delete();

        return redirect()->back();
    }

    public function likes(Request $request)
    {
        $tweetId = (int)$request->route('tweetId');
        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        $likesToArray = Good::where('tweet_id', $tweetId)->get()->toArray();

        $likes = [];

        foreach (array_values($likesToArray) as $like) {
            $likes[] = Account::where('id', $like['user_id'])->get();
        }

        return view('like.likes', ['tweet' => $tweet, 'likes' => $likes]);
    }
}
