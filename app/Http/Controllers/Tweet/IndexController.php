<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Services\TweetService;
use App\Http\Requests\Tweet\CreateRequest;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IndexController extends Controller
{
    public function index(Request $request, TweetService $tweetService)
    {
        $tweets = $tweetService->getTweets();

        return view('tweet.index', ['tweets' => $tweets]);
    }

    public function show(Request $request)
    {
        $tweetId = (int)$request->route('tweetId');
        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        return view('tweet.show', ['tweet' => $tweet]);
    }

    public function create(CreateRequest $request)
    {
        $tweet          = new Tweet;
        $tweet->user_id = $request->userId();
        $tweet->content = $request->tweet();
        $tweet->status  = 1;
        $tweet->save();

        return redirect()->route('tweet.index');
    }

    public function update(Request $request, TweetService $tweetService)
    {
        $tweetId = (int)$request->route('tweetId');

        if(!$tweetService->checkOwnTweet($request->user()->id, $tweetId)){
            throw new AccessDeniedHttpException();
        }

        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        return view('tweet.update', ['tweet' => $tweet]);
    }

    public function put(UpdateRequest $request, TweetService $tweetService)
    {

        if(!$tweetService->checkOwnTweet($request->user()->id, $request->id())){
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

        if(!$tweetService->checkOwnTweet($request->user()->id, $tweetId)){
            throw new AccessDeniedHttpException();
        }

        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();
        $tweet->delete();

        return redirect()
             ->route('tweet.index')
             ->with('feedback.success', 'つぶやきを削除しました');
    }
}
