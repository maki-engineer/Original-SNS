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
        @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
          <div class="bg-white rounded-md shadow-lg mt-5 mb-5">
            <ul>
              @foreach ($likes as $like)
                @foreach ($like as $users)
                  <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
                    <p>{{ $users->name }}</p>
                  </li>
                @endforeach
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
    <script src="{{ asset('/js/delete_alert.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>