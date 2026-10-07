<!-- CONTACT -->
<x-contact-block tag="Let's talk" :call-url="$callUrl" reveal>
  <x-slot:heading>Let's turn your website into your <span class="text-accent">best salesperson.</span></x-slot:heading>
  <x-slot:lede>Tell me about your business and what you're trying to build. I'll reply within a day with an honest take on the most efficient way to get there.</x-slot:lede>
  <ul class="h-cta-list">
    <li><b>01</b>A short call to understand your goals</li>
    <li><b>02</b>A clear plan, timeline and quote for your requirements</li>
    <li><b>03</b>Build, launch and keep improving together</li>
  </ul>
  <x-slot:social>
    @foreach ($socials as $social)<a class="aws-soc" href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}">{!! $social['icon'] !!}</a>@endforeach
  </x-slot:social>
  <x-slot:form>
    {!! do_shortcode($contactForm) !!}
  </x-slot:form>
</x-contact-block>
