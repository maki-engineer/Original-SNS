<?php

namespace App\Services;

use App\Models\Tweet;

class TweetService
{
  public function getTweets()
  {
    return Tweet::orderBy('created_at', 'DESC')->take(50)->get();
  }

  public function checkOwnTweet(int $userId, int $tweetId): bool
  {
    $tweet = Tweet::where('tweet_id', $tweetId)->first();

    if(!$tweet){
      return false;
    }

    return $tweet->user_id === $userId;
  }
}
