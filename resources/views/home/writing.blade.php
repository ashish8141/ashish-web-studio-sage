<!-- WRITING -->
@if ($recentPosts)
  <section id="writing" class="border-t border-line py-sec" data-reveal>
    <div class="wrap">
      <x-section-head>Writing on building <span class="text-accent">smarter.</span><x-slot:aside><x-link :href="$blogUrl">All posts &rarr;</x-link></x-slot:aside></x-section-head>
      {{-- aws-blog-grid: JS hook (staggered reveal). Three-up grid; swipeable full-bleed carousel on phones. --}}
      <div class="aws-blog-grid grid grid-cols-3 gap-4.5 max-lg:grid-cols-2 max-md:-mx-gut max-md:flex max-md:snap-x max-md:snap-mandatory max-md:scroll-px-gut max-md:gap-3.5 max-md:overflow-x-auto max-md:px-gut max-md:pb-3 max-md:[-webkit-overflow-scrolling:touch] max-md:[scrollbar-width:none] max-md:[&::-webkit-scrollbar]:hidden">
        @foreach ($recentPosts as $article)
          <x-post-card class="max-md:flex-[0_0_84%] max-md:snap-start" :href="$article['url']" read="Read the article &rarr;">
            <x-slot:thumb>{!! $article['thumbnail'] !!}</x-slot:thumb>
            <x-slot:kicker>{!! esc_html($article['kicker']) !!}</x-slot:kicker>
            <x-slot:title>{!! esc_html($article['title']) !!}</x-slot:title>
          </x-post-card>
        @endforeach
      </div>
    </div>
  </section>
@endif
