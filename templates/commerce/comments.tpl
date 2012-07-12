{# Comments form for product}
<script type="text/javascript">
    var currentProductId = '{echo $item_id}';
</script>
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
    <label>
        Ваш рейтинг
        <div class="star_rating">
            <div id="comment_block" class="rating {echo $r} star_rait" data-id="{echo $item_id}">
                <div id="1" class="rate one">
                    <span title="1" class="clicktemprate">1</a>
                </div>
                <div id="2" class="rate two">
                    <span title="2" class="clicktemprate">2</a>
                </div>
                <div id="3" class="rate three">
                    <span title="3" class="clicktemprate">3</a>
                </div>
                <div id="4" class="rate four">
                    <span title="4" class="clicktemprate">4</a>
                </div>
                <div id="5" class="rate five">
                    <span title="5" class="clicktemprate">5</a>
                </div>
            </div>
        </div>
        <input id="ratec" name="ratec" type="hidden" value=""/>
    </label><br/>

    <label>{lang('lang_comment_text')}
        <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> 
        <span style="color:red;">*</span>
    </label>

    <label>Плюсы
        <textarea name="comment_text_plus" id="comment_plus" rows="5" cols="50">{$_POST.comment_text}</textarea> 
        <span style="color:red;">*</span>
    </label>
        
    <label>Минусы
        <textarea name="comment_text_minus" id="comment_minus" rows="5" cols="50">{$_POST.comment_text}</textarea> 
        <span style="color:red;">*</span>
    </label>
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
                {if $comment.rate != 0}
                {$rating = $comment.rate}
                {if $rating == 1}{$r = "onestar"}   {/if}
                {if $rating == 2}{$r = "twostar"}   {/if}
                {if $rating == 3}{$r = "threestar"} {/if}
                {if $rating == 4}{$r = "fourstar"}  {/if}
                {if $rating == 5}{$r = "fivestar"}  {/if}
                <div class="star_rating">
                    <div id="{echo $comment.item_id}_star_rating" class="rating_nohover {echo $r} star_rait" data-id="{echo $comment.item_id}">
                        <div id="1" class="rate one">
                            <span title="1" class="clickrate">1</a>
                        </div>
                        <div id="2" class="rate two">
                            <span title="2" class="clickrate">2</a>
                        </div>
                        <div id="3" class="rate three">
                            <span title="3" class="clickrate">3</a>
                        </div>
                        <div id="4" class="rate four">
                            <span title="4" class="clickrate">4</a>
                        </div>
                        <div id="5" class="rate five">
                            <span title="5" class="clickrate">5</a>
                        </div>
                    </div>
                </div>
                {/if}
                <b>{$comment.user_name}</b>
                <div class="c_9 f-s_11">Оставлен {date('d-m-Y H:i', $comment.date)}</div>
                <p>{$comment.text}</p>
                {if $comment.text_plus != Null}
                <p><b>Плюсы</b></br>
                    {$comment.text_plus}</p>
                {/if}
                {if $comment.text_minus != Null}
                <p><b>Минусы</b></br>
                    {$comment.text_minus}</p>
                {/if}
                <div class="di_b">
                    <span class="comment_ajax_refer b-r_4 visible">
                        <a href="#" class="t-d_n"><span class="js">Ответить</span><span class="blue_arrow"></span></a>
                        Отзыв был полезен?
                        <span></span>
                        <span class="usefullyes" data-comid="{echo $comment.id}"><span class="js"> Да</span></span>{if $comment.like !=0}<span class="a{$comment.id} yesholder">({echo $comment.like})</span>{/if}/
                        <span class="usefullno" data-comid="{echo $comment.id}"><span class="js">Нет</span></span>{if $comment.disslike !=0}<span class="{$comment.id} noholder">({echo $comment.disslike})</span>{/if}
                    </span>
                </div>
                    <form action="" method="post" class="comment_form">
                        <input type="hidden" name="comment_item_id" value="{$item_id}"/>
                        <input type="hidden" name="redirect" value="{uri_string()}"/>
                        {if !$is_logged_in}
                        <label>{lang('lang_comment_author')}
                            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/> <span style="color:red;">*</span>
                        </label>
                        <label>{lang('lang_comment_email')}
                            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/> <span style="color:red;">*</span>
                        </label>
                        {/if}
                        <label>{lang('lang_comment_text')}
                            <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> 
                            <span style="color:red;">*</span>
                        </label>
                        <input type="hidden" name="parent" value="{echo $comment.id}">
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
                
                        {foreach $comment_ch as $com_ch}
                            {if $com_ch.parent == $comment.id}
                            <li style="padding-left: 50px">
                                <b>{$com_ch.user_name}</b>
                                <div class="c_9 f-s_11">Оставлен {date('d-m-Y H:i', $com_ch.date)}</div>
                                <p>{$com_ch.text}</p>
                            </li>
                            {/if}
                        {/foreach}
            </li>
    
{/foreach}
<ul>
{/if}