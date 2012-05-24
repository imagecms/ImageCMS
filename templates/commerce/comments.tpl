{# Comments form for product}

{if $can_comment === 1 AND !is_logged_in}
    <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}
<div class="di_b">
    <span class="comment_ajax_refer b-r_4 visible">
        <a href="#" class="t-d_n"><span class="js">Оставить отзыв</span><span class="blue_arrow"></span></a>
        {if $is_logged_in}
            {lang('lang_logged_in_as')} {$username}
        {else:}
<!--            <span>Для того, чтобы оставить комментарий, Вы должны <a href="{site_url('auth/login')}" class="js red">авторизироваться</a> на сайте</span>-->
        {/if}
    </span>
</div>
{if $comment_errors}
    <div class="errors">
        {$comment_errors}
    </div>
{/if}
<form action="" method="post" class="comment_form clearfix">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />
    <input type="hidden" name="redirect" value="{uri_string()}" />

    {if !$is_logged_in}

        <label>{lang('lang_comment_author')}
            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/> <span style="color:red;">*</span></label>



        <label>{lang('lang_comment_email')}
            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/> <span style="color:red;">*</span></label>



        <label>{lang('lang_comment_site')}
            <input type="text" name="comment_site" id="comment_site" value="{get_cookie('comment_site')}"/></label>

    {/if}


    <label>{lang('lang_comment_text')}
        <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> <span style="color:red;">*</span></label>


    {if $use_captcha}
        <!--        <div style="padding-bottom:4px;">
                    <p class="clear">
        {if $captcha_type == 'captcha'}
            <label for="captcha" style="width:140px;" class="left">{lang('lang_captcha')}</label>
            <input type="text" name="captcha" id="captcha" />  <span style="color:red;">*</span>
        {/if}
        <br/>
        <label class="left" style="width:140px;" >&nbsp;</label>
        {$cap_image}
    </p>
</div>-->
    {/if}
    <label class="buttons button_middle_blue f_l">
        <input type="submit" value="Оставить отзыв"/>
    </label>

    {form_csrf()}
</form>

{if $comments_arr}
    <ul class="comments" style="width:100%">
        {foreach $comments_arr as $comment}
            <li>
                <b>{$comment.user_name}</b>
                <div class="c_9 f-s_11">Оставлен {date('d-m-Y H:i', $comment.date)}</div>
                <p>{$comment.text}</p>
            </li>
        {/foreach}
        <ul>
        {/if}