<!-- CONTACT -->
<x-contact-block tag="Let's talk" :call-url="$callUrl" reveal>
  <x-slot:heading>Let's turn your website into your <span class="text-accent">best salesperson.</span></x-slot:heading>
  <x-slot:lede>Tell me about your business and what you're trying to build. I'll reply within a day with an honest take on the most efficient way to get there.</x-slot:lede>
  <ul class="mt-7 flex flex-col gap-3">
    @foreach (['01' => 'A short call to understand your goals', '02' => 'A clear plan, timeline and quote for your requirements', '03' => 'Build, launch and keep improving together'] as $num => $step)
      <li class="flex items-baseline gap-3 text-[16px] text-ink"><b class="font-mono text-[12px] leading-[normal] font-medium text-accent">{{ $num }}</b>{{ $step }}</li>
    @endforeach
  </ul>
  <x-slot:social>
    @foreach ($socials as $social)<a class="grid size-11 place-items-center rounded-full border border-line-2 bg-surface text-text [transition:color_.2s,border-color_.2s,background_.2s,transform_.3s_var(--ease-spring)] hover:border-accent hover:bg-accent hover:text-paper-ink hover:[transform:translateY(-3px)]" href="{{ $social['url'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}">{!! $social['icon'] !!}</a>@endforeach
  </x-slot:social>
  <x-slot:form>
    {!! do_shortcode($contactForm) !!}
  </x-slot:form>
</x-contact-block>
