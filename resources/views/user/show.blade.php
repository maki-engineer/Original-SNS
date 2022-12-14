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
              @if ($account->id === Auth::id())
                  <li class="mb-12">プロフィール</li>
              @else
                  <li class="mb-12"><a href="{{ route('user.show', ['userId' => Auth::id()]) }}">プロフィール</a></li>
              @endif
              <li class="mb-12"><a href="">設定</a></li>
            </ul>
        @endauth
      </div>

      <div class="w-1/3">
        <div class="flex mt-20">
          <div class="w-1/2">
            <label for="icon" class="block text-sm font-medium text-gray-700">ここにアイコン</label>
            <div class="h-32 w-32 border rounded-full border-gray-900 text-2xl items-center m-4"></div>
          </div>
          <div class="w-1/2">
            <div class="flex">
              <div class="w-1/3">ここにタブ</div>
              <div class="w-1/3">ここにDMマーク</div>
              <div class="w-1/3">
                @if ($account->id === Auth::id())
                    <a href="{{ route('user.update', ['userId' => $account->id]) }}" class="inline-flex justify-center py-2 px-4 border border-transparent 
                                shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 
                                hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">プロフィールを編集</a>
                @else
                    @if ($isFollow)
                        <form action="{{ route('user.unfollow', ['userId' => $account->id]) }}" method="post">
                          @method('DELETE')
                          @csrf
                          <button class="inline-flex justify-center py-2 px-4 border border-transparent 
                                shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 
                                hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">フォローを解除する</button>
                        </form>
                    @else
                        <form action="{{ route('user.follow', ['userId' => $account->id]) }}" method="post">
                          @csrf
                          <button class="inline-flex justify-center py-2 px-4 border border-transparent 
                                shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 
                                hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">フォローする</button>
                        </form>
                    @endif
                @endif
              </div>
            </div>
          </div>
        </div>

        <h1 class="mb-4 text-xl">{{ $account->name }}</h1>
        <p class="mb-4 text-xl">{{ $account->introduction_text }}</p>
        <p class="mb-4 text-xl">ここに好きな項目名</p>

        @if ($account->show_age_obscure === 1)
            <p class="mb-4 text-xl">年齢をあいまいに表示</p>
        @elseif ($account->show_age_obscure === 2)
            <p class="mb-4 text-xl">年齢をはっきりと表示</p>
        @endif

        @if ($account->id === Auth::id())
            <div class="flex">
              <a href="{{ route('user.following', ['userId' => $account->id]) }}" class="mr-4 text-xl">フォロー数：{{ $followingCount }}</a>
              <a href="{{ route('user.followers', ['userId' => $account->id]) }}" class="text-xl">フォロワー数：{{ $followerCount }}</a>
            </div>

            <div class="flex">
              <div class="flex justify-center w-1/2 text-4xl font-bold mt-12 bg-green-700">投稿一覧</div>
              <a href="{{ route('user.likes', ['userId' => $account->id]) }}" class="flex justify-center w-1/2 text-4xl font-bold mt-12">いいね一覧</a>
            </div>

            <div class="bg-white rounded-md shadow-lg mt-12 mb-5">
              <ul>
                @for ($i = 0; $i < count($tweets); $i++)
                    <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                      <div>
                        <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                          {{ $tweets[$i]->user->name }}
                        </span>
                        <div class="text-gray-600">
                          <a href="{{ route('tweet.show', ['tweetId' => $tweets[$i]->tweet_id]) }}">{!! nl2br(e($tweets[$i]->content)) !!}</a>
                          <div class="flex">
                            <img class="mt-2" src="/images/si_Heart_my.svg">

                            <div class="mt-2 ml-2">{{ $goods[$i] }}</div>
                          </div>
                        </div>
                      </div>
                    </li>
                @endfor
              </ul>
            </div>
        @else
            <div class="flex justify-center text-4xl font-bold mt-12">投稿一覧</div>

            <div class="bg-white rounded-md shadow-lg mt-12 mb-5">
              <ul>
                @for ($i = 0; $i < count($tweets); $i++)
                    <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                      <div>
                        <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                          {{ $tweets[$i]->user->name }}
                        </span>
                        <div class="text-gray-600">
                          <a href="{{ route('tweet.show', ['tweetId' => $tweets[$i]->tweet_id]) }}">{!! nl2br(e($tweets[$i]->content)) !!}</a>
                          <div class="flex">
                            @if($isGoods[$i])
                                <form action="{{ route('tweet.unlike', ['tweetId' => $tweets[$i]->tweet_id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"><img class="mt-2" src="/images/si_Heart.svg"></button>
                                </form>
                            @else
                                <form action="{{ route('tweet.like', ['tweetId' => $tweets[$i]->tweet_id]) }}" method="post">
                                    @csrf
                                    <button type="submit"><img class="mt-2" src="/images/si_Heart_alt.svg"></button>
                                </form>
                            @endif
                          </div>
                        </div>
                      </div>
                    </li>
                @endfor
              </ul>
            </div>
        @endif

      </div>

      <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>