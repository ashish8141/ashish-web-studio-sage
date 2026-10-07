<section class="border-t border-line py-sec">
  <div class="wrap grid grid-cols-[.8fr_1.2fr] items-start gap-16 max-lg:grid-cols-1 max-lg:gap-11">
    <x-section-head tag="FAQ" class="sticky top-[110px] mb-0 max-lg:static">Questions, <span class="text-accent">answered.</span></x-section-head>
    <x-faq :items="$faqs" />
  </div>
</section>
<script type="application/ld+json">{!! wp_json_encode($faqSchema) !!}</script>
