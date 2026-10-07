{{-- Plan / fit card. main: accent border and glow (the paid plan); roomy: larger padding used by the pricing cards. --}}
@props(['main' => false, 'roomy' => false])
<div {{ $attributes->class([
  'flex flex-col gap-3.5 rounded-lg border bg-surface',
  'px-7 py-8' => ! $roomy,
  'px-8 py-8.5 max-sm:px-5.5 max-sm:py-7' => $roomy,
  'border-line' => ! $main,
  'border-[rgba(255,77,46,.55)] bg-[linear-gradient(180deg,rgba(255,77,46,.1),rgba(255,77,46,0)_45%)]' => $main,
]) }}>{{ $slot }}</div>