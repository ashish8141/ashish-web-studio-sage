<div class="mx-auto max-w-[880px] px-gut pt-18 pb-9" data-reveal>
  <a class="font-mono text-[12px]/[normal] font-medium text-muted hover:text-accent" href="{{ $allPostsUrl }}">&larr; all writing</a>
  @if ($categories)
    <div class="mt-7 mb-4.5 flex flex-wrap gap-2">
      @foreach ($categories as $category)
        <a href="{{ $category['url'] }}" @class([
          'rounded-full border px-3 py-2 font-mono text-[11px]/none font-medium tracking-[.08em] uppercase',
          'border-[rgba(255,77,46,.5)] text-accent' => $category['primary'],
          'border-line-2 text-muted' => ! $category['primary'],
        ])>{!! $category['name'] !!}</a>
      @endforeach
    </div>
  @endif
  <h1 class="text-[clamp(34px,5vw,58px)]/[1.06] tracking-[-.04em]">{!! $title !!}</h1>
  @if (! is_null($excerpt))<p class="mt-5 max-w-[60ch] font-serif text-[21px]/normal font-normal text-text">{!! $excerpt !!}</p>@endif
  <div class="mt-8 flex items-center gap-3.5 border-t border-line pt-6 max-md:flex-wrap [&>img]:size-11 [&>img]:rounded-full">
    {!! $avatar !!}
    <div class="flex-1">
      <div class="font-sans text-[15px]/[normal] font-medium text-ink">{!! $authorName !!}</div>
      <div class="mt-1 font-mono text-[12px]/[normal] font-medium text-muted">{{ $date }} &middot; {{ $readingTime }}</div>
    </div>
    @include('partials.single-share')
  </div>
</div>
