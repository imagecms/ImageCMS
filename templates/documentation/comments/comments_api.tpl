{if $can_comment == 1 AND !$is_logged_in}
    <label>
        <span class="title__icsi-css">{lang('Only authorized users can leave comments.', 'comments') . sprintf('<a href="%s" class="loginAjax"> ' . lang("log in", "comments") .' </ a>, '  . lang("please", "comments"), site_url($modules.auth))}</span>
    </label>
{/if}
<div id="comment__icsi-css" class="comment__icsi-css">
    {if $comments_arr}
        <div class="title_h2__icsi-css">{lang('Вопросы пользователей', 'comments')}</div>
        <ul class="frame-list-comment__icsi-css">
            {foreach $comments_arr as $key => $comment}
                <li>
                    {$text = null}
                    {foreach $comment_ch as $com_ch}
                        {if $com_ch.parent == $comment.id}
                            {$text = $com_ch.text}
                        {/if}
                    {/foreach}
                    <input type="hidden" id="comment_item_id" name="comment_item_id" value="{$comment['id']}"/>
                    <div class="up-comment-user">
                        <div class="author-data-comment__icsi-css doc-user-op">
                            {if $text}
                                <span class="plus-min-comm d_i-b v-a_m">
                                    <span class="">
                                        <span class="text-el plus">+</span>
                                        <span class="text-el minus">-</span>
                                    </span>
                                </span>
                            {/if}
                            <span class="author-comment__icsi-css d_i-b v-a_m">{$comment.user_name}</span>&nbsp;&nbsp;
                        </div>
                        <div class="frame-comment__icsi-css">
                            <p>{$comment.text}</p>
                            {if $comment.text_plus != Null}
                                <p>
                                    <b>{lang('Pluses', 'comments')}</b><br>
                                    {$comment.text_plus}
                                </p>
                            {/if}
                            {if $comment.text_minus != Null}
                                <p>
                                    <b>{lang('Minuses', 'comments')}</b><br>
                                    {$comment.text_minus}
                                </p>
                            {/if}
                        </div>
                    </div>
                    {if $hasCRUDAccess}
                        <div class="func-button-comment__icsi-css">
                            <div class="">
                                <button class="btn"  type="button"  data-rel="cloneAddPaste" data-parid="{$comment['id']}">
                                    <div>
                                        {lang('Ответ', 'comments')}
                                    </div>
                                    </span>
                                </button>
                            </div>
                        </div>
                    {/if}
                    <ul class="answear-programmer">
                        {if $text}
                            <li>
                                <div class="title">Ответ от разработчика ImageCMS {$com_ch.user_name}</div>
                                <p>
                                    {echo $text}
                                </p>
                            </li>
                        {/if}
                    </ul>

                </li>
            {/foreach}
        </ul>
    {/if}

    <p style='font-size:12pt; text-align:center; padding: 10px;'>{lang('Часто задаваемые вопросы', 'comments')}</p>

    {if $can_comment == 0 OR $is_logged_in}

        <div class="main-form-comments__icsi-css">
            <div class="frame-comments__icsi-css">
                <div class="inside-padd">
                    <div class="title_h2__icsi-css">
                        {lang('У вас возникли вопросы? Напишите нам', 'comments')}
                        <p style='font-size:11pt;'>{lang('Мы предоставим ответ в течении 24 часов', 'comments')}</p>
                    </div>
                    <!-- Start of new comment fild -->
                    <div class="form-comment__icsi-css form__icsi-css horizontal-form">
                        <div class="inside-padd">
                            <form method="post" id="comments_form">
                                <label>
                                    <span class="frame_form_field__icsi-css">
                                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                                    </span>
                                </label>
                                <!-- Start star reiting -->
                                <!-- End star reiting -->
                                {if !$is_logged_in}

                                    <label>
                                        <span class="title__icsi-css">{lang('Ваше имя:', 'comments')}<span class="must">*</span></span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title__icsi-css">{lang('Ваш email:', 'comments')}<span class="must">*</span></span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                                        </span>
                                    </label>
                                {/if}

                                <label>
                                    <span class="title__icsi-css">{lang('Вопрос:', 'comments')}<span class="must">*</span></span>
                                    <span class="frame_form_field__icsi-css">
                                        <textarea name="comment_text" class="comment_text">{$_POST.comment_text}</textarea>
                                    </span>
                                </label>
                                <!-- If you want get plus and minus for products - uncoment it
                            <label>
                                <span class="title__icsi-css">{lang('Pluses', 'comments')}</span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_plus" id="comment_text_plus">{$_POST.comment_text}</textarea>
                                </span>
                            </label>
                            <label>
                                <span class="title__icsi-css">{lang('Minuses', 'comments')}</span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_minus" id="comment_text_minus" >{$_POST.comment_text}</textarea>
                                </span>
                            </label>
                                -->
                                {if $use_captcha}
                                    <label>
                                        <span class="title__icsi-css">{lang('Code protection', 'comments')}</span>
                                        {$cap_image}
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="captcha" id="captcha"/>
                                        </span>
                                    </label>
                                {/if}

                                <div class="frameLabel__icsi-css">
                                    <span class="title__icsi-css">&nbsp;</span>
                                    <span class="frame_form_field__icsi-css">
                                        <input class="pts" type="submit" value="{lang('Задать вопрос', 'comments')}" class="btn__icsi-css" onclick="post(this); _gaq.push(['_trackEvent', '{echo $CI->uri->uri_string()}', $('.comment_text').val().substring(0,100), 'Задать вопрос']);"/>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of new comment fild -->
                </div>
            </div>
        </div>
    {/if}
    <div class="frame-drop-comment__icsi-css " data-rel="whoCloneAddPaste">
        <div class="form-comment__icsi-css form__icsi-css ins-dev-comm">
            <form>
                <label>
                    <span class="frame_form_field__icsi-css">
                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                    </span>
                </label>

                {if !$is_logged_in}
                    <label>
                        <span class="title__icsi-css">{lang('Your name', 'comments')}</span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
                        </span>
                    </label>
                    <label>
                        <span class="title__icsi-css">{lang('Email', 'comments')} </span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                        </span>
                    </label>
                    {if $use_moderation}
                        <label>
                            <span class="frame_form_field__icsi-css">
                                <div class="msg">
                                    <div class="success">
                                        {lang('The comment will be sent for moderation', 'comments')}
                                    </div>
                                </div>
                            </span>
                        </label>
                    {/if}
                {/if}
                <label>
                    <span class="title__icsi-css">{lang('Comment', 'comments')}</span>
                    <span class="frame_form_field__icsi-css">
                        <textarea class="comment_text" name="comment_text"></textarea>
                    </span>
                </label>
                <div class="frameLabel__icsi-css">
                    <span class="title__icsi-css">&nbsp;</span>
                    <span class="frame_form_field__icsi-css">
                        <input type="hidden" id="parent" name="comment_parent" value="">
                        <input type="submit" value="{lang('Leave comment', 'comments')}" class="btn__icsi-css" onclick="post(this)"/>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>