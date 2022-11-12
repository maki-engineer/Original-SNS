<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>original-sns</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex justify-center">
      <div class="max-w-screen-sm w-full">
        <p class="text-2xl">{{ $tweet->content }}</p>
        @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
          <div class="flex">
            <a href="{{ route('tweet.update', ['tweetId' => $tweet->tweet_id]) }}">編集</a>
            <form action="{{ route('tweet.delete', ['tweetId' => $tweet->tweet_id]) }}" method="post">
              @method('DELETE')
              @csrf
              <button type="submit" onClick="delete_alert(event); return false;">削除</button>
            </form>
          </div>
          <div><a href="{{ route('like.likes', ['tweetId' => $tweet->tweet_id]) }}">{{ $likes }}個のいいね</a></div>
        @endif
      </div>
    </div>
    <script src="{{ asset('/js/delete_alert.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>