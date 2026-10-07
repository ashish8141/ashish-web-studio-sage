{{--
  Sticky bar, desktop menu with the Services mega menu, burger and mobile flyout.
  JS (main.js) toggles aria-expanded on .aws-burger / .aws-sub-toggle, aria-hidden on #aws-flyout and `hidden` on the
  sub-menu; the open states below hang off those attributes. aws-menu / has-mega carry no CSS: they are hooks for the
  screenshot harness (tools/snap.py).
--}}
@php
  $link = 'block rounded-full px-3.5 py-2.5 [transition:color_.2s,background_.2s] hover:bg-surface-2 hover:text-ink';
  $flyLink = 'block border-b border-line py-4 font-sans text-[24px]/[1.1] font-medium tracking-[-.02em] text-ink hover:text-accent';
  $subLink = 'group/sub-item flex flex-col gap-[3px] border-l-2 py-[11px] pl-3.5 font-sans font-medium tracking-[-.01em] hover:text-accent';
  $megaOpen = 'group-hover/mega:visible group-hover/mega:opacity-100 group-hover/mega:[transform:translate(-50%,0)] group-focus-within/mega:visible group-focus-within/mega:opacity-100 group-focus-within/mega:[transform:translate(-50%,0)]';
  $bar = 'mx-auto block h-0.5 w-4.5 rounded-[2px] bg-ink [transition:transform_.3s_var(--ease-spring),opacity_.2s]';
@endphp

<header class="sticky top-0 z-50 border-b border-line bg-[rgba(14,14,12,.82)] backdrop-blur-[14px]" id="top">
  <div class="wrap flex h-18 items-center justify-between gap-6 max-md:h-16">
    <x-brand :href="$homeUrl" class="[&_img]:max-h-[34px] [&_img]:w-auto">
      @if (has_custom_logo())
        {!! get_custom_logo() !!}
      @else
        {{ $siteName }}<span class="text-accent">.</span>
      @endif
    </x-brand>

    <nav aria-label="{{ __('Primary', 'sage') }}">
      <ul id="primary-menu" class="aws-menu flex items-center gap-1 font-sans text-[14px]/none font-medium max-lg:hidden">
        @foreach ($menu as $item)
          @if ($item['services'])
            <li class="has-mega group/mega relative">
              <a class="{{ $link }} text-text" href="{{ $item['url'] }}" aria-haspopup="true">{{ $item['label'] }} <span class="ml-1.5 inline-block size-1.5 border-r-[1.5px] border-b-[1.5px] border-current [transform:translateY(-2px)_rotate(45deg)] [transition:transform_.25s] group-hover/mega:[transform:translateY(1px)_rotate(225deg)] group-focus-within/mega:[transform:translateY(1px)_rotate(225deg)]" aria-hidden="true"></span></a>
              <div class="{{ $megaOpen }} invisible absolute top-[calc(100%+14px)] left-1/2 grid w-[640px] grid-cols-[1.5fr_1fr] gap-2.5 rounded-[18px] border border-line-2 bg-[#141412] p-2.5 opacity-0 shadow-[0_30px_60px_rgba(0,0,0,.45)] [transform:translate(-50%,8px)] [transition:opacity_.25s,transform_.35s_var(--ease-spring),visibility_.25s] before:absolute before:inset-x-0 before:-top-4 before:h-4 before:content-['']">
                <div class="grid grid-cols-[1fr_1fr] gap-0.5">
                  @foreach ($services as $service)
                    <a class="group/item flex flex-col gap-1 rounded-[12px] px-3.5 py-3 text-text [transition:color_.2s,background_.2s] hover:bg-surface-2 hover:text-ink" href="{{ $service['url'] }}"><b class="font-sans text-[14px]/[1.2] font-medium text-ink group-hover/item:text-accent">{{ $service['title'] }}</b><span class="font-sans text-[12.5px]/[1.35] font-normal text-muted">{{ $service['text'] }}</span></a>
                  @endforeach
                </div>
                <div class="flex flex-col justify-end gap-2 rounded-[12px] border border-[rgba(255,77,46,.3)] p-4.5 [background:linear-gradient(160deg,rgba(255,77,46,.18),rgba(255,77,46,.02)_60%),var(--color-surface)]">
                  <b class="font-sans text-[16px]/[1.2] font-medium text-ink">Not sure what you need?</b>
                  <span class="text-[13px]/[1.4] text-text">One short call and an honest recommendation.</span>
                  {{-- Not x-link: inside the menu the link keeps the menu's colour and transition. --}}
                  <a class="aws-link block self-start border-b border-line-2 pb-1.5 font-mono text-[13px]/none font-medium text-text [transition:color_.2s,background_.2s] hover:border-accent hover:text-ink" href="{{ $bookUrl }}">Book a call &rarr;</a>
                </div>
              </div>
            </li>
          @else
            <li @class(['current-menu-item' => $item['current']])><a @class([$link, 'text-text' => ! $item['current'], 'bg-surface-2 text-ink' => $item['current']]) href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
          @endif
        @endforeach
      </ul>
    </nav>

    <div class="flex items-center gap-2.5">
      <x-button :href="$bookUrl" size="sm" class="max-md:hidden">Book a call</x-button>
      <button class="aws-burger group/burger hidden size-11 cursor-pointer flex-col justify-center gap-[5px] rounded-full border border-line bg-transparent p-0 max-lg:flex" type="button" aria-label="{{ __('Menu', 'sage') }}" aria-expanded="false" aria-controls="aws-flyout"><span class="{{ $bar }} group-aria-expanded/burger:[transform:translateY(7px)_rotate(45deg)]"></span><span class="{{ $bar }} group-aria-expanded/burger:opacity-0"></span><span class="{{ $bar }} group-aria-expanded/burger:[transform:translateY(-7px)_rotate(-45deg)]"></span></button>
    </div>
  </div>
</header>

<div class="invisible fixed inset-x-0 top-18 z-45 max-h-[calc(100vh-64px)] overflow-y-auto border-b border-line bg-bg px-gut pt-3 pb-7 [transform:translateY(-110%)] [transition:transform_.42s_var(--ease-spring)] [-webkit-overflow-scrolling:touch] aria-[hidden=false]:visible aria-[hidden=false]:[transform:translateY(0)] max-md:top-16 supports-[height:100dvh]:max-h-[calc(100dvh-64px)]" id="aws-flyout" aria-hidden="true">
  <ul id="flyout-menu" class="mb-5">
    @foreach ($menu as $item)
      @if ($item['services'])
        <li>
          <button type="button" class="aws-sub-toggle group/sub flex w-full cursor-pointer items-center justify-between border-b border-line py-4 text-left font-sans text-[24px]/[1.1] font-medium tracking-[-.02em] text-ink aria-expanded:text-accent" aria-expanded="false" aria-controls="aws-flyout-services">{{ $item['label'] }} <span class="mr-1.5 inline-block size-[9px] border-r-2 border-b-2 border-current [transform:translateY(-3px)_rotate(45deg)] [transition:transform_.25s] group-aria-expanded/sub:[transform:translateY(2px)_rotate(225deg)]" aria-hidden="true"></span></button>
          <ul class="border-b border-line pt-1.5 pb-2.5" id="aws-flyout-services" hidden>
            @foreach ($services as $service)
              <li><a class="{{ $subLink }} border-line-2 text-[17px]/[1.2] text-ink" href="{{ $service['url'] }}"><b class="font-medium text-ink group-hover/sub-item:text-accent">{{ $service['title'] }}</b><span class="font-sans text-[13.5px]/[1.35] font-normal tracking-normal text-muted">{{ $service['text'] }}</span></a></li>
            @endforeach
            <li><a class="{{ $subLink }} border-transparent text-[15px]/[1.2] text-accent" href="{{ $item['url'] }}">All services &rarr;</a></li>
          </ul>
        </li>
      @else
        <li @class(['current-menu-item' => $item['current']])><a class="{{ $flyLink }}" href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
      @endif
    @endforeach
  </ul>
  <x-button :href="$bookUrl" class="w-full">Book a call</x-button>
</div>
