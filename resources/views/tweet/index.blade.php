<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>original-sns</title>

    <style>
        body {
          color: red;
        }
    </style>
</head>
<body>
    <h1>original-sns</h1>
    @auth
      <div>
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
    @endauth
    <div>
      @foreach($tweets as $tweet)
      <div>
        <h3>{{ $tweet->user->name }}</h3>
        <div>
          <a href="{{ route('tweet.show', ['tweetId' => $tweet->tweet_id]) }}">{{ $tweet->content }}</a>
        </div>
      </div>
      @endforeach
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>