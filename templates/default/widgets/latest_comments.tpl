{foreach $comments as $comment}
    <p>
        {$comment.user_name}: {$comment.text} <a class="arrow" href="{site_url($comment.url)}#comment_{$comment.id}">&rarr;</a>
    </p>
{/foreach}
