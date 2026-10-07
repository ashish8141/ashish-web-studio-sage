<header class="aws-header" id="top">
  <div class="aws-wrap aws-header-in">
    <a class="aws-brand" href="{{ $homeUrl }}">
      @if (has_custom_logo())
        {!! get_custom_logo() !!}
      @else
        {{ $siteName }}<span>.</span>
      @endif
    </a>

    <nav aria-label="{{ __('Primary', 'sage') }}">
      <ul id="primary-menu" class="aws-menu">
        @foreach ($menu as $item)
          @if ($item['services'])
            <li class="has-mega">
              <a href="{{ $item['url'] }}" aria-haspopup="true">{{ $item['label'] }} <span class="caret" aria-hidden="true"></span></a>
              <div class="aws-mega">
                <div class="aws-mega-grid">
                  @foreach ($services as $service)
                    <a class="aws-mega-item" href="{{ $service['url'] }}"><b>{{ $service['title'] }}</b><span>{{ $service['text'] }}</span></a>
                  @endforeach
                </div>
                <div class="aws-mega-cta">
                  <b>Not sure what you need?</b>
                  <span>One short call and an honest recommendation.</span>
                  <a class="aws-link" href="{{ $bookUrl }}">Book a call &rarr;</a>
                </div>
              </div>
            </li>
          @else
            <li @class(['current-menu-item' => $item['current']])><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
          @endif
        @endforeach
      </ul>
    </nav>

    <div class="aws-header-actions">
      <x-button :href="$bookUrl" size="sm">Book a call</x-button>
      <button class="aws-burger" type="button" aria-label="{{ __('Menu', 'sage') }}" aria-expanded="false" aria-controls="aws-flyout"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>

<div class="aws-flyout" id="aws-flyout" aria-hidden="true">
  <ul id="flyout-menu" class="aws-flyout-menu">
    @foreach ($menu as $item)
      @if ($item['services'])
        <li class="has-sub">
          <button type="button" class="aws-sub-toggle" aria-expanded="false" aria-controls="aws-flyout-services">{{ $item['label'] }} <span class="caret" aria-hidden="true"></span></button>
          <ul class="aws-sub" id="aws-flyout-services" hidden>
            @foreach ($services as $service)
              <li><a href="{{ $service['url'] }}"><b>{{ $service['title'] }}</b><span>{{ $service['text'] }}</span></a></li>
            @endforeach
            <li><a class="aws-sub-all" href="{{ $item['url'] }}">All services &rarr;</a></li>
          </ul>
        </li>
      @else
        <li @class(['current-menu-item' => $item['current']])><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
      @endif
    @endforeach
  </ul>
  <x-button :href="$bookUrl" style="width:100%">Book a call</x-button>
</div>
