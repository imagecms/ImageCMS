{# Comments form for product}

<div style="clear:both;"></div>

{if $comments_arr}
<div class="comments">
    <h5>Отзывы клиентов о товаре</h5>

    {foreach $comments_arr as $comment}
    <div id="comment_{$comment.id}" >
        <b>{$comment.user_name}</b>
        <span>{date('d-m-Y H:i', $comment.date)} </span>
        <p>{$comment.text}</p>
    </div>
    {/foreach}
</div>
{/if}

<h5>{lang('post_comment')}</h5>

{if $comment_errors}
    <div class="errors">
        {$comment_errors}
    </div>
{/if}

{if $can_comment === 1 AND !is_logged_in}
     <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}

<form action="" method="post" class="form commentForm">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />
    <input type="hidden" name="redirect" value="{uri_string()}" />

    {if $is_logged_in}
        <p>{lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></p>
    {else:}
    <p class="clear">
        <label for="comment_author" style="width:140px;" class="left">{lang('lang_comment_author')}</label>
        <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/> <span style="color:red;">*</span>
    </p>

    <p class="clear">
        <label for="comment_email" style="width:140px;" class="left">{lang('lang_comment_email')}</label>
        <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/> <span style="color:red;">*</span>
    </p>

    <p class="clear">
        <label for="comment_site" style="width:140px;" class="left">{lang('lang_comment_site')}</label>
        <input type="text" name="comment_site" id="comment_site" value="{get_cookie('comment_site')}"/>
    </p>
    {/if}

    <p class="clear">
        <label for="comment_text" style="width:140px;" class="left">{lang('lang_comment_text')}</label>
        <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> <span style="color:red;">*</span>
    </p>

    {if $use_captcha}
    <div style="padding-bottom:4px;">
    <p class="clear">
        {if $captcha_type == 'captcha'}
            <label for="captcha" style="width:140px;" class="left">{lang('lang_captcha')}</label>
            <input type="text" name="captcha" id="captcha" />  <span style="color:red;">*</span>
        {/if}
        <br/>
        <label class="left" style="width:140px;" >&nbsp;</label>
        {$cap_image}
    </p>
    </div>
    {/if}

    <p class="clear">
        <label class="left" style="width:140px;" >&nbsp;</label>
        <input type="submit" value="Оставить комментарий"/>
    </p>

    {form_csrf()}
</form>