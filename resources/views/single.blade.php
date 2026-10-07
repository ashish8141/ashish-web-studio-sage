@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <!-- ARTICLE HEADER -->
    @include('partials.single-header')

    <!-- COVER -->
    @if (has_post_thumbnail())
      <div class="aws-cover" data-reveal>
        <div class="aws-cover-inner">{!! get_the_post_thumbnail(null, 'full') !!}</div>
      </div>
    @endif

    <!-- BODY + TOC -->
    @include('partials.single-body')

    <!-- AUTHOR BIO -->
    @include('partials.single-author')

    <!-- SHARE DIVIDER -->
    <div class="aws-share-divider">
      <div class="aws-rule"></div>
      <span class="aws-lbl">found this useful? share it</span>
      @include('partials.single-share', ['buttonStyle' => 'width:34px;height:34px'])
      <div class="aws-rule"></div>
    </div>

    <!-- NEWSLETTER -->
    @include('partials.single-newsletter')

    <!-- RELATED -->
    @include('partials.single-related')

    <!-- COMMENTS -->
    <div class="aws-comments">
      @php(comments_template())
    </div>
  @endwhile
@endsection
