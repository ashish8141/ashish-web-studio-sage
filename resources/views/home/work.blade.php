<!-- WORK -->
{{--
  Project grid. Hooks kept for JS (resources/js/fx.js): h-work-grid (+ .is-all toggled by the button, staggered reveal),
  h-work--more (cards revealed by the toggle), h-work-shot img (scroll parallax), h-work-toggle, h-wt-lbl.
  h-wt-ico keeps its plus/minus bars in sections/home-work.css.
--}}
<section id="work" class="border-t border-line pt-sec pb-14 max-md:pb-10" data-reveal>
  <div class="wrap">
    <x-section-head tag="Proof of work">Check out what I've <span class="text-accent">built so far.</span><x-slot:aside><x-link href="#contact">Discuss your project &rarr;</x-link></x-slot:aside></x-section-head>
    <div class="h-work-grid group/grid grid grid-cols-2 gap-5 max-md:grid-cols-1">
      @foreach ($work as $project)
        <a @class([
          'group/work flex-col overflow-hidden rounded-lg border border-line bg-surface [transition:transform_.4s_var(--ease-spring),border-color_.3s] hover:[transform:translateY(-4px)] hover:border-line-2',
          'flex' => ! $project['more'],
          'h-work--more hidden group-[.is-all]/grid:flex' => $project['more'],
        ]) href="{{ $project['url'] }}" target="_blank" rel="noopener">
          <div class="h-work-shot relative aspect-[16/10] overflow-hidden bg-[linear-gradient(135deg,#24201c,#141412)]">
            <img class="absolute inset-x-0 top-[-8%] bottom-0 h-[116%] w-full object-cover object-top [transition:transform_1.2s_var(--ease-spring)] group-hover/work:[transform:scale(1.035)]" src="{{ $project['image'] }}" srcset="{{ $project['image640'] }} 640w, {{ $project['image'] }} 1200w" sizes="(max-width: 760px) 100vw, 570px" alt="{{ $project['alt'] }}" loading="lazy" decoding="async" width="1200" height="750">
            <span class="absolute top-3.5 left-3.5 rounded-full border border-line-2 bg-[rgba(14,14,12,.8)] px-[11px] py-2 font-mono text-[11px]/none font-medium tracking-[.06em] text-ink">{{ $project['category'] }}</span>
            <span class="absolute right-3.5 bottom-3.5 rounded-full bg-accent px-3.5 py-2.5 font-mono text-[12px]/none font-medium text-paper-ink opacity-0 [transform:translateY(10px)] [transition:opacity_.3s,transform_.4s_var(--ease-spring)] group-hover/work:opacity-100 group-hover/work:[transform:none]">Visit site &#8599;</span>
          </div>
          <div class="flex items-center justify-between gap-4.5 px-6 py-5.5 max-md:flex-col max-md:items-start"><h3 class="text-[24px]">{{ $project['name'] }}</h3><p class="max-w-[34ch] text-right text-[14.5px]/[1.45] text-muted max-md:text-left">{{ $project['text'] }}</p></div>
        </a>
      @endforeach
    </div>
    <div class="relative z-2 mt-11 flex items-center justify-center gap-4.5 max-md:mt-8 max-md:gap-2.5"><span class="h-px flex-1 bg-[linear-gradient(90deg,transparent,var(--color-line-2))]" aria-hidden="true"></span><button type="button" class="h-work-toggle group/toggle inline-flex cursor-pointer appearance-none items-center gap-3 rounded-full border border-line-2 bg-surface py-2.5 pr-3 pl-2.5 font-mono text-[13px]/none font-medium tracking-[.02em] text-ink [transition:border-color_.25s,background_.25s,transform_.3s_var(--ease-spring)] hover:[transform:translateY(-2px)] hover:border-accent hover:bg-surface-2 focus-visible:outline-2 focus-visible:outline-offset-3 focus-visible:outline-accent" aria-expanded="false"><span class="h-wt-ico relative size-[30px] flex-none rounded-full bg-accent [transition:transform_.45s_var(--ease-spring)] group-aria-expanded/toggle:[transform:rotate(180deg)]" aria-hidden="true"></span><span class="h-wt-lbl">View more projects</span><span class="inline-flex h-[22px] min-w-[26px] items-center justify-center gap-px rounded-full border border-line-2 bg-bg px-[7px] text-[11px] text-muted before:content-['+'] group-aria-expanded/toggle:hidden">{{ $workMoreCount }}</span></button><span class="h-px flex-1 bg-[linear-gradient(90deg,var(--color-line-2),transparent)]" aria-hidden="true"></span></div>
  </div>
</section>
