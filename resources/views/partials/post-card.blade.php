{{-- Blog card for the current post in the loop. --}}
<a @class(['aws-rel', 'aws-feature' => $featured]) href="{{ get_permalink() }}">
  <div class="aws-rel-thumb">
    @if (has_post_thumbnail())
      {!! $featured ? get_the_post_thumbnail(null, 'large') : get_the_post_thumbnail(null, 'aws-card', ['loading' => 'lazy']) !!}
    @endif
  </div>
  <div class="aws-rel-meta">
    <div class="aws-rel-kick">{{ $kicker() }}</div>
    <h2 class="aws-rel-t">{!! get_the_title() !!}</h2>
    <div class="aws-blog-d">{{ wp_trim_words(get_the_excerpt(), $featured ? 32 : 20) }}</div>
    <span class="aws-blog-read">{!! $featured ? 'Read the article &rarr;' : 'Read &rarr;' !!}</span>
  </div>
</a>
