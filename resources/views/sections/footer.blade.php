<footer class="aws-footer">
  <div class="wrap">
    <div class="aws-foot-grid">
      <div class="aws-foot-brand">
        <x-brand :href="$homeUrl">{{ $siteName }}<span class="text-accent">.</span></x-brand>
        <p>Web design and development consultant. I figure out what your business actually needs, then build a website that brings in customers.</p>
        <x-button :href="$bookUrl" arrow>Book a call</x-button>
      </div>

      <div class="aws-foot-col">
        <h4>Services</h4>
        <ul>
          @foreach (['WordPress sites', 'Shopify stores', 'Web apps', 'Webflow and Framer', 'Website redesign'] as $label)
            <li><a href="{{ $servicesUrl }}">{{ $label }}</a></li>
          @endforeach
          @if ($maintenanceUrl)
            <li><a href="{{ $maintenanceUrl }}">WordPress maintenance</a></li>
          @endif
        </ul>
      </div>

      <div class="aws-foot-col">
        <h4>Studio</h4>
        <ul>
          @foreach ($menu as $item)
            @unless ($item['services'])
              <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
            @endunless
          @endforeach
        </ul>
      </div>

      <div class="aws-foot-col">
        <h4>Connect</h4>
        <ul>
          @foreach (\App\social_links() as $social)
            <li><a href="{{ $social['url'] }}" target="_blank" rel="noopener">{{ $social['label'] }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="aws-foot-big" data-type="Ashish Web Studio" role="img" aria-label="Ashish Web Studio"><span class="fb-line" aria-hidden="true"><span class="fb-text">Ashish Web Studio</span><span class="fb-dot"></span></span></div>

    <div class="aws-foot-bottom">
      <span>&copy; {{ date_i18n('Y') }} {{ $siteName }}. Ahmedabad, India, working worldwide.</span>
      <a href="{{ $privacyUrl }}">Privacy policy</a>
    </div>
  </div>
</footer>

<a href="#top" class="aws-totop" id="aws-totop" aria-label="Back to top"><svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" d="M12 19V5M5 12l7-7 7 7"/></svg></a>
