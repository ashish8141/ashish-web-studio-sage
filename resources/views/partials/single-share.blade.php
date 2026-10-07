{{--
  Share buttons (clicks are handled in main.js via data-share-group / data-share).
  $shape: "round" (default, 38px circles), "small" (34px circles) or "bar" (equal-width rounded buttons).
--}}
@php($shape ??= 'round')
<div class="flex gap-2" data-share-group>
  @foreach ($shareButtons as $button)
    <button type="button" data-share="{{ $button['network'] }}" @class([
      'grid cursor-pointer place-items-center border border-line-2 bg-transparent text-text [transition:color_.2s,border-color_.2s] hover:border-accent hover:text-accent',
      'size-[38px] rounded-full' => $shape === 'round',
      'size-[34px] rounded-full' => $shape === 'small',
      'h-[38px] flex-1 rounded-[10px]' => $shape === 'bar',
    ]) aria-label="{{ $button['label'] }}">{!! $button['icon'] !!}</button>
  @endforeach
</div>
