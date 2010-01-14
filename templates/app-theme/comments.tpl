{if $comments_arr}
            <h2 class="title">{$total_comments}</h2>
            <div class="inner">
              <ul class="list">            
              {foreach $comments_arr as $comment}
                <li>
                  <div class="left">
                    <a href="#"><img alt="avatar" src="{$THEME}/images/avatar.png" class="avatar"/></a>
                  </div>
                  <div class="item" style="min-height:50px;">                
                    <p>
                        <span class="gray">{$comment.user_name} {date('d-m-Y H:i', $comment.date)}</span> <a name="comment_{$comment.id}" href="#comment_{$comment.id}" >#</a>   <br/>
                        {$comment.text}
                    </p>
                  </div>              
                </li>         
              {/foreach}
              </ul>
            </div> 
{/if}

<div class="inner">
{if $can_comment === 1 AND !is_logged_in} <!-- Post comments can only registered users -->
  <div class="flash">
    <div class="message warning">
        <p>{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
    </div>
  </div>
{/if}

    <form action="{$modules.comments}/add/" method="post" class="form">
    <input type="hidden" name="comment_item_id" value="{$item_id}" />
    <div class="columns">
      <div class="column left">
      {if $is_logged_in} <!-- user is logged in -->
        <div class="flash">
            <div class="message notice">
              <p>{lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a></p>
            </div>                
        </div>            
        {else:}
        <div class="group"> 
            <label class="label">{lang('lang_comment_author')}</label>
            <input type="text" class="text_field" name="comment_author" value="{get_cookie('comment_author')}"/>
        </div>
    
        <div class="group">
            <label class="label">{lang('lang_comment_email')}</label>
            <input type="text" class="text_field" name="comment_email" value="{get_cookie('comment_email')}"/>
        </div> 
      {/if}
     
        <div class="group">
          <label class="label">{lang('lang_comment_text')}</label>
          <textarea name="comment_text" class="text_area" rows="10" cols="80"></textarea>
        </div>              
      </div>
      <div class="column right">   
      {if $use_captcha}
        <div class="group">
            <label class="label">{lang('lang_captcha')}</label>
            <input type="text" class="text_field" name="captcha" value=""/> {$cap_image}
        </div> 
      {/if} 
      </div>
    </div>
    <div class="clear"></div>

    <div class="group navform">
      <input type="submit" class="button" value="{lang('lang_comment_button')}" />
    </div>            
  {form_csrf()}</form>

</div>
