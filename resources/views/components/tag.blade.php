{{-- Small uppercase pill label. dot: accent dot before the text; tone="paper" for light sections. aws-tag is a JS hook (reveal animations). --}}
@props(['dot' => false, 'tone' => null])

<span {{ $attributes->class([
  'aws-tag inline-flex items-center gap-2 rounded-full border px-3 py-2 font-mono text-[11px]/none font-medium tracking-[.08em] uppercase',
  'border-line-2 text-muted' => $tone !== 'paper',
  'border-paper-line text-[#6d6c65]' => $tone === 'paper',
]) }}>@if ($dot)<span class="size-1.5 rounded-full bg-accent shadow-[0_0_0_4px_rgba(255,77,46,.18)]"></span>@endif{{ $slot }}</span>
