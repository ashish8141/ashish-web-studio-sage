{{-- Share buttons. Optional: $groupStyle and $buttonStyle (inline styles). --}}
<div class="aws-share" data-share-group @isset($groupStyle) style="{{ $groupStyle }}" @endisset>
  @foreach ($shareButtons as $button)
    <button type="button" data-share="{{ $button['network'] }}" @isset($buttonStyle) style="{{ $buttonStyle }}" @endisset aria-label="{{ $button['label'] }}">{!! $button['icon'] !!}</button>
  @endforeach
</div>
