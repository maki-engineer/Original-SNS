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
        <a href="{{ route('user.show', ['userId' => $account->id]) }}" class="mt-12 pl-6 text-4xl"><</a>
        <div class="flex mt-12">
          <a href="{{ route('user.following', ['userId' => $account->id]) }}" class="flex justify-center text-4xl font-bold w-1/2">フォロー中</a>
          <div class="flex justify-center text-4xl font-bold w-1/2 bg-green-700">フォロワー</div>
        </div>

        <div class="bg-white rounded-md shadow-lg mt-12 mb-5">
          <ul>
            @for ($i = 0; $i < count($followers); $i++)
                <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                  {{ $followers[$i]->name }}
                </li>
            @endfor
          </ul>
        </div>
      </div>

      <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>