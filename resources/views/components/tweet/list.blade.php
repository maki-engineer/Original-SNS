@props([
    'tweets' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @foreach($tweets as $tweet)
        <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
            <div>
                <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                    {{ $tweet->user->name }}
                </span>
                <div class="text-gray-600">
                  <a href="{{ route('tweet.show', ['tweetId' => $tweet->tweet_id]) }}">{!! nl2br(e($tweet->content)) !!}</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>