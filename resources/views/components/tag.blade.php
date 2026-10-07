@props(['dot' => false])

<span {{ $attributes->class(['aws-tag']) }}>@if ($dot)<span class="dot"></span>@endif{{ $slot }}</span>
