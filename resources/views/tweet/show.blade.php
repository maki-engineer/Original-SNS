<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>original-sns</title>
</head>
<body>
    <div>
      <p>{{ $tweet->content }}</p>
      @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
        <div>
          <a href="{{ route('tweet.update', ['tweetId' => $tweet->tweet_id]) }}">編集</a>
          <form action="{{ route('tweet.delete', ['tweetId' => $tweet->tweet_id]) }}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit">削除</button>
          </form>
        </div>
      @endif
    </div>
</body>
</html>