{{--
  Blog card. Props: href, heading (h3), read (optional "Read →" label, HTML allowed).
  Slots: thumb (image HTML), kicker, title, default = optional extra content between title and read label (e.g. excerpt).
--}}
@props(['href' => '#', 'heading' => 'h3', 'read' => null, 'thumb' => null, 'kicker' => null, 'title' => null])

<a href="{{ $href }}" {{ $attributes->class(['group flex flex-col overflow-hidden rounded-lg border border-line bg-surface [transition:transform_.35s_var(--ease-spring),border-color_.3s] hover:border-line-2 hover:[transform:translateY(-4px)]']) }}>
  <div class="aspect-[16/9] overflow-hidden bg-[linear-gradient(135deg,#2a211c,#161614)] [&_img]:size-full [&_img]:object-cover [&_img]:[transition:transform_1s_var(--ease-spring)] group-hover:[&_img]:[transform:scale(1.04)]">{{ $thumb }}</div>
  <div class="flex flex-1 flex-col gap-3 px-5.5 pt-5.5 pb-6">
    <div class="font-mono text-[11px]/none font-medium tracking-[.08em] text-muted">{{ $kicker }}</div>
    <{{ $heading }} class="m-0 font-sans text-[20px]/[1.25] font-medium tracking-[-.02em] text-ink">{{ $title }}</{{ $heading }}>
    {{ $slot }}
    @if ($read)<span class="mt-auto pt-1.5 font-mono text-[12px] leading-[normal] font-medium text-accent">{!! $read !!}</span>@endif
  </div>
</a>
