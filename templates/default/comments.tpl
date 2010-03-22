
{if $comments_arr}
<div>
    <h3>{$total_comments}</h3>

    {foreach $comments_arr as $comment}
    <div id="comment_{$comment.id}" class="comment">
        <div class="comment_avatar">
		    <img width="50" class="avatar avatar-86 photo" src="http://www.gravatar.com/avatar.php?gravatar_id={md5($comment.user_mail)}&size=50" alt="" style="float:left;padding:5px;"/>
            <a href="#">{$comment.user_name}</a>
            <br />
            {date('d-m-Y H:i', $comment.date)} 
        </div>
     
        <div style="float:left;padding:4px;padding-left:20px;width:350px;">
            {$comment.text}
        </div>
    </div>

    <div style="clear:both;height:15px;"></div>
    {/foreach}
</div>
{/if}


<h3>{lang('post_comment')}</h3>

{if $can_comment === 1 AND !is_logged_in}
     <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}

<form action="{site_url($comment_controller)}" method="post" class="form">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />
    <input type="hidden" name="redirect" value="{uri_string()}" />

    {if $is_logged_in} 
        <p>{lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></p>         
    {else:}
    <p class="clear">
        <label for="comment_author" class="left">{lang('lang_comment_author')}</label>
        <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
    </p>
       
    <p class="clear">
        <label for="comment_email" class="left">{lang('lang_comment_email')}</label>
        <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
    </p>

    <p class="clear">
        <label for="comment_site" class="left">{lang('lang_comment_site')}</label>
        <input type="text" name="comment_site" id="comment_site" value="{get_cookie('comment_site')}"/>
    </p>
    {/if}

    <p class="clear">
        <label for="comment_text" class="left">{lang('lang_comment_text')}</label>
        <textarea name="comment_text" id="comment_text" rows="10" cols="50"></textarea>
    </p>

    {if $use_captcha}
    <div style="padding-bottom:4px;">
    <p class="clear"> 
        <label for="captcha" class="left">{lang('lang_captcha')}</label>
        <input type="text" name="captcha" id="captcha" />

        <br/>

        <label class="left">&nbsp;</label>
        {$cap_image}
    </p>
    </div>
    {/if}

    <p class="clear">
        <label class="left">&nbsp;</label> 
        <input type="submit" class="button" value="{lang('lang_comment_button')}" />
    </p>

    {form_csrf()}
</form>
