<!-- BAND -->
{{-- h-band: hook for the "#work + .h-band" top padding in home-band.css. --}}
<x-cta-band class="h-band pb-14" text="You don't have to figure it out alone. Let an AI assistant walk you through what I do and whether it fits your project.">
  <x-slot:heading>Can't decide if I'm the right fit <span class="text-accent">for your business?</span></x-slot:heading>
  <div class="h-band-actions">
    <x-button :href="$askChatGptUrl" arrow="&#8599;" class="max-md:w-full" target="_blank" rel="noopener">Ask ChatGPT</x-button>
    <x-button :href="$askClaudeUrl" variant="ghost" arrow="&#8599;" class="max-md:w-full" target="_blank" rel="noopener">Ask Claude</x-button>
  </div>
</x-cta-band>
