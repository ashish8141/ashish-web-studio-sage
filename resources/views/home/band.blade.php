<!-- BAND -->
{{-- Sits right under the work section, hence the short top padding. --}}
<x-cta-band class="pt-6 pb-14" text="You don't have to figure it out alone. Let an AI assistant walk you through what I do and whether it fits your project.">
  <x-slot:heading>Can't decide if I'm the right fit <span class="text-accent">for your business?</span></x-slot:heading>
  <div class="flex flex-wrap gap-2.5">
    <x-button :href="$askChatGptUrl" arrow="&#8599;" class="max-md:w-full max-md:flex-1" target="_blank" rel="noopener">Ask ChatGPT</x-button>
    <x-button :href="$askClaudeUrl" variant="ghost" arrow="&#8599;" class="max-md:w-full max-md:flex-1" target="_blank" rel="noopener">Ask Claude</x-button>
  </div>
</x-cta-band>
