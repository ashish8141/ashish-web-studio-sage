<section id="checklist" class="aws-sec rm-cl">
  <div class="aws-wrap rm-cl-grid">
    <div class="rm-cl-side">
      <div class="aws-sec-head">
        <x-tag>The part that is different</x-tag>
        <h2>Every check, <span class="hl">ticked off where you can see it.</span></h2>
        <p>This is the exact checklist I run on your site. It lives in a Notion page shared with you, and every item gets ticked as it is done. Open it any time and you see what was checked, and when.</p>
      </div>
      <div class="rm-cl-stats">
        <div><b>{{ $groups['fortnightly']['count'] }}</b><span>checks every<br>2 weeks</span></div>
        <div><b>{{ $groups['monthly']['count'] }}</b><span>checks<br>every month</span></div>
        <div><b>{{ $groups['seo']['count'] }}</b><span>SEO checks<br>every month</span></div>
      </div>
    </div>
    <div class="rm-doc rm-doc--full" data-rm-checklist>
      <div class="rm-doc-bar"><i></i><i></i><i></i><span>notion.so / web-task-list</span><em>Shared with you</em></div>
      <div class="rm-doc-in">
        <div class="rm-doc-title"><span class="rm-doc-ic">{!! $check !!}</span>Checklist to complete system</div>
        <div class="rm-cl-tabs" role="tablist">
          <button type="button" class="is-on" data-f="all">All <i>{{ $total }}</i></button>
          @foreach ($groups as $key => $group)<button type="button" data-f="{{ $key }}">{{ $group['tab'] }} <i>{{ $group['count'] }}</i></button>@endforeach
        </div>
        <div class="rm-cl-prog"><span><b class="rm-cl-n">0</b> of {{ $total }} done</span><div class="rm-prog"><em></em></div></div>
        @foreach ($groups as $key => $group)
          <div class="rm-cl-group" data-g="{{ $key }}">
            <h3>{{ $group['title'] }}</h3>
            <ul>
              @foreach ($group['items'] as $item)
                <li><button type="button" class="rm-cl-it" aria-pressed="false"><i>{!! $check !!}</i><span>{{ $item['label'] }}</span></button>
                  @if ($item['sub'])<ul class="rm-cl-sub">@foreach ($item['sub'] as $sub)<li><i>{!! $check !!}</i>{{ $sub }}</li>@endforeach</ul>@endif
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
