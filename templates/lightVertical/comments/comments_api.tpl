{if $can_comment == 1 AND !$is_logged_in}
    <span class="title-comment"><b>{sprintf(lang('Пожалуйста, войдите для комментирования', 'newLevel'), site_url($modules.auth))}</b></span>
    <button type="button" data-trigger="#loginButton">
        <span class="text-el d_l_1">{lang('Войти','newLevel')}</span>
    </button>
{/if}
<div class="comments" id="comments">
    {if $can_comment == 0 OR $is_logged_in}
        {if $comments_arr}
            <div class="title-comment">{lang('Отзывы покупателей', 'newLevel')} {if $visibleMainForm === false || $visibleMainForm == NULL}<button class="d_l_1" data-drop=".comments-main-form" data-place="inherit" data-overlay-opacity="0" data-after="Comments.toComment">{lang('Оставить свой отзыв', 'newLevel')}</button>{/if}</div>
            {/if}
        <div class="drop comments-main-form {if !$comments_arr}noComments{/if} {if $visibleMainForm || $visibleMainForm == NULL}active inherit{/if}" {if $visibleMainForm}style="display: block;"{/if}>
            <div class="frame-comments layout-highlight">
                <!-- Start of new comment fild -->
                <div class="form-comment main-form-comments">
                    <div class="inside-padd">
                        <form method="post">
                            <div class="mainPlace"></div>
                            {if !$is_logged_in}
                                <label style="width: 45%;float: left;">
                                    <span class="title">{lang('Ваше имя','newLevel')}</span>
                                    <span class="frame-form-field">
                                        <input type="text" name="comment_author" value="{get_cookie('comment_author')}"/>
                                    </span>
                                </label>
                                <label style="width: 45%;margin-left: 10%;float: left;">
                                    <span class="title">{lang('Ваш email:', 'newLevel')}</span>
                                    <span class="frame-form-field">
                                        <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                                    </span>
                                </label>
                            {/if}
                            <label>
                                <span class="title">{lang('Текст комментария:')}</span>
                                <span class="frame-form-field">
                                    <textarea name="comment_text" class="comment_text">{$_POST.comment_text}</textarea>
                                </span>
                            </label>
                            <!-- Start star reiting -->
                            <div class="frame-label">
                                <span class="title f_l t-a_l" style="margin-top: 2px;">{lang('Ваша оценка:', 'newLevel')}</span>
                                <div class="frame-form-field">
                                    <div class="star">
                                        <div class="productRate star-big clicktemprate">
                                            <div class="for_comment" style="width: 0%"></div>
                                            <input class="ratec" name="ratec" type="hidden" value=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <div class="btn-form">
                                        <input type="submit" value="{lang('Комментировать', 'newLevel')}" onclick="Comments.post(this, {literal}{'visibleMainForm': '1'}{/literal}, '.mainPlace')"/>
                                    </div>
                                </span>
                            </div>
                        </form>
                    </div>
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
                                <div class="func-button-comment">
                                    <span class="btn like">
                                        <button type="button" class="usefullyes" data-comid="{echo $comment.id}">
                                            <span class="icon_like"></span>
                                            <span class="text-el"><span class="yesholder{$comment.id}">{echo $comment.like}</span></span>
                                        </button>
                                    </span>
                                    <span class="btn dis-like">
                                        <button type="button" class="usefullno" data-comid="{echo $comment.id}">
                                            <span class="icon_dislike"></span>
                                            <span class="text-el"><span class="noholder{$comment.id}">{echo $comment.disslike}</span></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="frame-comment-sub1">
                                <div class="frame-comment">
                                    <p>{$comment.text}</p>
                                </div>
                                {if $can_comment == 0 OR $is_logged_in}
                                    <div class="btn">
                                        <button type="button" data-rel="cloneAddPaste" data-parid="{$comment['id']}">
                                            <span class="icon_comment"></span>
                                            <span class="text-el d_l_1 f-s_11">{lang('Ответить', 'newLevel')}</span>
                                        </button>
                                    </div>
                                {/if}
                            </div>
                        </div>
                        <div data-place="{$comment['id']}"></div>
                        {$countAnswers = $CI->load->module('comments')->commentsapi->getCountCommentAnswersByCommentId($comment.id)}
                        {if $countAnswers}
                            <ul class="frame-list-comments sub-2">
                                {foreach $comment_ch as $com_ch}
                                    {if $com_ch.parent == $comment.id}
                                        <li>
                                            <div class="global-frame-comment-sub2">
                                                <div class="author-data-comment author-data-comment-sub2">
                                                    <span class="s-t">{lang('Ответ от', 'newLevel')} </span>
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
                            <button type="button"><span class="text-el" data-hide='<span class="d_l_1">{lang('Скрыть','newLevel')}</span> ↑' data-show='<span class="d_l_1">{lang('Смотреть все ответы','newLevel')}</span> ↓'></span></button>
                        </div>
                    </li>
                {/foreach}
            </ul>
            <button class="f-s_0 d_n_ d_l_1" data-trigger="[data-href='#comment']" data-scroll="true">
                <span class="text-el">{lang('Смотреть все ответы','newLevel')}</span>
            </button>
        </div>
    {/if}

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
                        <label>
                            <span class="title">{lang('Ваше имя:', 'newLevel')}</span>
                            <span class="frame-form-field">
                                <input type="text" name="comment_author" value="{get_cookie('comment_author')}"/>
                            </span>
                        </label>
                        <label>
                            <span class="title">{lang('Ваш email:', 'newLevel')} </span>
                            <span class="frame-form-field">
                                <input type="text" name="comment_email" value="{get_cookie('comment_email')}"/>
                            </span>
                        </label>
                        <label>
                            <span class="frame-form-field">
                                <div class="msg">
                                    <div class="success">
                                        {lang('Комментарий будет отправлен на модерацию','newLevel')}
                                    </div>
                                </div>
                            </span>
                        </label>
                    {/if}
                    <label>
                        <span class="title">{lang('Текст ответа:','newLevel')}</span>
                        <span class="frame-form-field">
                            <textarea class="comment_text" name="comment_text"></textarea>
                        </span>
                    </label>
                    <div class="frame-label">
                        <span class="frame-form-field">
                            <input type="hidden" id="parent" name="comment_parent" value="">
                            <span class="btn-form">
                                <input type="submit" value="{lang('Комментировать', 'newLevel')}" onclick="Comments.post(this, {if $visibleMainForm}{literal}{'visibleMainForm': '1'}{/literal}{else:}{literal}{'visibleMainForm': '0'}{/literal}{/if})"/>
                            </span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="d_n" id="useModeration">
    <div class="usemoderation">
        <div class="msg">
            <div class="success">
                {lang('Ваш комментарий будет опубликован после модерации администратором','newLevel')}
            </div>
        </div>
    </div>
</div>
<script>
            var _useModeration = {if $use_moderation}{$use_moderation}{else:}0{/if};
</script>