@props([
    'tweets'  => [],
    'goods'   => [],
    'isGoods' => []
])
<div class="bg-white rounded-md shadow-lg mt-5 mb-5">
    <ul>
        @for($i = 0; $i < count($tweets); $i++)
        <li class="border-b last:border-b-0 border-gray-200 p-4 flex items-start justify-between">
            <div>
                <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs mb-2">
                    <a href="{{ route('user.show', ['userId' => $tweets[$i]->user_id]) }}">{{ $tweets[$i]->user->name }}</a>
                </span>
                <div class="text-gray-600">
                  <a href="{{ route('tweet.show', ['tweetId' => $tweets[$i]->tweet_id]) }}">{!! nl2br(e($tweets[$i]->content)) !!}</a>
                  <div class="flex">
                      @if(Auth::id() === $tweets[$i]->user_id)
                        <img class="mt-2" src="/images/si_Heart_my.svg">
                      @else
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
                      @endif

                      @if(Auth::id() === $tweets[$i]->user_id)
                        <div class="mt-2 ml-2">{{ $goods[$i] }}</div>
                      @endif
                  </div>
                </div>
            </div>
        </li>
        @endfor
    </ul>
</div>