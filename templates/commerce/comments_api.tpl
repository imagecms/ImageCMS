{# Comments form for product}

{if $can_comment == 1 AND !$is_logged_in}
    <p class="m-l_10">{sprintf(lang('login_for_comments'), site_url($modules.auth))}</p>
{/if}

{if $can_comment == 0 OR $is_logged_in}
    <div class="di_b">
        <span class="comment_ajax_refer b-r_4 visible">

            <a href="#" class="t-d_n"><span class="js">{lang('s_leave_comment')}</span><span class="blue_arrow"></span></a>

            {if $is_logged_in}
                {lang('s_lang_logged')} {$username}
            {else:}
    <!--            <span>Для того, чтобы оставить комментарий, Вы должны <a href="{site_url('auth/login')}" class="js red">авторизироваться</a> на сайте</span>-->
            {/if}
        </span>
    </div>
{/if}

{if $can_comment == 0 OR $is_logged_in}
    <form action="" method="post" class="comment_form clearfix">
        <input type="hidden" name="comment_item_id" value="{$item_id}" />
        <input type="hidden" name="redirect" value="{uri_string()}" />
        {if $comment_errors}
            <span class="red">   {$comment_errors}</span>
        {/if}

        {if !$is_logged_in}

            <label>{lang('lang_comment_author')} <span style="color:red;">*</span>
                <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/></label>
            <label>{lang('lang_comment_email')} <span style="color:red;">*</span>
                <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/></label>
            <label>{lang('lang_comment_site')}
                <input type="text" name="comment_site" id="comment_site" value="{get_cookie('comment_site')}"/></label>

        {/if}
        <label>
            {lang('s_you_raiting')}
            <div class="star_rating">
                <div id="comment_block" class="rating {echo $r} star_rait" data-id="{echo $item_id}">
                    <div id="1" class="rate one">
                        <span title="1" class="clicktemprate">1</span>
                    </div>
                    <div id="2" class="rate two">
                        <span title="2" class="clicktemprate">2</span>
                    </div>
                    <div id="3" class="rate three">
                        <span title="3" class="clicktemprate">3</span>
                    </div>
                    <div id="4" class="rate four">
                        <span title="4" class="clicktemprate">4</span>
                    </div>
                    <div id="5" class="rate five">
                        <span title="5" class="clicktemprate">5</span>
                    </div>
                </div>
            </div>
            <input id="ratec" name="ratec" type="hidden" value=""/>
        </label><br/>

        <label>{lang('s_text_comment_one')}<span style="color:red;">*</span>
            <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> 
        </label>

        <label>{lang('s_plus')}
            <textarea name="comment_text_plus" id="comment_plus" rows="5" cols="50">{$_POST.comment_text}</textarea> 
        </label>

        <label>{lang('s_cons')}
            <textarea name="comment_text_minus" id="comment_minus" rows="5" cols="50">{$_POST.comment_text}</textarea> 
        </label>
        {if $use_captcha}
            <div style="padding-bottom:4px;">
                <p class="clear">
                    {if $captcha_type == 'captcha'}
                        <label for="captcha" style="width:140px;" class="left">{lang('lang_captcha')}<span style="color:red;">*</span></label>
                        <input type="text" name="captcha" id="captcha" />
                    {/if}
                    <br/>
                    <label class="left" style="width:140px;" >&nbsp;</label>
                    {$cap_image}
                </p>
            </div>
        {/if}
        <label class="buttons button_middle_blue f_l">
            <input name="submit" type="button" class="submit" value="Пуск" id="button" onclick="json()">
        </label>

        {form_csrf()}
    </form>

{/if}

{if $comments_arr}
    <ul class="comments" style="width:100%">
        {foreach $comments_arr as $comment}
            <li>
                {if $comment.rate != 0}
                    <div class="star_rating">
                        <div id="{echo $comment.item_id}_star_rating" class="rating_nohover {echo count_star($comment.rate)} star_rait" data-id="{echo $comment.item_id}">
                            <div id="1" class="rate one">
                                <span title="1" class="clickrate">1</span>
                            </div>
                            <div id="2" class="rate two">
                                <span title="2" class="clickrate">2</span>
                            </div>
                            <div id="3" class="rate three">
                                <span title="3" class="clickrate">3</span>
                            </div>
                            <div id="4" class="rate four">
                                <span title="4" class="clickrate">4</span>
                            </div>
                            <div id="5" class="rate five">
                                <span title="5" class="clickrate">5</span>
                            </div>
                        </div>
                    </div>
                {/if}
                <b>{$comment.user_name}</b>
                <div class="c_9 f-s_11">{lang('s_on_comment')} {date('d-m-Y H:i', $comment.date)}</div>
                <p>{$comment.text}</p>
                {if $comment.text_plus != Null}
                    <p><b>{lang('s_plus')}</b></br>
                        {$comment.text_plus}</p>
                    {/if}
                    {if $comment.text_minus != Null}
                    <p><b>{lang('s_cons')}</b></br>
                        {$comment.text_minus}</p>
                    {/if}
                <div class="di_b">
                    <span class="comment_ajax_refer b-r_4 visible">

                        {if $can_comment == 0 OR $is_logged_in}
                            <a href="#" class="t-d_n">
                                <span class="js">{lang('s_comment_answer')}</span>

                                <span class="blue_arrow"></span></a>

                        {/if}

                        {lang('s_review_comment')}
                        <span></span>

                        <span class="usefullyes" data-comid="{echo $comment.id}"><span class="js">{lang('s_yes')}</span></span><span id="yesholder{$comment.id}">({echo $comment.like})</span>/
                        <span class="usefullno" data-comid="{echo $comment.id}"><span class="js">{lang('s_no')}</span></span><span id="noholder{$comment.id}">({echo $comment.disslike})</span>
                    </span>
                </div>

                {if $can_comment == 0 OR $is_logged_in}
                    <form action="" method="post" class="comment_form">
                        <input type="hidden" name="comment_item_id" value="{$item_id}"/>
                        <input type="hidden" name="redirect" value="{uri_string()}"/>
                        {if !$is_logged_in}
                            <label>{lang('s_text_comment_one')} <span style="color:red;">*</span>
                                <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
                            </label>
                            <label>{lang('lang_comment_email')} <span style="color:red;">*</span>
                                <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                            </label>
                        {/if}
                        <label>{lang('s_text_comment_one')} <span style="color:red;">*</span>
                            <textarea name="comment_text" id="comment_text" rows="10" cols="50">{$_POST.comment_text}</textarea> 
                        </label>
                        <input type="hidden" name="parent" value="{echo $comment.id}">
                        <label class="buttons button_middle_blue f_l">
                            <input name="submit" type="button button_middle_blue f_l" class="submit" value="Пуск" id="button" onclick="json()">
                        </label>

                        {form_csrf()}
                    </form>
                {/if}
                {foreach $comment_ch as $com_ch}
                    {if $com_ch.parent == $comment.id}
                    <li style="padding-left: 50px">
                        <b>{$com_ch.user_name}</b>
                        <div class="c_9 f-s_11">{lang('s_on_comment')} {date('d-m-Y H:i', $com_ch.date)}</div>
                        <p>{$com_ch.text}</p>
                    </li>
                {/if}
            {/foreach}
        </li>

    {/foreach}
    <ul>
    {/if}