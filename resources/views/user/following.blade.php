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
              <li class="mb-12">プロフィール</li>
              <li class="mb-12"><a href="">設定</a></li>
            </ul>
        @endauth
      </div>

      <div class="w-1/3"></div>

      <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>