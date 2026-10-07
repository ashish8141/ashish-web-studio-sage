<section id="pricing" class="border-t border-line py-sec">
  <div class="wrap">
    <x-section-head tag="Pricing">One plan. <span class="text-accent">One flat rate.</span></x-section-head>
    <div class="r-split rm-pricing">
      <div class="h-plan h-plan--main rm-plan">
        <div class="rm-plan-top"><span class="rm-k">WordPress maintenance</span><span class="rm-badge">One site</span></div>
        <div class="rm-intro"><b>First month $49</b><span>Intro offer, then ${{ $price }}/month</span></div>
        <div class="h-plan-price rm-plan-price">${{ $price }}<small>per month</small></div>
        <p>The full checklist on one WordPress site. Your first month is $49, then ${{ $price }} a month. Cancel anytime.</p>
        <ul class="r-list"><li>The {{ $total }}-point checklist, shared in Notion</li><li>Backups and safe updates every 2 weeks</li><li>Security, bot and uptime log checks</li><li>Speed, device, link and 404 checks</li><li>Form, lead magnet and email tests</li><li>A monthly SEO check</li><li>A Zoom call every week</li><li>5 website changes every month</li></ul>
        @if ($paypal['ready'])
          <div class="rm-pay">
            <div id="rm-paypal" class="rm-paypal" data-plan="{{ $paypal['planId'] }}" data-return="{{ $paypal['returnUrl'] }}"></div>
            <p class="rm-pay-note">Secure checkout with PayPal. Pay by PayPal or card, $49 today, then $129 every month. Cancel anytime from your PayPal account.</p>
            <a class="rm-pay-alt" href="#contact">Questions first? Talk to me before you subscribe &rarr;</a>
          </div>
        @else
          <x-button href="#contact" arrow>Get started</x-button>
        @endif
      </div>
      <div class="h-plan rm-plan rm-plan--side">
        <span class="rm-k">Quoted separately</span>
        <h3>Bigger work stays outside the plan</h3>
        <p>Your monthly rate covers upkeep and five small changes. Anything that builds something new is scoped and quoted on its own, so the plan never creeps up.</p>
        <ul class="r-list r-list--no"><li>Redesigns and new pages</li><li>New features and integrations</li><li>Content writing</li><li>SEO campaigns</li></ul>
        <x-link :href="$projectUrl" tone="accent">Ask about a project &rarr;</x-link>
      </div>
    </div>
  </div>
</section>
