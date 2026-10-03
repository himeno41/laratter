<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria SkﾅＰdowska-Curie -->
     <x-layouts.app :title="__('Tweet一覧')">
  <div class="p-6">
    <h2 class="font-semibold text-xl mb-4">{{ __('Tweet一覧') }}</h2>

    <form method="GET" action="{{ route('tweets.index') }}" class="mb-4">
      <select name="sort" onchange="this.form.submit()" class="p-2 border rounded">
        <option value="">新着順</option>
        <option value="likes" {{ request('sort') === 'likes' ? 'selected' : '' }}>
          いいねが多い順
        </option>
      </select>
    </form>
    @foreach ($tweets as $tweet)
    <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
      <p>{{ $tweet->tweet }}</p>
      <a href="{{ route('profile.show', $tweet->user) }}">
        <p class="text-sm text-gray-500">投稿者: {{ $tweet->user->name }}</p>
    </a>
      <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
      <div class="flex mt-2">
        @if ($tweet->liked->contains(auth()->id()))
        <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-500 text-2xl hover:text-red-700">
            ♥
          </button>
          <span>{{ $tweet->liked->count() }}</span>
        </form>
        @else
        <form action="{{ route('tweets.like', $tweet) }}" method="POST">
          @csrf
          <button type="submit" class="text-gray-400 text-2xl hover:text-red-500">
            ♡
          </button>
          <span>{{ $tweet->liked->count() }}</span>
        </form>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</x-layouts.app>
