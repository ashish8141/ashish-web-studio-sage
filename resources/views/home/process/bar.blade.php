{{--
  One sprint step: a bar spanning its days (--l / --w from the row) in the row colour (--c).
  Its ::after is a colour wash that fades in on hover and while the row is .is-active (the "today" line is inside its days).
  Up to 900px the bar is a normal full-width card. h-cal-bar and fx-spot are JS hooks.
--}}
<article @class([
  'h-cal-bar fx-spot absolute inset-y-0 left-(--l) flex w-(--w) flex-col justify-center overflow-hidden',
  'border-r border-l-3 border-r-[color-mix(in_srgb,var(--c)_55%,transparent)] border-l-(--c)',
  'bg-[linear-gradient(90deg,var(--color-surface)_0%,var(--color-surface)_45%,color-mix(in_srgb,var(--c)_10%,var(--color-surface))_100%)]',
  'px-5.5 pt-5.5 pb-5 [transition:background_.4s,box-shadow_.4s,transform_.4s]',
  'group-[.is-active]/row:shadow-[0_18px_40px_rgba(0,0,0,.35),0_0_0_1px_color-mix(in_srgb,var(--c)_40%,transparent)]',
  "after:pointer-events-none after:absolute after:inset-0 after:opacity-0 after:[transition:opacity_.4s] after:content-['']",
  'after:bg-[linear-gradient(90deg,transparent,color-mix(in_srgb,var(--c)_22%,transparent))]',
  'hover:after:opacity-100 group-[.is-active]/row:after:opacity-100',
  'max-tab:relative max-tab:left-0 max-tab:w-full max-tab:py-5 max-tab:pr-16 max-tab:pl-4.5',
])>
  <div class="h-cal-ico absolute top-0 right-0 z-1 flex size-13 items-center justify-center border-b border-l border-line bg-surface-2 text-(--c)" aria-hidden="true">{!! $step['icon'] !!}</div>
  <div class="mb-3.5 inline-block self-start border border-[color-mix(in_srgb,var(--c)_70%,transparent)] px-2 py-1.5 font-mono text-[11px]/none font-medium tracking-[.06em] text-(--c) uppercase">Day {{ $step['from'] }}&ndash;{{ $step['to'] }}</div>
  <h3 class="mb-2 text-[20px]/[1.2] max-tab:text-[19px]">{{ $step['title'] }}</h3>
  <p class="relative z-1 line-clamp-3 text-[14px]/normal text-muted max-tab:block max-tab:[-webkit-line-clamp:unset]">{{ $step['text'] }}</p>
</article>
