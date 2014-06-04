{if $can_comment == 1 AND !$is_logged_in}
<span class="title-comment"><b>{sprintf(lang('Пожалуйста, войдите для комментирования', 'newLevel'), site_url($modules.auth))}</b></span>
<button type="button" data-trigger="#loginButton">
    <span class="text-el d_l_1">{lang('Войти','newLevel')}</span>
</button>
{/if}
<div class="comments" id="comments">
    <div class="title-comment mq-max mq-w-480 mq-block">{lang('Оставьте отзыв о товаре', 'newLevel')} {if $visibleMainForm === false || $visibleMainForm == NULL}<button class="d_l_1" data-drop=".comments-main-form" data-place="inherit" data-overlay-opacity="0" data-after="Comments.toComment">{lang('Оставить свой отзыв', 'newLevel')}</button>{/if}</div>

<div class="mq-min mq-w-320 mq-block">
    <div class="decor_title2">{lang('отзывы', 'newLevel')}</div>
<span class="c_6">{lang('Оставьте отзыв о товаре', 'newLevel')}</span>

    {if $can_comment == 0 OR $is_logged_in}
    <div class="comments-main-form {if !$comments_arr}noComments{/if} {if $visibleMainForm || $visibleMainForm == NULL}active inherit{/if}" {if $visibleMainForm}style="display: block;"{/if}>
        <div class="frame-comments layout-highlight">
            <!-- Start of new comment fild -->
            <div class="form-comment main-form-comments">
                    <form method="post">
                        {if $use_moderation}
                        <label class="d_n succ">
                            <span class="frame-form-field">
                                <div class="msg">
                                    <div class="success">
                                        {lang('Ваш комментарий будет опубликован после модерации администратором','newLevel')}
                                    </div>
                                </div>
                            </span>
                        </label>
                        {/if}
                        {if !$is_logged_in}
                        <div class="clearfix">

                            <!-- Start star reiting -->
                            <div class="frame-label f-s_0">

                                <div class="frame-form-field d_i-b v-a_m m-r_10">
                                    <div class="star">
                                        <div class="productRate star-big clicktemprate">
                                            <div class="for_comment" style="width: 0%"></div>
                                            <input class="ratec" name="ratec" type="hidden" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <span class="s-t f-s_11 d_i-b v-a_m">{lang('Оцените товар', 'newLevel')}</span>
                            </div>
                            <!-- End star reiting -->
                            <label style="width: 100%;">
                                <span class="frame-form-field">
                                    <input type="text" name="comment_author" value="{get_cookie('comment_author')}" placeholder="{lang('Ваше имя', 'newLevel')}"/>
                                </span>
                            </label>
                            <label style="width: 100%;">
                                <span class="frame-form-field">
                                    <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}" placeholder="{lang('Ваш e-mail', 'newLevel')}"/>
                                </span>
                            </label>
                        </div>
                        {/if}
                        <label>
                         <span class="frame-form-field">
                            <textarea name="comment_text" class="comment_text" placeholder="{lang('Текст отзыва', 'newLevel')}">{$_POST.comment_text}</textarea>
                        </span>
                    </label>

                    {if $use_captcha}
                    <div class="frame-label m-b_10">
                        <span class="title">{lang('Код защиты')}:</span>
                        <div class="clearfix">
                            <div class="m-b_10 m-t_5 f_l">
                                {$cap_image}
                            </div>
                            <div class="frame-form-field o_h">
                                <input type="text" name="captcha" id="captcha" class="m-t_5"/>
                            </div>
                        </div>
                    </div>
                    {/if}

                    <div class="frame-label">
                        <span class="frame-form-field">
                            <div class="btn-form">
                                <input type="submit" value="{lang('отправить')}" onclick="Comments.post(this, {literal}{'visibleMainForm': '1'}{/literal})"/>
                            </div>
                        </span>
                    </div>
                </form>
            <!-- End of new comment fild -->
        </div>
    </div>
</div>
{/if}

</div>

    {if $can_comment == 0 OR $is_logged_in}
    <div class="drop comments-main-form {if !$comments_arr}noComments{/if} {if $visibleMainForm || $visibleMainForm == NULL}active inherit{/if}" {if $visibleMainForm}style="display: block;"{/if}>
        <div class="frame-comments layout-highlight">
            <!-- Start of new comment fild -->
            <div class="form-comment main-form-comments">
                    <form method="post">
                        {if $use_moderation}
                        <label class="d_n succ">
                            <span class="frame-form-field">
                                <div class="msg">
                                    <div class="success">
                                        {lang('Ваш комментарий будет опубликован после модерации администратором','newLevel')}
                                    </div>
                                </div>
                            </span>
                        </label>
                        {/if}
                        {if !$is_logged_in}
                        <div class="clearfix">

                            <!-- Start star reiting -->
                            <div class="frame-label f-s_0">

                                <div class="frame-form-field d_i-b v-a_m m-r_10">
                                    <div class="star">
                                        <div class="productRate star-big clicktemprate">
                                            <div class="for_comment" style="width: 0%"></div>
                                            <input class="ratec" name="ratec" type="hidden" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <span class="s-t f-s_11 d_i-b v-a_m">{lang('Оцените товар', 'newLevel')}</span>
                            </div>
                            <!-- End star reiting -->
                            <label style="width: 48%;float: left;margin-right: 4%;">
                                <span class="frame-form-field">
                                    <input type="text" name="comment_author" value="{get_cookie('comment_author')}" placeholder="{lang('Ваше имя', 'newLevel')}"/>
                                </span>
                            </label>
                            <label style="width: 48%; float: right;">
                                <span class="frame-form-field">
                                    <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}" placeholder="{lang('Ваш e-mail', 'newLevel')}"/>
                                </span>
                            </label>
                        </div>
                        {/if}
                        <label>
                         <span class="frame-form-field">
                            <textarea name="comment_text" class="comment_text" placeholder="{lang('Текст отзыва', 'newLevel')}">{$_POST.comment_text}</textarea>
                        </span>
                    </label>

                    {if $use_captcha}
                    <div class="frame-label m-b_10">
                        <span class="title">{lang('Код защиты')}:</span>
                        <div class="clearfix">
                            <div class="m-b_10 m-t_5 f_l">
                                {$cap_image}
                            </div>
                            <div class="frame-form-field o_h">
                                <input type="text" name="captcha" id="captcha" class="m-t_5"/>
                            </div>
                        </div>
                    </div>
                    {/if}

                    <div class="frame-label">
                        <span class="frame-form-field">
                            <div class="btn-form">
                                <input type="submit" value="{lang('отправить')}" onclick="Comments.post(this, {literal}{'visibleMainForm': '1'}{/literal})"/>
                            </div>
                        </span>
                    </div>
                </form>
            <!-- End of new comment fild -->
        </div>
    </div>
</div>
{/if}
{if $comments_arr}
<div class="frame-list-comments">
    <ul class="sub-1 product-comment patch-product-view">
        {foreach $comments_arr as $key => $comment}
        <li>
            <input type="hidden" name="comment_item_id" value="{$comment['id']}"/>
            <div class="clearfix global-frame-comment-sub1">
                <div class="author-data-comment author-data-comment-sub1">
                    <span class="f-s_0 frame-autor-comment"><span class="icon_comment"></span><span class="author-comment">{$comment.user_name}</span></span>
                    <span class="date-comment">
                        <span class="day">{echo date("d", $comment.date)} </span>
                        <span class="month">{echo month(date("n", $comment.date))} </span>
                        <span class="year">{echo date("Y ", $comment.date)}</span>
                    </span>
                </div>
                <div class="frame-mark">
                    {if $comment.rate != 0}
                    <div class="mark-pr">
                        <div class="star-small d_i-b">
                            <div class="productRate star-small">
                                <div style="width: {echo (int)$comment.rate *20}%"></div>
                            </div>
                        </div>
                    </div>
                    {/if}
                    {/*}
                    <div class="func-button-comment">
                        <span class="s-t">{lang('Отзыв полезен?','newLevel')}</span>
                        <span class="btn like">
                            <button type="button" class="usefullyes" data-comid="{echo $comment.id}">
                                <span class="icon_like"></span>
                                <span class="text-el d_l_1">{lang('Да','newLevel')} <span class="yesholder{$comment.id}">({echo $comment.like})</span></span>
                            </button>
                        </span>
                        <span class="btn dis-like">
                            <button type="button" class="usefullno" data-comid="{echo $comment.id}">
                                <span class="icon_dislike"></span>
                                <span class="text-el d_l_1">{lang('Нет','newLevel')} <span class="noholder{$comment.id}">({echo $comment.disslike})</span></span>
                            </button>
                        </span>
                    </div>

                    { */}
                </div>

                <div class="frame-comment-sub1">
                    <div class="frame-comment">
                        <p>{$comment.text}</p>
                        {if $comment.text_plus != Null}
                        <p>
                            <b>{lang('Да', 'newLevel')}</b><br>
                            {$comment.text_plus}
                        </p>
                        {/if}
                        {if $comment.text_minus != Null}
                        <p>
                            <b>{lang('Нет', 'newLevel')}</b><br>
                            {$comment.text_minus}
                        </p>
                        {/if}
                    </div>
                    {/*}
                    {if $can_comment == 0 OR $is_logged_in}
                    <div class="btn">
                        <button type="button" data-rel="cloneAddPaste" data-parid="{$comment['id']}">
                            <span class="icon_comment"></span>
                            <span class="text-el d_l_1">{lang('Ответить')}</span>
                        </button>
                    </div>
                    {/if}
                    { */}
                </div>

            </div>
            {/*}
            {$countAnswers = $CI->load->module('comments')->commentsapi->getCountCommentAnswersByCommentId($comment.id)}
            {if $countAnswers}
            <ul class="frame-list-comments sub-2">
                {foreach $comment_ch as $com_ch}
                {if $com_ch.parent == $comment.id}
                <li>
                    <div class="global-frame-comment-sub2">
                        <div class="author-data-comment author-data-comment-sub2">
                            <span class="author-comment">{$com_ch.user_name}</span>
                            <span class="date-comment">
                                <span class="day">{echo date("d", $comment.date)} </span>
                                <span class="month">{echo month(date("n", $comment.date))} </span>
                                <span class="year">{echo date("Y ", $comment.date)}</span>
                            </span>
                        </div>
                        <div class="frame-comment-sub2">
                            <div class="frame-comment">
                                <p>
                                    {$com_ch.text}
                                </p>
                            </div>

                        </div>
                    </div>
                </li>
                {/if}
                {/foreach}
            </ul>
            {/if}
            <div class="btn-all-comments">
                <button type="button"><span class="text-el" data-hide='<span class="d_l_1">{lang('Скрыть','newLevel')}</span> ↑' data-show='<span class="d_l_1">{lang('Смотреть все отзывы','newLevel')}</span> ↓'></span></button>
            </div>
            { */}
        </li>
        {/foreach}
    </ul>
    {if $CI->core->core_data['data_type'] != 'page'}
    <button type="button">
       <span class="text-el" data-hide='<span class="d_l_2">{lang('Свернуть','newLevel')}</span>' data-show='<span class="d_l_2">{lang('Смотреть все ответы','newLevel')}</span>'></span>
    </button>
    {/if}
</div>
{/if}

{/*}
<div class="frame-drop-comment" data-rel="whoCloneAddPaste">
    <div class="form-comment layout-highlight frame-comments">
        <div class="title-default title-comment">
            <div class="title">{lang('Ваш ответ','newLevel')}</div>
        </div>
        <div class="inside-padd">
            <form>
                <label class="err-label">
                    <span class="frame-form-field">
                        <div class="frame-label error" name="error_text"></div>
                    </span>
                </label>

                {if !$is_logged_in}
                <label style="width: 48%;float: left;margin-right: 4%;">
                    <span class="frame-form-field">
                        <input type="text" name="comment_author" value="{get_cookie('comment_author')}" placeholder="{lang('Ваше имя', 'newLevel')}"/>
                    </span>
                </label>
                <label style="width: 48%; float: right;">
                    <span class="frame-form-field">
                        <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}" placeholder="{lang('Ваш e-mail', 'newLevel')}"/>
                    </span>
                </label>

                {/if}
                {if $use_moderation}

                <label class="d_n succ">
                    <span class="frame-form-field">
                        <div class="msg">
                            <div class="success">

                                {lang('Ваш комментарий будет опубликован после модерации администратором','newLevel')}

                            </div>
                        </div>
                    </span>
                </label>
                {/if}

                <label>
                    <span class="frame-form-field">
                        <textarea name="comment_text" class="comment_text" placeholder="{lang('Текст ответа', 'newLevel')}">{$_POST.comment_text}</textarea>
                    </span>
                </label>
                <!-- End star reiting -->
                {if $use_captcha}
                <div class="frame-label m-b_10">
                    <span class="title">{lang('Код защиты')}:</span>
                    <div class="clearfix">
                        <div class="m-b_10 m-t_5 f_l">
                            {$cap_image}
                        </div>
                        <div class="frame-form-field o_h">
                            <input type="text" name="captcha" id="captcha" class="m-t_5"/>
                        </div>
                    </div>
                </div>
                {/if}
                <div class="frame-label">
                    <span class="frame-form-field">
                        <input type="hidden" id="parent" name="comment_parent" value="">
                        <span class="btn-form">
                            <input type="submit" value="{lang('отправить', 'newLevel')}" onclick="Comments.post(this)"/>
                        </span>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

{ */}
</div>