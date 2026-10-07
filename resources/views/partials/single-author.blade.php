<div class="mx-auto mt-10 max-w-[1120px] px-gut" data-reveal>
  <div class="mx-auto flex max-w-[760px] items-start gap-6 rounded-lg border border-line bg-surface p-8 max-md:flex-col max-md:p-6 [&>img]:size-18 [&>img]:rounded-full">
    {!! $avatar !!}
    <div>
      <div class="font-mono text-[11px]/[normal] font-medium tracking-[.1em] text-muted">WRITTEN BY</div>
      <div class="mt-1.5 mb-2.5 font-sans text-[22px]/[normal] font-medium tracking-[-.02em] text-ink">{!! $authorName !!}</div>
      <p class="text-[15.5px]">{!! $bio !!}</p>
      <div class="mt-3.5 flex flex-wrap gap-4.5 font-mono text-[12px]/[normal] font-medium">
        <a href="{{ $contactUrl }}" class="text-accent">work with me &rarr;</a>
        @foreach ($profiles as $profile)
          <a href="{{ $profile['url'] }}" target="_blank" rel="noopener" class="text-text hover:text-accent">{{ $profile['label'] }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
