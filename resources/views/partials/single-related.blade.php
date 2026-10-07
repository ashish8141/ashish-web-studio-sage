@if ($related)
  <div class="aws-related" data-reveal>
    <x-section-head class="mb-0">Keep reading<x-slot:aside><x-link :href="$allPostsUrl">All posts &rarr;</x-link></x-slot:aside></x-section-head>
    <div class="aws-blog-grid grid grid-cols-3 gap-4.5 max-lg:grid-cols-2 max-md:grid-cols-1">
      @foreach ($related as $post)
        <x-post-card :href="$post['url']">
          <x-slot:thumb>{!! $post['thumbnail'] !!}</x-slot:thumb>
          <x-slot:kicker>{!! $post['kicker'] !!}</x-slot:kicker>
          <x-slot:title>{!! $post['title'] !!}</x-slot:title>
        </x-post-card>
      @endforeach
    </div>
  </div>
@endif
