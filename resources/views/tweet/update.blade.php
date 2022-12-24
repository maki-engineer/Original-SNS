<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpaChat</title>
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
                    <li class="mb-12"><a href="{{ route('user.show', ['userId' => $account->id]) }}">プロフィール</a></li>
                    <li class="mb-12"><a href="">設定</a></li>
                </ul>
            @endauth
        </div>

        <div class="w-1/3">
            <h1 class="mt-12 text-4xl">つぶやきを編集</h1>
            <div>
                <a class="mb-4" href="{{ route('tweet.index') }}">< 戻る</a>
                <form action="{{ route('tweet.put', ['tweetId' => $tweet->tweet_id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <label for="tweet-content">つぶやき</label>
                    <span>140文字まで</span>
                    <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力">{{ $tweet->content }}</textarea>
                    @error('tweet')
                    <p style="color: red;">{{ $message }}</p>
                    @enderror
                    <button class="inline-flex justify-center py-2 px-4 border border-transparent 
                                shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 
                                hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">編集</button>
                </form>
            </div>
        </div>

        <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>