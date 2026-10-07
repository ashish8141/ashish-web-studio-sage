{{--
  Contact section (#contact): pitch on the left, form card on the right.
  Props: tag (text), callUrl + callLabel (ghost button under the pitch), reveal (adds data-reveal to both columns).
  Slots: heading (HTML), lede, default = extra content between lede and button (e.g. a list), social = second button row, form.
  h-cta / h-cta-grid are JS hooks (heading and column reveal).
--}}
@props([
  'tag' => null,
  'callUrl' => null,
  'callLabel' => 'Book a call on Calendly',
  'reveal' => false,
  'heading' => null,
  'lede' => null,
  'social' => null,
  'form' => null,
])

<section id="contact" {{ $attributes->class(["h-cta relative overflow-hidden border-t border-line py-sec before:pointer-events-none before:absolute before:-bottom-[560px] before:-left-[300px] before:size-[900px] before:bg-[radial-gradient(closest-side,rgba(255,77,46,.24),rgba(255,154,108,.06)_55%,transparent)] before:content-['']"]) }}>
  <div class="wrap h-cta-grid relative grid grid-cols-2 items-start gap-16 max-lg:grid-cols-1 max-lg:gap-11">
    <div @if ($reveal) data-reveal @endif>
      @if ($tag)<x-tag dot>{{ $tag }}</x-tag>@endif
      <h2 class="my-5.5 max-w-[16ch] text-[clamp(34px,4.6vw,58px)] leading-[1.05]">{{ $heading }}</h2>
      <p class="max-w-[46ch] text-[18px]">{{ $lede }}</p>
      {{ $slot }}
      <div class="mt-8.5 flex flex-col gap-3.5">
        @if ($callUrl)<div class="flex flex-wrap items-center gap-3"><x-button :href="$callUrl" variant="ghost" target="_blank" rel="noopener">{{ $callLabel }}</x-button></div>@endif
        @if ($social)<div class="aws-soc-row flex flex-wrap items-center gap-3">{{ $social }}</div>@endif
      </div>
    </div>
    <div class="aws-contact-form rounded-lg border border-line-2 bg-surface p-8 max-md:p-5.5 [&_p]:max-w-[46ch] [&_p]:text-[18px]" @if ($reveal) data-reveal @endif>{{ $form }}</div>
  </div>
</section>
