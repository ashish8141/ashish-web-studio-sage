{{--
  Link grid, animated wordmark and back-to-top button.
  .aws-foot-big / .fb-line / .fb-text / .fb-dot are JS hooks (fx.js types the name in); the dot's state machine and
  keyframes live in sections/footer.css.
--}}
@php
  $columns = [
    ['title' => 'Services', 'links' => array_merge(
      array_map(fn ($label) => ['url' => $servicesUrl, 'label' => $label], ['WordPress sites', 'Shopify stores', 'Web apps', 'Webflow and Framer', 'Website redesign']),
      $maintenanceUrl ? [['url' => $maintenanceUrl, 'label' => 'WordPress maintenance']] : [],
    )],
    ['title' => 'Studio', 'links' => array_values(array_filter($menu, fn ($item) => ! $item['services']))],
    ['title' => 'Connect', 'links' => \App\social_links(), 'external' => true],
  ];
@endphp

<footer class="border-t border-line bg-[#0a0a09] pt-18 pb-9">
  <div class="wrap">
    <div class="grid grid-cols-[1.6fr_1fr_1fr_1fr] gap-10 max-lg:grid-cols-[1fr_1fr] max-md:gap-8">
      <div class="max-lg:col-[1/-1]">
        <x-brand :href="$homeUrl">{{ $siteName }}<span class="text-accent">.</span></x-brand>
        <p class="mt-4 max-w-[34ch] text-[15px] text-muted">Web design and development consultant. I figure out what your business actually needs, then build a website that brings in customers.</p>
        <x-button :href="$bookUrl" arrow class="mt-5.5">Book a call</x-button>
      </div>

      @foreach ($columns as $column)
        <div>
          <h4 class="mb-4.5 font-mono text-[11px]/none font-medium tracking-[.08em] text-muted uppercase">{{ $column['title'] }}</h4>
          <ul class="flex flex-col gap-3">
            @foreach ($column['links'] as $item)
              <li><a class="text-[15px] text-text [transition:color_.2s] hover:text-ink" href="{{ $item['url'] }}" @if ($column['external'] ?? false) target="_blank" rel="noopener" @endif>{{ $item['label'] }}</a></li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    <div class="aws-foot-big group/big mt-18 mb-8 cursor-default overflow-hidden font-sans text-[clamp(48px,11vw,150px)]/[.9] font-semibold tracking-[-.06em] whitespace-nowrap select-none" data-type="Ashish Web Studio" role="img" aria-label="Ashish Web Studio"><span class="fb-line inline-flex min-h-[1.08em] items-baseline pb-[.08em] font-sans text-[120px]/none font-semibold tracking-[-.055em]" aria-hidden="true"><span class="fb-text bg-[linear-gradient(180deg,var(--color-ink)_30%,#6b6a63_120%)] bg-clip-text text-transparent [transition:filter_.6s] group-[.is-done]/big:[filter:drop-shadow(0_0_30px_rgba(255,77,46,.12))]">Ashish Web Studio</span><span class="fb-dot ml-[.06em] inline-block size-[.2em] flex-none self-baseline rounded-[50%] bg-accent [transform:translateY(-.02em)]"></span></span></div>

    <div class="flex flex-wrap justify-between gap-4.5 border-t border-line pt-6 font-mono text-[12px]/[normal] font-medium text-muted max-md:pb-21">
      <span>&copy; {{ date_i18n('Y') }} {{ $siteName }}. Ahmedabad, India, working worldwide.</span>
      <a class="hover:text-ink" href="{{ $privacyUrl }}">Privacy policy</a>
    </div>
  </div>
</footer>

<a href="#top" class="pointer-events-none fixed right-4.5 bottom-4.5 z-40 grid size-11 place-items-center rounded-[50%] border border-line-2 bg-surface-2 text-ink opacity-0 [transform:translateY(10px)] [transition:opacity_.3s,transform_.3s] [&.is-on]:pointer-events-auto [&.is-on]:opacity-100 [&.is-on]:[transform:none]" id="aws-totop" aria-label="Back to top"><svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7"/></svg></a>
