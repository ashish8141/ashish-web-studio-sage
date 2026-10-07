<div class="aws-authorcard" data-reveal>
  <div class="aws-authorcard-inner">
    {!! $avatar !!}
    <div class="aws-abody">
      <div class="aws-akick">WRITTEN BY</div>
      <div class="aws-aname">{!! $authorName !!}</div>
      <p>{!! $bio !!}</p>
      <div class="aws-alinks">
        <a href="{{ $contactUrl }}">work with me &rarr;</a>
        @foreach ($profiles as $profile)
          <a href="{{ $profile['url'] }}" target="_blank" rel="noopener">{{ $profile['label'] }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
