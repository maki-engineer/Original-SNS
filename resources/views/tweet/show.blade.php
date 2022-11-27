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
<body class="bg-green-200">
    <div class="flex">
      <div class="flex justify-end pt-6 pr-8 w-1/3">
        @auth
            <ul class="text-4xl">
              <li class="mb-12"><a href="{{ route('tweet.index') }}">タイムライン</a></li>
              <li class="mb-12"><a href="">通知</a></li>
              <li class="mb-12"><a href="">メッセージ</a></li>
              <li class="mb-12"><a href="{{ route('user.show', ['userId' => $tweet->user_id]) }}">プロフィール</a></li>
              <li class="mb-12"><a href="">設定</a></li>
            </ul>
        @endauth
      </div>

      <div class="w-1/3 pt-6">
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
            @else
              @if($isGood)
                  <form action="{{ route('tweet.unlike', ['tweetId' => $tweet->tweet_id]) }}" method="post">
                      @method('DELETE')
                      @csrf
                      <button type="submit"><img class="mt-2" src="/images/si_Heart.svg"></button>
                  </form>
              @else
                  <form action="{{ route('tweet.like', ['tweetId' => $tweet->tweet_id]) }}" method="post">
                      @csrf
                      <button type="submit"><img class="mt-2" src="/images/si_Heart_alt.svg"></button>
                  </form>
              @endif
            @endif
          </div>
        </div>
      </div>

      <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>
    <script src="{{ asset('/js/delete_alert.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>