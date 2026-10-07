{{-- Underlined mono text link. tone: null (ink) | "paper" (light sections) | "accent". aws-link is a hook for JS and section CSS. --}}
@props(['href' => '#', 'tone' => null])

<a href="{{ $href }}" {{ $attributes->class([
  'aws-link border-b pb-1.5 font-mono text-[13px]/none font-medium [transition:color_.2s,border-color_.2s] hover:border-accent hover:text-accent max-md:inline-block max-md:pt-3 max-md:pb-2',
  'border-line-2 text-ink' => ! $tone,
  'border-line-2 text-accent' => $tone === 'accent',
  'border-[#c9c8c0] text-paper-ink' => $tone === 'paper',
]) }}>{{ $slot }}</a>
