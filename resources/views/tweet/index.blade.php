<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <title>original-sns</title>
</head>
<body>
    <div class="flex justify-center">
      <div class="max-w-screen-sm w-full">
        @auth
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <div class="flex justify-end p-4">
              <button class="mt-2 text-sm text-gray-500 hover:text-gray-800"
                      onclick="event.preventDefault(); this.closest('form').submit();">
                ログアウト
              </button>
            </div>
          </form>
        @endauth
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">original-sns</h2>
        @auth
          <div class="p-4">
              @if(session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
              @endif
              <form action="{{ route('tweet.create') }}" method="post">
                  @csrf
                  <div class="mt-1">
                    <textarea name="tweet"
                              rows="3"
                              class="focus:ring-blue-400 focus:border-blue-400 mt-1 block 
                              w-full sm:text-sm border border-gray-300 rounded-md p-2"
                              placeholder="つぶやきを入力"></textarea>
                  </div>

                  <p class="mt-2 text-sm text-gray-500">140文字まで</p>

                  @error('tweet')
                  <div class="w-full mt-1 mb-2 p-2 bg-red-500 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                      </svg>
                      <span class="font-semibold mr-2 text-left flex-auto pl-1">{{ $message }}</span>
                  </div>
                  @enderror

                  <div class="flex flex-wrap justify-end">
                    <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent 
                            shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 
                            hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                      投稿
                    </button>
                  </div>
              </form>
          </div>
        @endauth

        @guest
          <div class="flex flex-wrap justify-center">
            <div class="w-1/2 p-4 flex flex-wrap justify-evenly">
              <x-element.button-a :href="route('login')">ログイン</x-element.button-a>
              <x-element.button-a :href="route('register')" theme="secondary">会員登録</x-element.button-a>
            </div>
          </div>
        @endguest
      </div>
    </div>

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
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>