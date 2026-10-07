<!-- TRUST -->
<div class="h-trust">
  <div class="h-trust-t">Trusted by founders and teams worldwide</div>
  <div class="aws-marquee">
    <div class="aws-marquee-inner">
      @for ($i = 0; $i < 2; $i++)
        <div class="aws-marquee-row" @if ($i) aria-hidden="true" @endif>
          @foreach ($clients as $client)<span>{{ $client }}</span>@endforeach
        </div>
      @endfor
    </div>
  </div>
</div>
