@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <!-- ARTICLE HEADER -->
    @include('partials.single-header')

    <!-- COVER -->
    @if (has_post_thumbnail())
      <div class="mx-auto mb-3 max-w-[1120px] px-gut" data-reveal>
        <div class="overflow-hidden rounded-lg border border-line [&>img]:w-full">{!! get_the_post_thumbnail(null, 'full') !!}</div>
      </div>
    @endif

    <!-- BODY + TOC -->
    @include('partials.single-body')

    <!-- AUTHOR BIO -->
    @include('partials.single-author')

    <!-- SHARE DIVIDER -->
    <div class="mx-auto mt-12 flex max-w-[760px] items-center gap-4 px-gut">
      <div class="h-px flex-1 bg-line"></div>
      <span class="font-mono text-[11px]/[normal] font-medium tracking-[.06em] whitespace-nowrap text-muted">found this useful? share it</span>
      @include('partials.single-share', ['shape' => 'small'])
      <div class="h-px flex-1 bg-line"></div>
    </div>

    <!-- NEWSLETTER -->
    @include('partials.single-newsletter')

    <!-- RELATED -->
    @include('partials.single-related')

    <!-- COMMENTS -->
    <div class="mx-auto mt-22 max-w-[808px] px-gut pb-sec max-md:mt-14">
      @php(comments_template())
    </div>
  @endwhile
@endsection
