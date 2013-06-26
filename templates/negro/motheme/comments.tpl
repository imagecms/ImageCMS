{if $comments_arr}
    <div id="detail">
        <h3>{$total_comments}</h3>
        {$counter = 1}
        {foreach $comments_arr as $comment}
            <div id="comment_{$comment.id}" class="comment{if $counter == 2} next_row{$counter = 0}{/if}" >

                <div class="comment_info">
                    <b>{$comment.user_name}</b>
                    <span>{date('d.m.Y H:i', $comment.date)}</span>
                </div>
                <div class="comment_text">
                    {$comment.text}
                </div>

            </div>
            {$counter++}
        {/foreach}
    </div>
{/if}

<div id="detail">
    <h3>{lang('post_comment')}</h3>

    {if $comment_errors}
        <div class="errors"> 
            {$comment_errors}
        </div>
    {/if}

    {if $can_comment === 1 AND !is_logged_in}
        <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
    {/if}

    <form action="" method="post" class="form">
        <input type="hidden" name="comment_item_id" value="{$item_id}" />
        <input type="hidden" name="redirect" value="{uri_string()}" />

        {if $is_logged_in} 
            <p>{lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></p>         
            {else:}

            <div class="comment_form_info">

                <div class="textbox">
                    <input type="text" name="comment_author" id="comment_author" value="{if $_POST['comment_author']}{$_POST['comment_author']}{else:}Имя{/if}" onfocus="if (this.value == 'Имя')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = 'Имя';" />
                </div>

                <div class="textbox_spacer"></div>

                <div class="textbox">
                    <input type="text" name="comment_email" id="comment_email" value="{if $_POST['comment_email']}{$_POST['comment_email']}{else:}Email{/if}" onfocus="if (this.value == 'Email')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = 'Email';" />
                </div>

            </div>

        {/if}

        <div class="textbox">
            <textarea name="comment_text" id="comment_text" rows="10" cols="50" onfocus="if (this.value == 'Текст комментария')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = 'Текст комментария';">{if $_POST['comment_text']}{$_POST['comment_text']}{else:}Текст комментария{/if}</textarea>
        </div>


        {if !$is_logged_in} 

            {if $use_captcha}
                <div class="comment_form_info">
                    <div class="textbox captcha">
                        <input type="text" name="captcha" id="captcha" value="Код протекции" onfocus="if (this.value == 'Код протекции')
                                this.value = '';" onblur="if (this.value == '')
                                this.value = 'Код протекции';"/>
                    </div>
                    {$cap_image}
                </div>
            {/if}

        {/if}
        <input type="submit" class="submit" value="{lang('lang_comment_button')}" />

        {form_csrf()}
    </form>
</div>