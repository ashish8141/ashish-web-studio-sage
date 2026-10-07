<!-- ABOUT -->
<section id="about" class="aws-sec" data-reveal>
  <div class="aws-wrap h-about">
    <div class="h-about-photo"><img src="{{ $aboutPhoto }}" alt="Ashish at work" loading="lazy" width="640" height="800"></div>
    <div>
      <x-tag>About</x-tag>
      <h2>Hi, I'm Ashish. <span class="hl">I start with your business, not the code.</span></h2>
      <p>I don't start with a platform or a template. I start with your business: how you sell, how your team works day to day, and what your website needs to achieve.</p>
      <p>From there I recommend the web technology and system that best fit your workflow and goals, whether that's WordPress, Shopify, Webflow or a custom Next.js app, and build it end to end. No one-size-fits-all stack, just what works best for your business.</p>
      <div class="h-about-flow" aria-label="How I choose your tech"><span><b>01</b>Your goals</span><i aria-hidden="true">&rarr;</i><span><b>02</b>Your workflow</span><i aria-hidden="true">&rarr;</i><span class="is-hl"><b>03</b>The right tech</span></div>
      <div class="h-about-meta"><span class="aws-tag">Based in Ahmedabad</span><span class="aws-tag">Working worldwide, remote</span><span class="aws-tag">8 years in tech</span></div>
      <div class="h-stack">
        <div class="h-stack-t">Tools I reach for</div>
        <div class="h-stack-list">
          @foreach ($stack as $tool)
            <span>{!! $tool['icon'] !!}{{ $tool['name'] }}</span>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
