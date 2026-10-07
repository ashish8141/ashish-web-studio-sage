<!-- WRITING -->
@if ($recentPosts)
  <section id="writing" class="border-t border-line py-sec" data-reveal>
    <div class="wrap">
      <x-section-head>Writing on building <span class="text-accent">smarter.</span><x-slot:aside><x-link :href="$blogUrl">All posts &rarr;</x-link></x-slot:aside></x-section-head>
      {{-- aws-blog-grid / aws-rel: grid and mobile carousel live in sections/home-writing.css. --}}
      <div class="aws-blog-grid">
        @foreach ($recentPosts as $article)
          <x-post-card class="aws-rel" :href="$article['url']" read="Read the article &rarr;">
            <x-slot:thumb>{!! $article['thumbnail'] !!}</x-slot:thumb>
            <x-slot:kicker>{!! esc_html($article['kicker']) !!}</x-slot:kicker>
            <x-slot:title>{!! esc_html($article['title']) !!}</x-slot:title>
          </x-post-card>
        @endforeach
      </div>
    </div>
  </section>
@endif
