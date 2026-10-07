<!-- WORK -->
{{-- Bottom padding comes from #work in sections/home-work.css. --}}
<section id="work" class="border-t border-line pt-sec" data-reveal>
  <div class="wrap">
    <x-section-head tag="Proof of work">Check out what I've <span class="text-accent">built so far.</span><x-slot:aside><x-link href="#contact">Discuss your project &rarr;</x-link></x-slot:aside></x-section-head>
    <div class="h-work-grid">
      @foreach ($work as $project)
        <a @class(['h-work', 'h-work--more' => $project['more']]) href="{{ $project['url'] }}" target="_blank" rel="noopener">
          <div class="h-work-shot">
            <img src="{{ $project['image'] }}" srcset="{{ $project['image640'] }} 640w, {{ $project['image'] }} 1200w" sizes="(max-width: 760px) 100vw, 570px" alt="{{ $project['alt'] }}" loading="lazy" decoding="async" width="1200" height="750">
            <span class="h-work-cat">{{ $project['category'] }}</span>
            <span class="h-work-go">Visit site &#8599;</span>
          </div>
          <div class="h-work-meta"><h3>{{ $project['name'] }}</h3><p>{{ $project['text'] }}</p></div>
        </a>
      @endforeach
    </div>
    <div class="h-work-more"><span class="h-work-more-line" aria-hidden="true"></span><button type="button" class="h-work-toggle" aria-expanded="false"><span class="h-wt-ico" aria-hidden="true"></span><span class="h-wt-lbl">View more projects</span><span class="h-wt-count">{{ $workMoreCount }}</span></button><span class="h-work-more-line" aria-hidden="true"></span></div>
  </div>
</section>
