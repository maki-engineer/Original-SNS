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
    <h1>original-sns</h1>
    <div>
        <p>投稿フォーム</p>
        @if(session('feedback.success'))
          <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('tweet.create') }}" method="post">
            @csrf
            <label for="tweet-content">つぶやき</label>
            <span>140文字まで</span>
            <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力"></textarea>
            @error('tweet')
              <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">投稿</button>
        </form>
    </div>
    <div>
      @foreach($tweets as $tweet)
        <details>
          <summary>{{ $tweet->content }}</summary>
          <div>
            <a href="{{ route('tweet.update', ['tweetId' => $tweet->tweet_id]) }}">編集</a>
            <form action="{{ route('tweet.delete', ['tweetId' => $tweet->tweet_id]) }}" method="post">
              @method('DELETE')
              @csrf
              <button type="submit">削除</button>
            </form>
          </div>
        </details>
      @endforeach
    </div>
</body>
</html>