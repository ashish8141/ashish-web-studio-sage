<!-- HERO -->
{{--
  h-hero: glow artwork (sections/shared.css) + fx.js cursor spotlight (--hx/--hy). h-hero-sub, h-hero-actions, h-duo: fx.js intro timeline.
  h-aurora: main.js draws the WebGL gradient on the canvas and adds .is-gl; the <i> blobs are the CSS fallback (keyframes in home-hero.css).
--}}
<section class="h-hero relative isolate overflow-hidden bg-bg pt-21 pb-18 before:hidden max-md:pt-13 max-md:pb-11">
  <div class="h-aurora group/aurora pointer-events-none absolute inset-x-0 top-0 z-0 h-full overflow-hidden mask-[linear-gradient(#000_50%,transparent_97%)]" aria-hidden="true"><canvas class="h-aurora-gl absolute inset-0 block size-full opacity-0 [transition:opacity_1.2s_ease] group-[.is-gl]/aurora:opacity-[.78]"></canvas>@foreach ([
    'top-[-6vw] right-[-10vw] h-[40vw] w-[54vw] animate-[awsAur2_26s_ease-in-out_infinite_alternate] bg-[radial-gradient(closest-side,rgba(255,77,46,.42),rgba(255,77,46,0))] max-md:top-0 max-md:right-[-50vw] max-md:h-[90vw] max-md:w-[110vw]',
    'top-[10vw] left-[26vw] h-[34vw] w-[48vw] animate-[awsAur3_30s_ease-in-out_infinite_alternate] bg-[radial-gradient(closest-side,rgba(140,30,10,.42),rgba(140,30,10,0))] max-md:top-[50vw] max-md:left-0 max-md:h-[80vw] max-md:w-[100vw]',
    'bg-[radial-gradient(closest-side,rgba(255,120,50,.36),rgba(255,120,50,0))]',
  ] as $blob)<i class="absolute block rounded-[50%] blur-[80px] will-change-transform group-[.is-gl]/aurora:hidden max-md:blur-[56px] {{ $blob }}"></i>@endforeach</div>
  <div class="wrap relative z-1 flex flex-col items-center text-center">
    <h1 class="mx-auto mt-2 mb-5.5 flex flex-col items-center gap-4 leading-none tracking-normal max-md:mt-1 max-md:mb-4.5 max-md:gap-3"><span class="font-serif text-[clamp(54px,7.4vw,104px)]/[1.08] font-medium tracking-[-.025em] text-ink [&_.fx-w]:pb-[.08em]">Ashish Jat</span> <span class="font-sans text-[clamp(18px,2.1vw,27px)]/tight font-medium tracking-[-.015em] text-ink">Website design and development consultant</span></h1>
    <p class="h-hero-sub mx-auto max-w-[56ch] text-[19px]/[1.55] text-text max-md:text-[17px]">I take your website from brand and design to build and launch on WordPress, Shopify, Webflow and Framer, using AI-native tools to ship in days, not months.</p>
    <div class="h-hero-actions mt-8.5 flex flex-wrap items-center justify-center gap-3 max-md:w-full">
      <x-button href="#contact" arrow class="max-md:flex-auto">Book a call</x-button>
      <x-button href="#work" variant="ghost" class="max-md:flex-auto">See my work</x-button>
    </div>
  </div>
  <div class="wrap">
    <div class="h-duo relative z-1 mt-16 grid grid-cols-[1fr_1fr] gap-5 max-md:mt-10 max-md:grid-cols-[1fr] max-md:gap-3.5">
      @foreach ($heroCards as $card)
        <a class="group/duo flex flex-col overflow-hidden rounded-lg border border-line-2 bg-surface shadow-[0_40px_100px_rgba(0,0,0,.5)] [transition:transform_.5s_var(--ease-spring),border-color_.3s] hover:[transform:translateY(-6px)] hover:border-muted focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-accent" href="{{ $card['url'] }}" target="_blank" rel="noopener">
          <span class="block aspect-[16/10] overflow-hidden bg-[linear-gradient(135deg,#24201c,#141412)]"><img class="block size-full object-cover object-top [transition:transform_1.2s_var(--ease-spring)] group-hover/duo:[transform:scale(1.035)]" src="{{ $card['image'] }}" srcset="{{ $card['image640'] }} 640w, {{ $card['image'] }} 1200w" sizes="(max-width: 760px) 100vw, 576px" alt="{{ $card['alt'] }}" width="1200" height="750" decoding="async" @if ($card['priority']) fetchpriority="high" @endif></span>
          <span class="flex items-baseline justify-between gap-4 border-t border-line px-5.5 py-4.5 max-md:px-4 max-md:py-3.5"><b class="font-sans text-[19px]/[1.2] font-medium tracking-[-.01em] text-ink">{{ $card['name'] }}</b><span class="font-mono text-[12px]/none font-medium tracking-[.04em] text-muted">{{ $card['type'] }}</span></span>
        </a>
      @endforeach
    </div>
  </div>
</section>
