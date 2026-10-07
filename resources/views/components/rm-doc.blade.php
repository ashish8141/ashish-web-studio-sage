{{--
  Light "Notion page" window: browser bar, page title with the tick icon, then the slot.
  Props: title (text), scroll (bool: the page body scrolls inside a 760px window, except on phones).
  Extra classes/attributes land on the window itself (e.g. class="rm-doc--hero fx-viz z-2" aria-label="…").
--}}
@props(['title', 'scroll' => false])
<div {{ $attributes->class(['relative overflow-hidden rounded-md bg-[#f7f6f3] text-[#37352f] shadow-[0_40px_80px_rgba(0,0,0,.45),0_0_0_1px_rgba(255,255,255,.06)]']) }}>
  <div class="flex items-center gap-1.5 border-b border-[#e3e2de] bg-[#ecebe7] px-3.5 py-[11px] font-mono text-[11px]/none font-medium text-[#787774]">
    <i class="size-[9px] rounded-full bg-[#ff5f57]"></i><i class="size-[9px] rounded-full bg-[#febc2e]"></i><i class="size-[9px] rounded-full bg-[#28c840]"></i>
    <span class="ml-2.5 truncate max-sm:hidden">notion.so / web-task-list</span>
    <em class="ml-auto rounded-sm border border-[#e3e2de] bg-white px-2 py-[5px] whitespace-nowrap text-[#37352f] not-italic">Shared with you</em>
  </div>
  <div @class([
    'px-7 pt-6.5 pb-6 max-sm:px-4.5 max-sm:py-5',
    'max-h-[760px] overflow-auto [scrollbar-width:thin] max-sm:max-h-none' => $scroll,
  ])>
    <div class="flex items-center gap-3 font-sans text-[26px]/[1.15] font-semibold tracking-[-.02em] text-[#1f1e1b] max-sm:text-[21px]">
      <span class="flex size-8.5 flex-none items-center justify-center rounded-[8px] bg-accent text-white"><x-rm-check class="size-5 stroke-current stroke-[2.6]" /></span>{{ $title }}
    </div>
    {{ $slot }}
  </div>
</div>