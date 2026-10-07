@props([
  'href' => '#',
  'variant' => 'accent',
  'size' => null,
  'arrow' => false,
])

<a href="{{ $href }}" {{ $attributes->class(['aws-btn', "aws-btn--{$variant}", "aws-btn--{$size}" => $size]) }}>{{ $slot }}@if ($arrow) <span class="arr">&rarr;</span>@endif</a>
