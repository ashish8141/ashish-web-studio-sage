<section class="aws-sec">
  <div class="aws-wrap h-faq-grid">
    <div class="aws-sec-head"><x-tag>FAQ</x-tag><h2>Questions, <span class="hl">answered.</span></h2></div>
    <div class="h-faq">
      @foreach ($faqs as $faq)<details{!! $loop->first ? ' open' : '' !!}><summary>{{ $faq['question'] }}</summary><p>{{ $faq['answer'] }}</p></details>@endforeach
    </div>
  </div>
</section>
<script type="application/ld+json">{!! wp_json_encode($faqSchema) !!}</script>
