@if ($subscribed)
  <section class="border-b border-[rgba(143,227,168,.35)] bg-[linear-gradient(90deg,rgba(143,227,168,.14),rgba(143,227,168,.04))] py-7" id="welcome">
    <div class="wrap grid grid-cols-[auto_1fr_auto] items-center gap-5.5 max-md:grid-cols-[1fr]">
      <span class="flex size-12 items-center justify-center rounded-full bg-[#8fe3a8] text-paper-ink"><x-rm-check class="size-6 stroke-current stroke-3" /></span>
      <div>
        <h2 class="mb-1.5 text-[24px]">You're subscribed. Welcome aboard.</h2>
        <p class="max-w-[70ch] text-[15px] text-text">Next step: send me your website address and the best way to reach you using the form below. I'll reply within one working day to set up access, book your first Zoom call and share your Notion checklist.</p>
      </div>
      <x-button href="#contact" arrow>Send site details</x-button>
    </div>
  </section>
@endif
