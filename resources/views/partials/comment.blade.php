{{-- Rendered by App\render_comment(); WordPress closes the <li>. --}}
<li @php(comment_class('flex gap-3.5 border-t border-line py-4.5', $comment)) id="comment-{{ $comment->comment_ID }}">
  <span class="size-9 flex-none rounded-full bg-[linear-gradient(135deg,var(--color-accent),var(--color-accent-2))]"></span>
  {{-- aws-c-body: comment text (paragraphs, links) is styled in resources/css/sections/content.css --}}
  <div class="aws-c-body">
    <div class="flex items-baseline gap-2.5">
      <span class="font-sans text-[15px]/[normal] font-medium text-ink">{{ get_comment_author($comment) }}</span>
      <span class="font-mono text-[11px]/[normal] font-medium text-muted">{{ human_time_diff(get_comment_time('U', false, true, $comment), current_time('timestamp')) }} ago</span>
    </div>

    @if ($comment->comment_approved === '0')
      <p><em>{{ __('Your comment is awaiting moderation.', 'sage') }}</em></p>
    @endif

    @php(comment_text($comment))

    <div class="mt-1.5 font-mono text-[11px]/[normal] font-medium">
      {!! get_comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'reply']), $comment) !!}
    </div>
  </div>
