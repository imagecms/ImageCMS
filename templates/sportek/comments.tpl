{if $comments_arr}
<div class="comments">
    {foreach $comments_arr as $comment}
    <div class="comment text">
        <p>{$comment.text}</p>
        <cite>{date('H:i, d.m.Y', $comment.date)}, <span>{$comment.user_name}</span></cite>
    </div>
    {/foreach}
</div>
{/if}


{if $comment_errors}
<div class="errors">
    {$comment_errors}
</div>
{/if}
<div class="com_title">Оставить отзыв</div>
<form action="" method="post" class="new_user commentForm" id="commentForm">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />
    <input type="hidden" name="redirect" value="{uri_string()}" />

    <dl>
        <dt>Имя:<span>*</span></dt>
        <dd>
            <input type="text" class="b_width required" name="comment_author" value="{$_SESSION['DX_username']}" />
        </dd>
    </dl>
    <dl>
        <dt>Комментарий:<span>*</span></dt>
        <dd>
            <textarea name="comment_text" class="required"></textarea>
        </dd>
    </dl>
    <div class="button"><input type="submit" value="Оставить отзыв" /></div>
    {form_csrf()}
</form>