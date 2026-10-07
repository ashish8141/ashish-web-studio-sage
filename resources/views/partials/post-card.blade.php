{{-- Blog card for the current post in the loop. $featured: wide two-column card that opens the first page of the blog. --}}
<x-post-card :href="get_permalink()" heading="h2" :featured="$featured" :read="$featured ? 'Read the article &rarr;' : 'Read &rarr;'">
  <x-slot:thumb>@if (has_post_thumbnail()){!! $featured ? get_the_post_thumbnail(null, 'large') : get_the_post_thumbnail(null, 'aws-card', ['loading' => 'lazy']) !!}@endif</x-slot:thumb>
  <x-slot:kicker>{{ $kicker() }}</x-slot:kicker>
  <x-slot:title>{!! get_the_title() !!}</x-slot:title>
  <div class="text-[15px]/[1.55] text-text">{{ wp_trim_words(get_the_excerpt(), $featured ? 32 : 20) }}</div>
</x-post-card>
