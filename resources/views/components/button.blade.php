{{--
  Pill button. variant: accent (default) | ghost; size="sm"; arrow (true = right arrow, or pass the glyph, e.g. arrow="&#8599;");
  as="button" renders a <button>. Extra classes/attributes pass through (e.g. class="max-md:w-full").
  aws-btn / aws-btn--accent are hooks for JS (magnetic hover) and for section CSS that still positions buttons.
--}}
@props([
  'href' => '#',
  'variant' => 'accent',
  'size' => null,
  'arrow' => false,
  'as' => 'a',
])

@php($ghost = $variant === 'ghost')
<{{ $as }} @if ($as === 'a') href="{{ $href }}" @endif {{ $attributes->class([
  'aws-btn group/btn inline-flex items-center justify-center gap-2.5 rounded-full border font-mono text-[13px]/none font-medium tracking-[.02em] whitespace-nowrap cursor-pointer',
  '[transition:transform_.25s_var(--ease-spring),background_.2s,border-color_.2s,color_.2s,box-shadow_.25s]',
  'px-6 py-4' => $size !== 'sm',
  'px-4.5 py-3' => $size === 'sm',
  'aws-btn--accent border-transparent bg-accent text-paper-ink hover:[transform:translateY(-2px)] hover:shadow-[0_12px_30px_rgba(255,77,46,.28)]' => ! $ghost,
  'border-line-2 text-ink hover:bg-surface-2 hover:border-muted' => $ghost,
]) }}>{{ $slot }}@if ($arrow) <span class="[transition:transform_.25s_var(--ease-spring)] group-hover/btn:[transform:translateX(3px)]">{!! $arrow === true ? '&rarr;' : $arrow !!}</span>@endif</{{ $as }}>
