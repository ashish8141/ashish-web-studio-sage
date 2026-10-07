{{--
  Section heading block: optional tag, heading (default slot, may contain HTML), optional lede, optional right-hand slot.

  Props:  tag (text), dot (bool), level (h2), tone ("paper" on light sections), row (bool, forced on when the aside slot is used)
  Slots:  default = heading, lede = paragraph under the heading, aside = right-hand element of the row variant
  Layout: defaults are max-w-[760px] and mb-12 (mb-8 up to 760px). Passing any mb-* or max-w-* class replaces that default,
          e.g. class="mb-0 max-w-[640px]".
  aws-sec-head / aws-sec-head--row are hooks for the reveal animations in fx.js and for remaining section CSS.
--}}
@props([
  'tag' => null,
  'dot' => false,
  'level' => 'h2',
  'tone' => null,
  'row' => false,
  'lede' => null,
  'aside' => null,
])

@php
  $row = $row || $aside !== null;
  $passed = ' ' . $attributes->get('class', '');
@endphp
<div {{ $attributes->class([
  'aws-sec-head',
  'aws-sec-head--row flex flex-wrap items-end justify-between gap-6' => $row,
  'max-w-[760px]' => ! $row && ! str_contains($passed, ' max-w-'),
  'mb-12 max-md:mb-8' => ! str_contains($passed, ' mb-'),
]) }}>
  @if ($row)<div class="max-w-[720px]">@endif
  @if ($tag)<x-tag :dot="$dot" :tone="$tone" class="mb-5.5">{{ $tag }}</x-tag>@endif
  <{{ $level }} @class(['text-[clamp(32px,4.4vw,52px)]', 'text-paper-ink' => $tone === 'paper'])>{{ $slot }}</{{ $level }}>
  @if ($lede)<p class="mt-4.5 max-w-[60ch] text-[18px] text-text">{{ $lede }}</p>@endif
  @if ($row)</div>{{ $aside }}@endif
</div>
