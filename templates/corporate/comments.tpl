{if $comments_arr}
    <div id="detail">
        <h3>{$total_comments}</h3>
        <ul class="items items-row items-comments">
            {foreach $comments_arr as $comment}
                <li id="comment_{$comment.id}">
                    <div class="comment-info">
                        <span class="name">{$comment.user_name},</span>
                        <span class="date">{date('d.m.Y H:i', $comment.date)}</span>
                    </div>
                    <div class="comment-text">
                        {$comment.text}
                    </div>
                </li>
            {/foreach}
        </ul>
    </div>
{/if}
<div class="vertical-form">
    <h3>{lang('Оставить комментарий','corporate')}</h3>
    {if $comment_errors}
        <div class="msg">
            <div class="error">
                <div class="text-el">
                    {$comment_errors}
                </div>
            </div>
        </div>
    {/if}

    {if $can_comment === 1 AND !is_logged_in}
        <p>{lang('Только авторизованные пользователи могут оставлять комментарии.', 'corporate')} 
<a href="{echo site_url($modules.auth)}" class="loginAjax">{lang('Авторизуйтесь', 'corporate')}</a> 
{lang('пожалуйста.', 'corporate')} </p>
    {/if}

    <form action="" method="post">
        <input type="hidden" name="comment_item_id" value="{$item_id}" />
        <input type="hidden" name="redirect" value="{uri_string()}" />

        {if $is_logged_in} 
            <p>{lang('Вы вошли как','corporate')} {$username}. <a href="{site_url('auth/logout')}">{lang('Выход','corporate')}</a></p>         
            {else:}
            <label>
                <span class="title">{lang('Имя', 'corporate')}</span>
                <span class="frame-form-field">
                    <input type="text" name="comment_author" id="comment_author"  value="{if $_POST['comment_author']}{$_POST['comment_author']}{/if}"/>
                </span>
            </label>
            <label>
                <span class="title">Email</span>
                <span class="frame-form-field">
                    <input type="text" name="comment_email" id="comment_email" value="{if $_POST['comment_email']}{$_POST['comment_email']}{/if}"/>
                </span>
            </label>
            <label>
                <span class="title">{lang('Текст комментария', 'corporate')}</span>
                <span class="frame-form-field">
                    <textarea name="comment_text" id="comment_text" rows="10" cols="50"></textarea>
                </span>
            </label>
        {/if}
        {if !$is_logged_in} 
            {if $use_captcha}
                <label>
                    <span class="title">{lang('Код протекции', 'corporate')}</span>
                    <span class="frame-form-field">
                        <input type="text" name="captcha" id="captcha"/>
                    </span>
                    {$cap_image}
                </label>
            {/if}
        {/if}
        <div class="btn">
            <input type="submit" class="submit" value="{lang('Написать','corporate')} &rarr;"/>
        </div>
        {form_csrf()}
    </form>
</div>