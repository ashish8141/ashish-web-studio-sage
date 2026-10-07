<!-- WRITING -->
@if ($recentPosts)
  <section id="writing" class="aws-sec" data-reveal>
    <div class="aws-wrap">
      <div class="aws-sec-head aws-sec-head--row">
        <div><h2>Writing on building <span class="hl">smarter.</span></h2></div>
        <a class="aws-link" href="{{ $blogUrl }}">All posts &rarr;</a>
      </div>
      <div class="aws-blog-grid">
        @foreach ($recentPosts as $article)
          <a class="aws-rel" href="{{ $article['url'] }}">
            <div class="aws-rel-thumb">{!! $article['thumbnail'] !!}</div>
            <div class="aws-rel-meta">
              <div class="aws-rel-kick">{!! esc_html($article['kicker']) !!}</div>
              <h3 class="aws-rel-t">{!! esc_html($article['title']) !!}</h3>
              <span class="aws-blog-read">Read the article &rarr;</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
@endif
