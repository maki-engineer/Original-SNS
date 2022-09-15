<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $tweets = Tweet::all();
        return view('tweet.index', ['tweets' => $tweets]);
    }
}
