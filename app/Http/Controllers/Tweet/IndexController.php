<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
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
}
