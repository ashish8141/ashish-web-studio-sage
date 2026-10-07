{{--
  Blog card. Props: href, heading (h3), read (optional "Read →" label, HTML allowed),
  featured (wide two-column layout with a larger title; stacks below 1025px).
  Slots: thumb (image HTML), kicker, title, default = optional extra content between title and read label (e.g. excerpt).
--}}
@props(['href' => '#', 'heading' => 'h3', 'read' => null, 'featured' => false, 'thumb' => null, 'kicker' => null, 'title' => null])

<a href="{{ $href }}" {{ $attributes->class([
  'group overflow-hidden rounded-lg border border-line bg-surface hover:border-line-2 hover:[transform:translateY(-4px)]',
  'flex flex-col [transition:transform_.35s_var(--ease-spring),border-color_.3s]' => ! $featured,
  'mb-4.5 grid grid-cols-[1.2fr_1fr] [transition:border-color_.3s] max-lg:grid-cols-1' => $featured,
]) }}>
  <div @class([
    'overflow-hidden bg-[linear-gradient(135deg,#2a211c,#161614)] [&_img]:size-full [&_img]:object-cover [&_img]:[transition:transform_1s_var(--ease-spring)] group-hover:[&_img]:[transform:scale(1.04)]',
    'aspect-[16/9]' => ! $featured,
    'min-h-[320px] max-lg:aspect-[16/9] max-lg:min-h-0' => $featured,
  ])>{{ $thumb }}</div>
  <div @class(['flex flex-1 flex-col gap-3', 'px-5.5 pt-5.5 pb-6' => ! $featured, 'justify-center p-9' => $featured])>
    <div class="font-mono text-[11px]/none font-medium tracking-[.08em] text-muted">{{ $kicker }}</div>
    <{{ $heading }} @class(['m-0 font-sans font-medium tracking-[-.02em] text-ink', 'text-[20px]/[1.25]' => ! $featured, 'text-[clamp(24px,2.6vw,34px)]/[1.15]' => $featured])>{{ $title }}</{{ $heading }}>
    {{ $slot }}
    @if ($read)<span class="mt-auto pt-1.5 font-mono text-[12px] leading-[normal] font-medium text-accent">{!! $read !!}</span>@endif
  </div>
</a>
