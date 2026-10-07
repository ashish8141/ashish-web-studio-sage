<section id="pricing" class="border-t border-line py-sec">
  <div class="wrap">
    <x-section-head tag="Pricing">One plan. <span class="text-accent">One flat rate.</span></x-section-head>
    {{-- r-split: JS hook (staggered reveal). --}}
    <div class="r-split grid grid-cols-[1fr_1fr] items-stretch gap-4 max-md:grid-cols-[1fr]">
      <x-rm-plan main roomy>
        <div class="flex items-center justify-between"><span class="inline-block font-mono text-[11px]/none font-medium tracking-[.08em] text-accent uppercase">WordPress maintenance</span><span class="rounded-full bg-accent px-2.5 py-1.5 font-mono text-[10px]/none font-medium tracking-[.06em] text-paper-ink uppercase">One site</span></div>
        <div class="mt-1.5 flex flex-wrap items-center gap-3 rounded-[12px] border border-dashed border-[rgba(143,227,168,.55)] bg-[rgba(143,227,168,.1)] px-3.5 py-2.5"><b class="font-sans text-[15px]/[1.2] font-semibold text-[#8fe3a8]">First month $49</b><span class="font-mono text-[12px]/[1.2] font-medium tracking-[.04em] text-muted uppercase">Intro offer, then ${{ $price }}/month</span></div>
        <div class="mt-1.5 font-sans text-[72px]/none font-medium tracking-[-.04em] text-ink max-sm:text-[56px]">${{ $price }}<small class="ml-1.5 font-mono text-[13px] leading-[normal] font-medium tracking-normal text-muted">per month</small></div>
        <p class="text-[15px]">The full checklist on one WordPress site. Your first month is $49, then ${{ $price }} a month. Cancel anytime.</p>
        <x-rm-list :items="['The ' . $total . '-point checklist, shared in Notion', 'Backups and safe updates every 2 weeks', 'Security, bot and uptime log checks', 'Speed, device, link and 404 checks', 'Form, lead magnet and email tests', 'A monthly SEO check', 'A Zoom call every week', '5 website changes every month']" />
        @if ($paypal['ready'])
          <div class="mt-2.5">
            <div id="rm-paypal" class="max-w-[380px] min-h-12" data-plan="{{ $paypal['planId'] }}" data-return="{{ $paypal['returnUrl'] }}"></div>
            <p class="mt-2.5 text-[13px] text-muted">Secure checkout with PayPal. Pay by PayPal or card, $49 today, then $129 every month. Cancel anytime from your PayPal account.</p>
            <a class="mt-3 inline-block text-[14px] font-medium text-accent" href="#contact">Questions first? Talk to me before you subscribe &rarr;</a>
          </div>
        @else
          <x-button href="#contact" arrow>Get started</x-button>
        @endif
      </x-rm-plan>
      <x-rm-plan roomy>
        <span class="inline-block font-mono text-[11px]/none font-medium tracking-[.08em] text-accent uppercase">Quoted separately</span>
        <h3 class="mt-1 text-[24px]">Bigger work stays outside the plan</h3>
        <p class="text-[15px]">Your monthly rate covers upkeep and five small changes. Anything that builds something new is scoped and quoted on its own, so the plan never creeps up.</p>
        <x-rm-list no :items="['Redesigns and new pages', 'New features and integrations', 'Content writing', 'SEO campaigns']" />
        <x-link :href="$projectUrl" tone="accent" class="mt-auto self-start">Ask about a project &rarr;</x-link>
      </x-rm-plan>
    </div>
  </div>
</section>
