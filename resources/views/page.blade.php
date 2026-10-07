@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <div class="aws-article-head" data-reveal>
      <h1>{!! get_the_title() !!}</h1>
      <div class="aws-meta" style="margin-top:14px">Last updated {{ get_the_modified_date() }}</div>
    </div>

    <div class="aws-body-grid aws-body-grid--single">
      <article @php(post_class('aws-prose'))>
        @php(the_content())
        {!! wp_link_pages(['echo' => 0]) !!}
      </article>
    </div>

    @if (comments_open() || get_comments_number())
      <div class="aws-comments">
        @php(comments_template())
      </div>
    @endif
  @endwhile

  <div style="height:48px"></div>
  @include('partials.cta')
@endsection
