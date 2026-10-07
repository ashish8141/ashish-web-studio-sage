{{--
  Notion-style checkbox with a tick that draws itself in.
  live:  the box is inside a `group` element (or list) that JS marks .is-done (interactive checklist).
         Without it the colours, dash offset and transitions come from retainer.css (hero mock, staggered sequence).
  small: 15px box for sub-items.
--}}
@props(['live' => false, 'small' => false])
<i {{ $attributes->class([
  'flex flex-none items-center justify-center rounded-[4px] border-[1.5px]',
  'size-4.5' => ! $small,
  'size-[15px]' => $small,
  'border-[#c7c6c1] bg-white [transition:background_.3s,border-color_.3s] group-[.is-done]:border-accent group-[.is-done]:bg-accent' => $live,
]) }}><svg viewBox="0 0 24 24" @class([
  'fill-none stroke-white stroke-3 [stroke-dasharray:24] [stroke-linecap:round] [stroke-linejoin:round]',
  'size-3' => ! $small,
  'size-2.5' => $small,
  '[stroke-dashoffset:24] [transition:stroke-dashoffset_.35s_.1s] group-[.is-done]:[stroke-dashoffset:0]' => $live,
])><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></i>