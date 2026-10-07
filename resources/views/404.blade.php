@extends('layouts.app')

@section('content')
  {{-- h-hero: glow artwork (shared.css) and JS spotlight hook. --}}
  <section class="h-hero relative min-h-[60vh] overflow-hidden pt-22 pb-18 max-md:pt-12 max-md:pb-14">
    <div class="wrap">
      <x-tag>Error 404</x-tag>
      <h1 class="mt-5.5 mb-6.5 max-w-[18ch] text-[clamp(40px,5.2vw,68px)] leading-[1.04] tracking-[-.04em]">This page took a wrong turn. <span class="text-accent">Let's get you back.</span></h1>
      <p class="h-hero-sub max-w-[52ch] text-[19px]/[1.55] text-text max-md:text-[17px]">The link may be old or mistyped. Try the homepage or the latest writing instead.</p>
      <div class="h-hero-actions mt-8.5 flex flex-wrap items-center gap-3">
        <x-button :href="$homeUrl" arrow class="max-md:flex-[1_1_auto]">Back to home</x-button>
        <x-button :href="$blogUrl" variant="ghost" class="max-md:flex-[1_1_auto]">Read the blog</x-button>
      </div>
    </div>
  </section>
@endsection
