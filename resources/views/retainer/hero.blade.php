{{-- h-hero: glow artwork (shared.css) and JS spotlight hook; h-hero-sub / h-hero-actions are intro-animation hooks. --}}
<section class="h-hero relative overflow-hidden pt-20 pb-16 max-sm:pt-14 max-sm:pb-12">
  <div class="wrap relative z-1 grid grid-cols-[1.1fr_.9fr] items-center gap-14 max-[1001px]:grid-cols-[1fr] max-[1001px]:gap-11">
    <div>
      <x-tag dot>WordPress maintenance</x-tag>
      <h1 class="mt-5.5 mb-6.5 max-w-[16ch] text-[clamp(40px,5.2vw,68px)]/[1.04] tracking-[-.04em]">WordPress maintenance <span class="text-accent">you can actually see.</span></h1>
      <p class="h-hero-sub max-w-[52ch] text-[19px]/[1.55] text-text max-md:text-[17px]">Every month I work through a {{ $total }}-point checklist on your site and share it with you in Notion, ticked off item by item. Plus a Zoom call every week and five website changes a month. No black box.</p>
      <div class="h-hero-actions mt-8.5 flex flex-wrap items-center gap-3">
        <x-button href="#pricing" arrow class="max-md:flex-auto">Get started</x-button>
        <x-button href="#checklist" variant="ghost" class="max-md:flex-auto">See the checklist</x-button>
      </div>
      <ul class="mt-8.5 flex flex-wrap gap-x-5.5 gap-y-2.5 font-mono text-[12px]/[1.4] font-medium tracking-[.05em] text-muted uppercase">
        <li class="flex items-center gap-2"><b class="mr-1.5 font-sans text-[22px]/none font-medium tracking-[-.02em] text-ink normal-case">$49</b>first month</li>
        <li class="flex items-center gap-2 before:mr-3.5 before:size-1 before:rounded-full before:bg-accent before:content-['']">then ${{ $price }}/month</li>
        <li class="flex items-center gap-2 before:mr-3.5 before:size-1 before:rounded-full before:bg-accent before:content-['']">5 changes/month</li>
      </ul>
    </div>
    {{-- rm-doc--hero / rm-ticks / todo / rm-prog: hooks for the tick-off sequence in retainer.css (runs once fx.js adds .is-in). --}}
    <x-rm-doc title="Web task list" class="rm-doc--hero fx-viz z-2" aria-label="Example of the monthly maintenance checklist shared in Notion">
      <div class="mt-4 mb-3.5 flex flex-wrap gap-x-5.5 gap-y-2 border-b border-[#e9e8e4] pb-3.5 text-[13px]">
        <span class="flex items-center gap-2.5 text-[#37352f]"><b class="font-medium text-[#9b9a97]">Site</b>yourbusiness.com</span>
        <span class="flex items-center gap-2.5 text-[#37352f]"><b class="font-medium text-[#9b9a97]">Status</b><em class="rounded-[4px] bg-[#fde8c8] px-[7px] py-0.5 text-[#8a5a10] not-italic">In progress</em></span>
      </div>
      <ul class="rm-ticks">
        @foreach ([
          ['Backup the site', '2 weeks'],
          ['Update WordPress and plugins', '2 weeks'],
          ['Security log check', '2 weeks'],
          ['Check for broken links', '2 weeks'],
          ['Test functionality of all forms', 'Monthly'],
          ['Run an on-page SEO audit', 'Monthly', 'todo'],
        ] as $tick)
          <li @class(['flex items-center gap-3 py-2 text-[15px] max-sm:text-[14px]', 'todo' => isset($tick[2])])><x-rm-tick />{{ $tick[0] }}<small class="ml-auto rounded-[4px] bg-[#efeeea] px-[7px] py-[5px] font-mono text-[10px]/none font-medium tracking-[.04em] whitespace-nowrap text-[#787774] uppercase">{{ $tick[1] }}</small></li>
        @endforeach
      </ul>
      <div class="mt-3.5 flex items-center gap-4 border-t border-[#e9e8e4] pt-3.5 font-mono text-[12px]/none font-medium text-[#787774]"><span>+{{ $total - 6 }} more checks</span><div class="rm-prog h-1.5 flex-1 overflow-hidden rounded-sm bg-[#e9e8e4]"><em class="block h-full origin-left bg-accent"></em></div></div>
    </x-rm-doc>
  </div>
</section>
