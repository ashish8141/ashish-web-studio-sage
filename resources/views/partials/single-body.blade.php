<div class="mx-auto grid max-w-[1120px] grid-cols-[minmax(0,1fr)_260px] gap-16 px-gut pt-10 pb-6 max-lg:grid-cols-[1fr]">
  {{-- aws-prose: post content styles live in resources/css/sections/content.css --}}
  <article class="aws-prose min-w-0" id="aws-article" @php(post_class())>
    {!! $content !!}
  </article>

  <aside class="sticky top-[104px] flex flex-col gap-3.5 self-start max-lg:static">
    @if ($toc)
      <div class="rounded-md border border-line bg-surface p-5 max-lg:hidden">
        <div class="mb-3 font-mono text-[11px]/[normal] font-medium tracking-[.1em] text-muted">ON THIS PAGE</div>
        {{-- main.js toggles .is-active on the link of the section being read --}}
        <nav id="aws-toc" class="flex flex-col">
          @foreach ($toc as $item)
            <a href="#{{ $item['id'] }}" data-toc="{{ $item['id'] }}" class="border-l border-line-2 py-[7px] pl-3 text-[14px]/[1.35] text-muted [transition:color_.2s,border-color_.2s] hover:text-ink [&.is-active]:border-l-accent [&.is-active]:text-ink">{!! $item['title'] !!}</a>
          @endforeach
        </nav>
      </div>
    @endif
    @include('partials.single-share', ['shape' => 'bar'])
    <div class="rounded-md border border-[rgba(255,77,46,.4)] p-5 [background:linear-gradient(180deg,rgba(255,77,46,.1),rgba(255,77,46,0)),var(--color-surface)]"><b class="mb-2 block font-sans text-[17px]/[1.3] font-medium tracking-[-.01em] text-ink">Need help with this?</b><p class="mb-3.5 text-[14px]">I build and look after sites like this for businesses worldwide.</p><x-button :href="$bookUrl" size="sm">Book a call</x-button></div>
  </aside>
</div>
