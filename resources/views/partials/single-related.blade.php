@if ($related)
  <div class="aws-related" data-reveal>
    <div class="aws-sec-head aws-sec-head--row" style="margin-bottom:0"><div><h2>Keep reading</h2></div><a class="aws-link" href="{{ $allPostsUrl }}">All posts &rarr;</a></div>
    <div class="aws-blog-grid">
      @foreach ($related as $post)
        <a class="aws-rel" href="{{ $post['url'] }}">
          <div class="aws-rel-thumb">{!! $post['thumbnail'] !!}</div>
          <div class="aws-rel-meta"><div class="aws-rel-kick">{!! $post['kicker'] !!}</div><h3 class="aws-rel-t">{!! $post['title'] !!}</h3></div>
        </a>
      @endforeach
    </div>
  </div>
@endif
