<section class="h-hero rm-hero">
  <div class="wrap rm-hero-grid">
    <div>
      <x-tag dot>WordPress maintenance</x-tag>
      <h1>WordPress maintenance <span class="text-accent">you can actually see.</span></h1>
      <p class="h-hero-sub">Every month I work through a {{ $total }}-point checklist on your site and share it with you in Notion, ticked off item by item. Plus a Zoom call every week and five website changes a month. No black box.</p>
      <div class="h-hero-actions">
        <x-button href="#pricing" arrow>Get started</x-button>
        <x-button href="#checklist" variant="ghost">See the checklist</x-button>
      </div>
      <ul class="rm-meta"><li><b>$49</b>first month</li><li>then ${{ $price }}/month</li><li>5 changes/month</li></ul>
    </div>
    <div class="rm-doc rm-doc--hero fx-viz" aria-label="Example of the monthly maintenance checklist shared in Notion">
      <div class="rm-doc-bar"><i></i><i></i><i></i><span>notion.so / web-task-list</span><em>Shared with you</em></div>
      <div class="rm-doc-in">
        <div class="rm-doc-title"><span class="rm-doc-ic">{!! $check !!}</span>Web task list</div>
        <div class="rm-doc-props"><span><b>Site</b>yourbusiness.com</span><span><b>Status</b><em class="ok">In progress</em></span></div>
        <ul class="rm-ticks">
          <li><i>{!! $check !!}</i>Backup the site<small>2 weeks</small></li>
          <li><i>{!! $check !!}</i>Update WordPress and plugins<small>2 weeks</small></li>
          <li><i>{!! $check !!}</i>Security log check<small>2 weeks</small></li>
          <li><i>{!! $check !!}</i>Check for broken links<small>2 weeks</small></li>
          <li><i>{!! $check !!}</i>Test functionality of all forms<small>Monthly</small></li>
          <li class="todo"><i>{!! $check !!}</i>Run an on-page SEO audit<small>Monthly</small></li>
        </ul>
        <div class="rm-doc-foot"><span>+{{ $total - 6 }} more checks</span><div class="rm-prog"><em></em></div></div>
      </div>
    </div>
  </div>
</section>
