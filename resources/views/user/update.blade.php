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
              @if ($account->user_id === Auth::id())
                  <li class="mb-12">プロフィール</li>
              @else
                  <li class="mb-12"><a href="{{ route('user.show', ['userId' => Auth::id()]) }}">プロフィール</a></li>
              @endif
              <li class="mb-12"><a href="">設定</a></li>
            </ul>
        @endauth
      </div>

      <div class="w-1/3">
        <form action="{{ route('user.put', ['userId' => $account->id]) }}" method="post">
          @method('PUT')
          @csrf
          <div class="flex mt-20">
            <div class="w-1/2">
              <label for="icon" class="block text-sm font-medium text-gray-700">ここでアイコンを編集</label>
              <div class="h-32 w-32 border rounded-full border-gray-900 text-2xl items-center m-4"></div>
            </div>
            <div class="w-1/2">
              <div class="flex justify-end">
                <button class="inline-flex justify-center py-2 px-4 border border-transparent
                                shadow-sm text-sm font-medium rounded-md text-white bg-blue-500
                                hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">保存</button>
              </div>
            </div>
          </div>

          <div class="col-span-6 sm:col-span-4 py-2">
              <label for="name" class="block text-sm font-medium text-gray-700">ニックネーム</label>
              <input type="text" name="name" id="name" value="{{ $account->name }}" autocomplete="name"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>

          <textarea class="py-2 mt-4" id="introduction_text" type="text" name="introduction_text" placeholder="自己紹介文を入力">{{ $account->introduction_text }}</textarea>

          <div class="col-span-6 sm:col-span-4 py-2">
              <label for="birthday" class="block text-sm font-medium text-gray-700">誕生日</label>
              <input type="date" name="birthday" id="birthday" value="{{ $account->birthday }}"
                  class="mt-1 block w- rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>

          <div class="flex items-start pt-1 pb-0">
              <div class="flex h-5 items-center">
                  <input id="show_age_obscure" name="show_age_obscure" type="checkbox"
                      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
              </div>
              <div class="flex-col ml-3 text-sm">
                  <label for="show_age_obscure" class="font-medium text-gray-700">年齢をあいまいに表示する</label>
              </div>
          </div>
          <small class="font-light text-gray-700">※チェックすると「10 ~ 20歳」のように表示されます</small>

          <div class="flex items-start pt-1 pb-0 mt-3">
              <div class="flex h-5 items-center">
                  <input id="not_show_age" name="not_show_age" type="checkbox"
                      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
              </div>
              <div class="flex-col ml-3 text-sm">
                  <label for="not_show_age" class="font-medium text-gray-700">年齢を表示しない</label>
              </div>
          </div>
        </form>

        <p class="mt-4 text-xl">（ここに好きな項目名を追加するかもしれない）</p>
      </div>

      <div class="w-1/3"><!--ここはもしかしたら余白かな？--></div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>

    <script>
        const show_age_obscure = document.getElementById('show_age_obscure');
        const not_show_age     = document.getElementById('not_show_age');

        show_age_obscure.addEventListener('click', () => {
            if (show_age_obscure.checked) not_show_age.checked = false;
        });

        not_show_age.addEventListener('click', () => {
            if (not_show_age.checked) show_age_obscure.checked = false;
        });
    </script>
</body>
</html>
