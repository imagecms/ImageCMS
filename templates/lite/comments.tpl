{if $comments_arr}
<div>
    <h3>{$total_comments}</h3>

    {foreach $comments_arr as $comment}
    <div id="comment_{$comment.id}" style="position:relative;width:600px;height:50px;">
        <div style="padding:4px;height:50px;float:left;overflow:hidden;font-size:11px;width:150px;">
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

  
<div>
    <h3>{lang('post_comment')}</h3>

{if $can_comment === 1 AND !is_logged_in}
     <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}

<form action="{$modules.comments}/add/" method="post" class="form">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />

    {if $is_logged_in} 
        <p style="background-color:#F4F1F1;padding:3px;">{lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></p>         
    {else:}
        <div class="form_text">{lang('lang_comment_author')}</div>
        <div class="form_input">
            <input type="text" class="text_field" name="comment_author" value="{get_cookie('comment_author')}"/>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('lang_comment_email')}</div>
        <div class="form_input">
            <input type="text" class="text_field" name="comment_email" value="{get_cookie('comment_email')}"/>
        </div>
        <div class="form_overflow"></div>

        <div class="form_text">{lang('lang_comment_site')}</div>
        <div class="form_input">
            <input type="text" class="text_field" name="comment_site" value="{get_cookie('comment_site')}"/>
        </div>
        <div class="form_overflow"></div>
    {/if}

    <div class="form_text">{lang('lang_comment_text')} </div>
    <div class="form_input">
        <textarea name="comment_text" class="text_area" rows="10" cols="50"></textarea>
    </div>
    <div class="form_overflow"></div>

    {if $use_captcha}
        <div class="form_text">{lang('lang_captcha')} </div>
        <div class="form_input">
            <input type="text" class="text_field" name="captcha" value=""/> 
        </div>
        <div class="form_input">
            {$cap_image} 
        </div>
        <div class="form_overflow"></div>
    {/if} 

    <input type="submit" class="button" value="{lang('lang_comment_button')}" />

    {form_csrf()}
</form>
</div>
