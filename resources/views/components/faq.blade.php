{{-- FAQ accordion. items: [['question' => …, 'answer' => …], …]; the first item starts open. h-faq is a JS hook (staggered reveal). --}}
@props(['items' => []])

<div {{ $attributes->class(['h-faq']) }}>
  @foreach ($items as $item)
    <details class="group border-b border-line first:border-t" @if ($loop->first) open @endif>
      <summary class="flex cursor-pointer list-none items-center justify-between gap-5 py-6 font-sans text-[19px]/[1.35] font-medium tracking-[-.015em] text-ink max-md:text-[17px] [&::-webkit-details-marker]:hidden after:grid after:size-8 after:flex-none after:place-items-center after:rounded-full after:border after:border-line-2 after:font-sans after:text-[20px]/none after:font-normal after:text-muted after:content-['+'] after:[transition:transform_.3s_var(--ease-spring),color_.2s,border-color_.2s] group-open:after:border-accent group-open:after:text-accent group-open:after:[transform:rotate(45deg)]">{{ $item['question'] }}</summary>
      <p class="max-w-[64ch] pr-12 pb-6 text-[16px] max-md:pr-0">{{ $item['answer'] }}</p>
    </details>
  @endforeach
</div>
