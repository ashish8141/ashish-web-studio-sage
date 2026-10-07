<!-- HERO -->
<section class="h-hero h-hero--name">
  <div class="h-aurora" aria-hidden="true"><canvas class="h-aurora-gl"></canvas><i></i><i></i><i></i></div>
  <div class="aws-wrap h-hero-top">
    <h1><span class="h-name">Ashish Jat</span> <span class="h-role">Website design and development consultant</span></h1>
    <p class="h-hero-sub">I take your website from brand and design to build and launch on WordPress, Shopify, Webflow and Framer, using AI-native tools to ship in days, not months.</p>
    <div class="h-hero-actions">
      <a class="aws-btn aws-btn--accent" href="#contact">Book a call <span class="arr">&rarr;</span></a>
      <a class="aws-btn aws-btn--ghost" href="#work">See my work</a>
    </div>
  </div>
  <div class="aws-wrap">
    <div class="h-duo">
      @foreach ($heroCards as $card)
        <a class="h-duo-card" href="{{ $card['url'] }}" target="_blank" rel="noopener">
          <span class="h-duo-shot"><img src="{{ $card['image'] }}" srcset="{{ $card['image640'] }} 640w, {{ $card['image'] }} 1200w" sizes="(max-width: 760px) 100vw, 576px" alt="{{ $card['alt'] }}" width="1200" height="750" decoding="async" @if ($card['priority']) fetchpriority="high" @endif></span>
          <span class="h-duo-meta"><b>{{ $card['name'] }}</b><span>{{ $card['type'] }}</span></span>
        </a>
      @endforeach
    </div>
  </div>
</section>
