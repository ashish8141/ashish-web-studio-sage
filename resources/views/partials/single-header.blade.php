<div class="aws-article-head" data-reveal>
  <a class="aws-back" href="{{ $allPostsUrl }}">&larr; all writing</a>
  @if ($categories)
    <div class="aws-cats">
      @foreach ($categories as $category)
        <a href="{{ $category['url'] }}" class="{{ $category['primary'] ? 'is-primary' : '' }}">{!! $category['name'] !!}</a>
      @endforeach
    </div>
  @endif
  <h1>{!! $title !!}</h1>
  @if (! is_null($excerpt))<p class="aws-dek">{!! $excerpt !!}</p>@endif
  <div class="aws-byline">
    {!! $avatar !!}
    <div style="flex:1">
      <div class="aws-au">{!! $authorName !!}</div>
      <div class="aws-meta">{{ $date }} &middot; {{ $readingTime }}</div>
    </div>
    @include('partials.single-share')
  </div>
</div>
