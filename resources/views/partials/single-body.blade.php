<div class="aws-body-grid">
  <article class="aws-prose" id="aws-article" @php(post_class())>
    {!! $content !!}
  </article>

  <aside class="aws-toc">
    @if ($toc)
      <div class="aws-toc-box">
        <div class="aws-toc-t">ON THIS PAGE</div>
        <nav id="aws-toc">
          @foreach ($toc as $item)
            <a href="#{{ $item['id'] }}" data-toc="{{ $item['id'] }}">{!! $item['title'] !!}</a>
          @endforeach
        </nav>
      </div>
    @endif
    @include('partials.single-share', ['groupStyle' => 'gap:8px', 'buttonStyle' => 'flex:1;border-radius:10px'])
    <div class="aws-toc-cta"><b>Need help with this?</b><p>I build and look after sites like this for businesses worldwide.</p><x-button :href="$bookUrl" size="sm">Book a call</x-button></div>
  </aside>
</div>
