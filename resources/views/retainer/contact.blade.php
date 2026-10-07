<x-contact-block tag="Let's talk" :call-url="$callUrl">
  <x-slot:heading>Hand over the upkeep. <span class="text-accent">Keep the visibility.</span></x-slot:heading>
  <x-slot:lede>Tell me about your site and I'll take a quick look before anything is booked. If it's a fit, your first checklist can start this week.</x-slot:lede>
  <x-slot:form>{!! do_shortcode($contactForm) !!}</x-slot:form>
</x-contact-block>
