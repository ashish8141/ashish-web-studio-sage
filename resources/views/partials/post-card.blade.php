{{-- Blog card for the current post in the loop. --}}
@if ($featured)
  {{-- Featured layout: styled in sections/blog.css. --}}
  <a class="aws-feature" href="{{ get_permalink() }}">
    <div class="aws-rel-thumb">
      @if (has_post_thumbnail())
        {!! get_the_post_thumbnail(null, 'large') !!}
      @endif
    </div>
    <div class="aws-rel-meta">
      <div class="aws-rel-kick">{{ $kicker() }}</div>
      <h2 class="aws-rel-t">{!! get_the_title() !!}</h2>
      <div class="aws-blog-d">{{ wp_trim_words(get_the_excerpt(), 32) }}</div>
      <span class="aws-blog-read">Read the article &rarr;</span>
    </div>
  </a>
@else
  <x-post-card :href="get_permalink()" heading="h2" read="Read &rarr;">
    <x-slot:thumb>@if (has_post_thumbnail()){!! get_the_post_thumbnail(null, 'aws-card', ['loading' => 'lazy']) !!}@endif</x-slot:thumb>
    <x-slot:kicker>{{ $kicker() }}</x-slot:kicker>
    <x-slot:title>{!! get_the_title() !!}</x-slot:title>
    <div class="aws-blog-d">{{ wp_trim_words(get_the_excerpt(), 20) }}</div>
  </x-post-card>
@endif
