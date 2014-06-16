<ul class="items items-row items-comments">
    {foreach $comments as $comment}
        <li>
            <div class="comment-info">
                <span class="name">{$comment.user_name},</span>
                <span class="date">{date('d.m.Y H:i', $comment.date)}</span>
            </div>
            <div class="comment-text">
                {$comment.text}
            </div>
                <a href="{site_url($comment.url)}#comment_{$comment.id}">{lang('Смотреть','corporate')}</a>
        </li>     
    {/foreach}
</ul>
