{{--
  Closing call-to-action band: heading + text on the left, actions (default slot) on the right.
  Slots: heading (HTML allowed), default = buttons. Props: text. Vertical padding is passed by the caller (class="pt-14 pb-sec").
  h-band-card is a JS hook (heading reveal).
--}}
@props(['text' => null, 'heading' => null])

<div {{ $attributes }} data-reveal>
  <div class="wrap">
    <div class="h-band-card flex flex-wrap items-center justify-between gap-7 rounded-lg border border-line-2 px-11 py-10 [background:linear-gradient(100deg,rgba(255,77,46,.14),rgba(255,77,46,0)_55%),var(--color-surface)] max-md:px-5.5 max-md:py-7">
      <div>
        <h2 class="max-w-[26ch] text-[clamp(24px,2.8vw,34px)]">{{ $heading }}</h2>
        @if ($text)<p class="mt-2 text-text">{{ $text }}</p>@endif
      </div>
      {{ $slot }}
    </div>
  </div>
</div>
