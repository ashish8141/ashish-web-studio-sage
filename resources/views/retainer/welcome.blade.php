@if ($subscribed)
  <section class="rm-welcome" id="welcome">
    <div class="wrap rm-welcome-in">
      <span class="rm-welcome-ic">{!! $check !!}</span>
      <div>
        <h2>You're subscribed. Welcome aboard.</h2>
        <p>Next step: send me your website address and the best way to reach you using the form below. I'll reply within one working day to set up access, book your first Zoom call and share your Notion checklist.</p>
      </div>
      <x-button href="#contact" arrow>Send site details</x-button>
    </div>
  </section>
@endif
