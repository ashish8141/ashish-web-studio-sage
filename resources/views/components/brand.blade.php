{{-- Site wordmark link (header and footer). aws-brand is a hook for the custom-logo image rule in header.css. --}}
@props(['href' => '/'])

<a href="{{ $href }}" {{ $attributes->class(['aws-brand font-sans text-[18px]/none font-bold tracking-[-.03em] whitespace-nowrap text-ink']) }}>{{ $slot }}</a>
