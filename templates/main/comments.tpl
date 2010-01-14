<div style="clear:both;padding-top:15px;" id="comments">
{if $comments_arr}
    <br />
    <h3>{$total_comments}</h3>

    {foreach $comments_arr as $comment}
    <div id="comment_{$comment.id}" style="position:relative;width:600px;height:50px;">
        <div style="padding:4px;height:50px;float:left;overflow:hidden;font-size:11px;width:150px;">
		    <img width="50" src="http://www.gravatar.com/avatar.php?gravatar_id={md5($comment.user_mail)}&size=50" alt="" style="float:left;padding:5px;"/>
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
{/if}

<h3>{lang('post_comment')}</h3>

{if $can_comment === 1 AND !is_logged_in}
     <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}

<form action="{$modules.comments}/add/" method="post" class="form">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />

    {if $is_logged_in} 
        <p style="background-color:#F4F1F1;padding:3px;">
            {lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a>
        </p>         
    {else:}
        <p>
            <label>{lang('lang_comment_author')}</label>
            <input type="text" class="text" name="comment_author" value="{get_cookie('comment_author')}"/>
        </p>

        <p>
            <label>{lang('lang_comment_email')}</label>
            <input type="text" class="text" name="comment_email" value="{get_cookie('comment_email')}"/>
        </p>

        <p>
            <label>{lang('lang_comment_site')}</label>
            <input type="text" class="text" name="comment_site" value="{get_cookie('comment_site')}"/>
        </p>
    {/if}

    <p>
        <label>{lang('lang_comment_text')}</label>
        <textarea name="comment_text" class="text_area" rows="10" cols="50">{$_POST.comment_text}</textarea>
    </p>
    
    {if $use_captcha}
        <p>
            <label for="captcha">{$cap_image}</label> 
            <input type="text" size="30" name="captcha" class="text" />
            <br />
            <span class="help_text">Укажите код протекции</span>
        </p>
    {/if} 

    <p>
        <label for="submit">&nbsp;</label> 
        <input type="submit" value="{lang('lang_comment_button')}" />
    </p>

    {form_csrf()}
</form>
</div>
