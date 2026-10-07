@unless (post_password_required())
  <div id="comments" class="aws-comments-area">
    @if (have_comments())
      <h2>{{ get_comments_number_text('Comments (0)', 'Comments (1)', 'Comments (%)') }}</h2>

      <ol class="aws-comment-list" style="list-style:none;padding:0;margin:0 0 24px">
        {!! wp_list_comments(['callback' => 'App\\render_comment', 'style' => 'ol', 'avatar_size' => 0, 'echo' => false]) !!}
      </ol>

      {!! get_the_comments_pagination(['prev_text' => '&larr;', 'next_text' => '&rarr;']) !!}
    @else
      <div class="aws-cm-head">
        <h2>{{ __('Join the discussion', 'sage') }}</h2>
        <p>{{ __('Questions, pushback or your own experience. I read and reply to every comment.', 'sage') }}</p>
      </div>
    @endif

    @if (comments_open())
      @php(comment_form([
        'class_form' => 'aws-commentform',
        'title_reply' => '',
        'title_reply_before' => '',
        'title_reply_after' => '',
        'comment_field' => '<textarea id="comment" name="comment" placeholder="Add to the discussion…" required></textarea>',
        'label_submit' => 'Post comment',
        'class_submit' => 'submit',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
      ]))
    @elseif (get_comments_number())
      <p style="font:500 12px 'JetBrains Mono';color:#88877f">{{ __('Comments are closed.', 'sage') }}</p>
    @endif
  </div>
@endunless
