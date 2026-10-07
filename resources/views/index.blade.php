@extends('layouts.app')

@section('content')
  {{-- aws-index-head: JS hook (heading reveal). --}}
  <div class="wrap aws-index-head pt-22 pb-10" data-reveal>
    <x-tag>{{ $isBlogHome ? 'Writing' : 'Archive' }}</x-tag>
    <h1 class="mt-5.5 mb-4.5 text-[clamp(44px,6vw,76px)] tracking-[-.045em]">
      @if ($isBlogHome)
        Notes on building <span class="text-accent">smarter.</span>
      @else
        {!! wp_kses_post(get_the_archive_title()) !!}
      @endif
    </h1>
    <p class="max-w-[56ch] text-[19px]">{{ $blogIntro }}</p>
  </div>

  <section class="wrap pb-sec" data-reveal>
    @if (have_posts())
      @php($featured = $isBlogHome && $isFirstPage)

      @if ($featured)
        @php(the_post())
        @include('partials.post-card', ['featured' => true])
      @endif

      <div class="aws-blog-grid grid grid-cols-3 gap-4.5 max-lg:grid-cols-2 max-md:grid-cols-1">
        @while (have_posts()) @php(the_post())
          @include('partials.post-card', ['featured' => false])
        @endwhile
      </div>

      {!! get_the_posts_pagination(['mid_size' => 1, 'prev_text' => '&larr; Newer', 'next_text' => 'Older &rarr;']) !!}
    @else
      <p class="text-[19px]">No posts yet. Check back soon.</p>
    @endif
  </section>

  @include('partials.cta')
@endsection
