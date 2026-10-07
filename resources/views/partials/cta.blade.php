{{-- Reusable closing CTA band (always the last block of the page). --}}
<x-cta-band class="pt-14 pb-sec" text="One short call, an honest recommendation and a clear next step.">
  <x-slot:heading>Have a project in mind? <span class="text-accent">Let's talk it through.</span></x-slot:heading>
  <x-button :href="$bookUrl" arrow class="max-md:w-full">Book a call</x-button>
</x-cta-band>
