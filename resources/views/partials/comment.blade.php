{{-- Rendered by App\render_comment(); WordPress closes the <li>. --}}
<li @php(comment_class('aws-comment', $comment)) id="comment-{{ $comment->comment_ID }}">
  <span class="aws-av"></span>
  <div class="aws-c-body">
    <div style="display:flex;gap:10px;align-items:baseline">
      <span class="aws-c-name">{{ get_comment_author($comment) }}</span>
      <span class="aws-c-when">{{ human_time_diff(get_comment_time('U', false, true, $comment), current_time('timestamp')) }} ago</span>
    </div>

    @if ($comment->comment_approved === '0')
      <p><em>{{ __('Your comment is awaiting moderation.', 'sage') }}</em></p>
    @endif

    @php(comment_text($comment))

    <div style="margin-top:6px;font:500 11px 'JetBrains Mono';">
      {!! get_comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'reply']), $comment) !!}
    </div>
  </div>
