{{-- Infinite horizontal ticker; pauses on hover. items: list of strings (rendered twice for the loop). --}}
@props(['items' => []])

<div {{ $attributes->class(['group overflow-hidden [mask-image:linear-gradient(90deg,transparent,#000_10%,#000_90%,transparent)]']) }}>
  <div class="flex w-max animate-marquee group-hover:[animation-play-state:paused]">
    @foreach ([false, true] as $duplicate)
      <div class="flex items-center gap-14 pr-14" @if ($duplicate) aria-hidden="true" @endif>
        @foreach ($items as $item)<span class="font-sans text-[22px]/none font-semibold tracking-[-.02em] whitespace-nowrap text-[#7d7c75]">{{ $item }}</span>@endforeach
      </div>
    @endforeach
  </div>
</div>
