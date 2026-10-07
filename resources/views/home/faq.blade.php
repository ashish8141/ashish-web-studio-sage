<!-- FAQ -->
<section id="faq" class="aws-sec" data-reveal>
  <div class="aws-wrap h-faq-grid">
    <div class="aws-sec-head">
      <x-tag>FAQ</x-tag>
      <h2>Questions, <span class="hl">answered.</span></h2>
      <p>Can't find yours? Ask me on a call, I'm happy to help.</p>
    </div>
    <div class="h-faq">
      @foreach ($faqs as $faq)
        <details @if ($loop->first) open @endif><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>
      @endforeach
    </div>
  </div>
  <script type="application/ld+json">{!! wp_json_encode($faqSchema) !!}</script>
</section>
