<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Http\Requests\Tweet\UpdateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();

        return view('tweet.index', ['tweets' => $tweets]);
    }

    public function create(CreateRequest $request)
    {
        $tweet          = new Tweet;
        $tweet->content = $request->tweet();
        $tweet->save();

        return redirect()->route('tweet.index');
    }

    public function update(Request $request)
    {
        $tweetId = (int)$request->route('tweetId');
        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();

        return view('tweet.update', ['tweet' => $tweet]);
    }

    public function put(UpdateRequest $request)
    {
        $tweet          = Tweet::where('tweet_id', $request->id())->firstOrFail();
        $tweet->content = $request->tweet();
        $tweet->save();

        return redirect()
             ->route('tweet.update', ['tweetId' => $tweet->tweet_id])
             ->with('feedback.success', 'つぶやきを編集しました');
    }

    public function delete(Request $request)
    {
        $tweetId = (int) $request->route('tweetId');
        $tweet   = Tweet::where('tweet_id', $tweetId)->firstOrFail();
        $tweet->delete();

        return redirect()
             ->route('tweet.index')
             ->with('feedback.success', 'つぶやきを削除しました');
    }
}
