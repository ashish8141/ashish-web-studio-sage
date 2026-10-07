@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <div class="mx-auto max-w-[880px] px-gut pt-18 pb-9" data-reveal>
      <h1 class="text-[clamp(34px,5vw,58px)]/[1.06] tracking-[-.04em]">{!! get_the_title() !!}</h1>
      <div class="mt-3.5 font-mono text-[12px]/[normal] font-medium text-muted">Last updated {{ get_the_modified_date() }}</div>
    </div>

    <div class="mx-auto grid max-w-[1120px] grid-cols-[minmax(0,760px)] justify-center gap-16 px-gut pt-10 pb-6 max-lg:grid-cols-[1fr]">
      {{-- aws-prose: post content styles live in resources/css/sections/content.css --}}
      <article @php(post_class('aws-prose min-w-0'))>
        @php(the_content())
        {!! wp_link_pages(['echo' => 0]) !!}
      </article>
    </div>

    @if (comments_open() || get_comments_number())
      <div class="mx-auto mt-22 max-w-[808px] px-gut pb-sec max-md:mt-14">
        @php(comments_template())
      </div>
    @endif
  @endwhile

  <div class="h-12"></div>
  @include('partials.cta')
@endsection
