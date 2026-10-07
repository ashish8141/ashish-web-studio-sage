<!-- ABOUT -->
<section id="about" class="py-sec" data-reveal>
  {{-- h-about: fx.js staggers its children in on scroll. --}}
  <div class="wrap h-about grid grid-cols-[.85fr_1.15fr] items-center gap-16 max-lg:grid-cols-[1fr] max-lg:gap-11">
    <div class="relative aspect-[4/5] overflow-hidden rounded-lg border border-line max-md:aspect-[4/3.4]"><img class="size-full object-cover max-md:object-[center_30%]" src="{{ $aboutPhoto }}" alt="Ashish at work" loading="lazy" width="640" height="800"></div>
    <div>
      <x-tag>About</x-tag>
      <h2 class="mt-5 mb-5.5 text-[clamp(32px,4vw,48px)]">Hi, I'm Ashish. <span class="text-accent">I start with your business, not the code.</span></h2>
      <p class="mb-4 max-w-[58ch] text-[17.5px]">I don't start with a platform or a template. I start with your business: how you sell, how your team works day to day, and what your website needs to achieve.</p>
      <p class="mb-4 max-w-[58ch] text-[17.5px]">From there I recommend the web technology and system that best fit your workflow and goals, whether that's WordPress, Shopify, Webflow or a custom Next.js app, and build it end to end. No one-size-fits-all stack, just what works best for your business.</p>
      <div class="mt-5.5 mb-1 flex flex-wrap items-center gap-2.5 max-md:gap-2" aria-label="How I choose your tech">@foreach (['Your goals', 'Your workflow', 'The right tech'] as $step)@if (! $loop->first)<i class="text-muted not-italic" aria-hidden="true">&rarr;</i>@endif<span @class([
        'inline-flex items-center gap-2 rounded-[12px] border px-3.5 py-2.5 font-sans text-[14px] leading-[normal] font-medium max-md:px-[11px] max-md:py-[9px] max-md:text-[13px]',
        'border-line-2 bg-surface text-ink' => ! $loop->last,
        'border-accent bg-accent text-paper-ink' => $loop->last,
      ])><b @class(['font-mono text-[11px] leading-[normal] font-medium', 'text-accent' => ! $loop->last, 'text-paper-ink' => $loop->last])>0{{ $loop->iteration }}</b>{{ $step }}</span>@endforeach</div>
      <div class="mt-5.5 flex flex-wrap gap-2"><x-tag>Based in Ahmedabad</x-tag><x-tag>Working worldwide, remote</x-tag><x-tag>8 years in tech</x-tag></div>
      <div class="mt-7.5 border-t border-line pt-6.5">
        <div class="mb-3.5 font-mono text-[11px] leading-[normal] font-medium tracking-[.08em] text-muted uppercase">Tools I reach for</div>
        <div class="flex flex-wrap gap-2.5">
          @foreach ($stack as $tool)
            <span class="inline-flex items-center gap-2 rounded-full border border-line bg-surface py-2 pr-[13px] pl-[9px] font-sans text-[13px]/none font-medium text-ink [&>svg]:size-4.5 [&>svg]:flex-none">{!! $tool['icon'] !!}{{ $tool['name'] }}</span>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
