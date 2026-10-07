@php
  $fields = [
    ['type' => 'text', 'name' => 'FNAME', 'placeholder' => 'first name', 'label' => 'First name', 'required' => false, 'class' => 'min-w-[140px] flex-1'],
    ['type' => 'text', 'name' => 'LNAME', 'placeholder' => 'last name', 'label' => 'Last name', 'required' => false, 'class' => 'min-w-[140px] flex-1'],
    ['type' => 'email', 'name' => 'EMAIL', 'placeholder' => 'you@email.com', 'label' => 'Email address', 'required' => true, 'class' => 'basis-full'],
  ];
@endphp
<div class="mx-auto mt-16 max-w-[1120px] px-gut" data-reveal>
  <div class="relative overflow-hidden rounded-lg border border-line-2 bg-surface p-14 text-center before:pointer-events-none before:absolute before:top-[-420px] before:left-1/2 before:size-[640px] before:bg-[radial-gradient(closest-side,rgba(255,77,46,.22),transparent)] before:content-[''] before:[transform:translateX(-50%)] max-md:px-5 max-md:py-9">
    <div class="hidden"></div>
    <div class="relative">
      <x-tag dot>The newsletter</x-tag>
      <h2 class="mx-auto mt-4.5 mb-3.5 max-w-[22ch] text-[clamp(26px,3.2vw,38px)]">Managing the tech side of your business?</h2>
      <p class="mx-auto mb-6 max-w-[54ch]">Subscribe for regular, practical notes on the tech side of running a business: insights, workflows and tips. No spam, unsubscribe anytime.</p>
      <form class="mx-auto flex max-w-[560px] flex-wrap gap-2.5" action="https://ashishwebstudio.us8.list-manage.com/subscribe/post?u=6baef8414e8c7cb089b3680c5&amp;id=1423da5632&amp;f_id=002316e1f0" method="post" data-news-form novalidate>
        @foreach ($fields as $field)
          <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}" @if ($field['required']) required @endif aria-label="{{ $field['label'] }}" class="{{ $field['class'] }} rounded-[10px] border border-line-2 bg-bg px-4 py-3.5 font-sans text-[16px]/[normal] font-normal text-ink focus:border-accent focus:outline-none">
        @endforeach
        <div aria-hidden="true" class="absolute left-[-5000px]"><input type="text" name="b_6baef8414e8c7cb089b3680c5_1423da5632" tabindex="-1" value=""></div>
        <button type="submit" class="basis-full cursor-pointer rounded-full border-0 bg-accent px-6 py-4 font-mono text-[13px]/[normal] font-medium text-paper-ink">follow along</button>
      </form>
      <p class="mx-auto mt-4 max-w-[52ch] font-mono text-[12px]/[1.6] font-normal text-[rgba(247,246,243,.55)]">By subscribing you agree to receive occasional emails from me. No spam, unsubscribe anytime. See the <a href="{{ $privacyUrl }}" class="text-[rgba(247,246,243,.8)] underline underline-offset-[3px]">privacy policy</a>.</p>
      {{-- main.js writes the result here and sets its colour/opacity inline --}}
      <div data-news-msg role="status" aria-live="polite" class="mt-3.5 min-h-[1em] font-mono text-[14px]/normal font-medium text-[#f7f6f3] opacity-0 [transition:opacity_.4s_ease]"></div>
    </div>
  </div>
</div>
