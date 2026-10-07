<section id="checklist" class="border-t border-line py-sec">
  <div class="wrap grid grid-cols-[.8fr_1.2fr] items-start gap-16 max-[1001px]:grid-cols-[1fr] max-[1001px]:gap-9">
    <div class="sticky top-[110px] max-[1001px]:static">
      <x-section-head tag="The part that is different">
        Every check, <span class="text-accent">ticked off where you can see it.</span>
        <x-slot:lede>This is the exact checklist I run on your site. It lives in a Notion page shared with you, and every item gets ticked as it is done. Open it any time and you see what was checked, and when.</x-slot:lede>
      </x-section-head>
      <div class="mt-2 grid grid-cols-[repeat(3,1fr)] gap-px overflow-hidden rounded-md border border-line bg-line">
        @foreach (['fortnightly' => 'checks every<br>2 weeks', 'monthly' => 'checks<br>every month', 'seo' => 'SEO checks<br>every month'] as $key => $label)
          <div class="bg-surface px-4.5 py-5 max-sm:px-3 max-sm:py-4"><b class="block font-sans text-[44px]/none font-medium tracking-[-.04em] text-accent max-sm:text-[34px]">{{ $groups[$key]['count'] }}</b><span class="mt-2.5 block font-mono text-[11px]/[1.4] font-medium tracking-[.04em] text-muted uppercase max-sm:text-[9.5px]">{!! $label !!}</span></div>
        @endforeach
      </div>
    </div>
    {{-- Hooks for the script in retainer/scripts: [data-rm-checklist], .rm-cl-tabs button (.is-on), .rm-cl-n, .rm-cl-prog em, .rm-cl-group, .rm-cl-it / .rm-cl-sub (.is-done). --}}
    <x-rm-doc title="Checklist to complete system" scroll data-rm-checklist>
      <div class="rm-cl-tabs mt-4.5 mb-4 flex flex-wrap gap-1.5" role="tablist">
        @foreach (['all' => ['tab' => 'All', 'count' => $total]] + $groups as $key => $group)
          <button type="button" @class(['is-on' => $loop->first, 'group inline-flex cursor-pointer items-center gap-1.5 rounded-full border border-[#e3e2de] px-3 py-2 font-sans text-[13px]/none font-medium text-[#37352f] [transition:background_.2s,color_.2s,border-color_.2s] hover:bg-[#efeeea] [&.is-on]:border-[#1f1e1b] [&.is-on]:bg-[#1f1e1b] [&.is-on]:text-white']) data-f="{{ $key }}">{{ $group['tab'] }} <i class="font-mono text-[11px]/none font-medium text-[#9b9a97] not-italic group-[.is-on]:text-accent-2">{{ $group['count'] }}</i></button>
        @endforeach
      </div>
      <div class="rm-cl-prog mb-2 flex items-center gap-3.5 text-[13px] text-[#787774]"><span><b class="rm-cl-n text-[#1f1e1b] tabular-nums">0</b> of {{ $total }} done</span><div class="h-1.5 flex-1 overflow-hidden rounded-sm bg-[#e9e8e4]"><em class="block h-full origin-left bg-accent [transform:scaleX(0)] [transition:transform_.5s]"></em></div></div>
      @foreach ($groups as $key => $group)
        <div class="rm-cl-group pt-3.5" data-g="{{ $key }}">
          <h3 class="mt-2 mb-1.5 font-mono text-[12px]/none font-semibold tracking-[.06em] text-accent uppercase">{{ $group['title'] }}</h3>
          <ul>
            @foreach ($group['items'] as $item)
              <li class="border-b border-[#efeeea]"><button type="button" class="rm-cl-it group flex w-full cursor-pointer appearance-none items-center gap-3 rounded-sm px-1 py-2.5 text-start text-[15px] text-[#37352f] [transition:background_.2s,color_.3s] hover:bg-[#efeeea] focus-visible:outline-offset-2" aria-pressed="false"><x-rm-tick live /><span class="group-[.is-done]:text-[#9b9a97] group-[.is-done]:line-through group-[.is-done]:decoration-[#c7c6c1]">{{ $item['label'] }}</span></button>
                @if ($item['sub'])<ul class="rm-cl-sub group mb-2 ml-8.5">@foreach ($item['sub'] as $sub)<li class="flex items-center gap-2.5 py-[5px] text-[14px] text-[#787774]"><x-rm-tick live small />{{ $sub }}</li>@endforeach</ul>@endif
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </x-rm-doc>
  </div>
</section>
