<div class="h-trust" style="padding:26px 0">
  <div class="aws-marquee"><div class="aws-marquee-inner">
    @foreach ([false, true] as $duplicate)
      <div class="aws-marquee-row"{!! $duplicate ? ' aria-hidden="true"' : '' !!}><span>{{ $total }}-point checklist</span><span>Shared with you in Notion</span><span>Backups every 2 weeks</span><span>Weekly Zoom call</span><span>5 website changes a month</span><span>Safe plugin updates</span><span>Security log checks</span><span>Form and email tests</span><span>Monthly SEO check</span><span>One flat rate</span></div>
    @endforeach
  </div></div>
</div>
