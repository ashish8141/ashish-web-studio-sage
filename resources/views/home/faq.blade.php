<!-- FAQ -->
<section id="faq" class="border-t border-line py-sec" data-reveal>
  <div class="wrap grid grid-cols-[.8fr_1.2fr] items-start gap-16 max-lg:grid-cols-1 max-lg:gap-11">
    <x-section-head tag="FAQ" class="sticky top-[110px] mb-0 max-lg:static">Questions, <span class="text-accent">answered.</span><x-slot:lede>Can't find yours? Ask me on a call, I'm happy to help.</x-slot:lede></x-section-head>
    <x-faq :items="$faqs" />
  </div>
  <script type="application/ld+json">{!! wp_json_encode($faqSchema) !!}</script>
</section>
