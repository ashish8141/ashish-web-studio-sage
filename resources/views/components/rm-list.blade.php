{{-- Feature list inside a plan card. items: list of strings. Accent ticks by default; no: muted dashes ("not included"). --}}
@props(['items' => [], 'no' => false])
<ul {{ $attributes->class(['mt-1.5 mb-2.5 flex flex-col gap-2.5']) }}>
  @foreach ($items as $item)
    <li @class([
      "relative pl-6.5 text-[16px] before:absolute before:left-0.5 before:w-2.5 before:content-['']",
      'text-ink before:top-2 before:h-1.5 before:border-b-2 before:border-l-2 before:border-accent before:[transform:rotate(-45deg)]' => ! $no,
      'text-muted before:top-3 before:h-0.5 before:bg-muted' => $no,
    ])>{{ $item }}</li>
  @endforeach
</ul>