@extends('layouts.app')

@section('content')
  <section class="h-hero" style="min-height:60vh">
    <div class="aws-wrap">
      <x-tag>Error 404</x-tag>
      <h1 style="max-width:18ch">This page took a wrong turn. <span class="hl">Let's get you back.</span></h1>
      <p class="h-hero-sub">The link may be old or mistyped. Try the homepage or the latest writing instead.</p>
      <div class="h-hero-actions">
        <x-button :href="$homeUrl" arrow>Back to home</x-button>
        <x-button :href="$blogUrl" variant="ghost">Read the blog</x-button>
      </div>
    </div>
  </section>
@endsection
