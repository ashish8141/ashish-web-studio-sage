<section class="border-t border-line py-sec">
  <div class="wrap">
    <x-section-head tag="Is this a fit?">Built for sites <span class="text-accent">that matter to the business.</span></x-section-head>
    {{-- r-split: JS hook (staggered reveal). --}}
    <div class="r-split grid grid-cols-[1fr_1fr] gap-4 max-md:grid-cols-[1fr]">
      <x-rm-plan><h3 class="text-[24px]">Good fit</h3><x-rm-list :items="['You already have a live WordPress site', 'Your site brings in leads or sales', 'You want ongoing care instead of firefighting', 'You want to see the work, not take it on trust']" /></x-rm-plan>
      <x-rm-plan><h3 class="text-[24px]">Probably not a fit</h3><x-rm-list no :items="['You need a brand-new site built from scratch', 'You want a single one-off fix', 'Your site isn\'t on WordPress']" /></x-rm-plan>
    </div>
  </div>
</section>
