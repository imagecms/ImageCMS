{if $can_comment == 1 AND !$is_logged_in}
    <label>
        <span class="title__icsi-css">{sprintf(lang('Только авторизованные пользователи могут оставлять комментарии. <a href="%s" class="loginAjax">Авторизуйтесь</a>, пожалуйста.','webinger'), site_url($modules.auth))}</span>
    </label>
{/if}
<div id="comment__icsi-css">
    {if $comments_arr}
        <div class="title_h2__icsi-css">{lang('Отзывы клиентов','webinger')}</div>
        <ul class="frame-list-comment__icsi-css">
            {foreach $comments_arr as $key => $comment}
                <input type="hidden" id="comment_item_id" name="comment_item_id" value="{$comment['id']}"/>
                <li>
                    <div class="author-data-comment__icsi-css">
                        <span class="author-comment__icsi-css">{$comment.user_name}</span>&nbsp;&nbsp;
                        {if $comment.rate != 0}
                            <div class="star-small d_i-b">
                                <div class="productRate star-small">
                                    <div style="width: {echo (int)$comment.rate *20}%"></div>
                                </div>
                            </div>&nbsp;&nbsp;
                        {/if}
                        <span class="date-comment__icsi-css"> {date('d-m-Y H:i', $comment.date)}</span>
                    </div>
                    <div class="frame-comment__icsi-css">
                        <p>{$comment.text}</p>
                        {if $comment.text_plus != Null}
                            <p>
                                <b>{lang('Плюсы','webinger')}</b><br>
                                {$comment.text_plus}
                            </p>
                        {/if}
                        {if $comment.text_minus != Null}
                            <p>
                                <b>{lang('Минусы','webinger')}</b><br>
                                {$comment.text_minus}
                            </p>
                        {/if}
                    </div>
                    <div class="func-button-comment__icsi-css">
                        {if $can_comment == 0 OR $is_logged_in}
                            <div class="btn__icsi-css f_l__icsi-css">
                                <button type="button" data-rel="cloneAddPaste" data-parid="{$comment['id']}">
                                    <span class="icon-comment__icsi-css">
                                    </span>
                                    {lang('Ответить','webinger')}
                                </button>
                            </div>
                        {/if}

                        <div class="f_r__icsi-css">
                            <span class="helper__icsi-css" style="height: 35px;"></span>
                            <span>
                                <span class="btn__icsi-css like__icsi-css">
                                    <button type="button" class="usefullyes" data-comid="{echo $comment.id}">
                                        {lang('Понравился отзыв','webinger')}
                                    </button>
                                    <span id="yesholder{$comment.id}">({echo $comment.like})</span>
                                </span>
                                <span class="divider_l_dl__icsi-css">|</span>
                                <span class="btn__icsi-css dis-like__icsi-css">
                                    <button type="button" class="usefullno" data-comid="{echo $comment.id}">
                                        {lang('Не понравился','webinger')}
                                    </button>
                                    <span id="noholder{$comment.id}">({echo $comment.disslike})</span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <ul class="frame-list-comment__icsi-css">
                        {foreach $comment_ch as $com_ch}
                            {if $com_ch.parent == $comment.id}
                                <li>
                                    <div class="author-data-comment__icsi-css">
                                        <span class="author-comment__icsi-css">{$com_ch.user_name}</span>
                                        <span class="date-comment__icsi-css">{date('d-m-Y H:i', $com_ch.date)}</span>
                                    </div>
                                    <div class="frame-comment__icsi-css">
                                        <p>
                                            {$com_ch.text}
                                        </p>
                                    </div>
                                </li>
                            {/if}
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
        </ul>
    {/if}

    {if $can_comment == 0 OR $is_logged_in}
        <div class="main-form-comments__icsi-css">
            <div class="frame-comments__icsi-css">
                <div class="inside-padd">
                    <div class="title_h2__icsi-css">{lang('Оставьте свой отзыв','webinger')}</div>
                    <!-- Start of new comment fild -->
                    <div class="form-comment__icsi-css form__icsi-css horizontal-form">
                        <div class="inside-padd">
                            <form method="post">
                                <label>
                                    <span class="frame_form_field__icsi-css">
                                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                                    </span>
                                </label>
                                <!-- Start star reiting -->
                                <div class="frameLabel__icsi-css">
                                    <span class="title__icsi-css">{lang('Вашa оценка','webinger')}</span>
                                    <div class="frame_form_field__icsi-css">
                                        <div class="star">
                                            <div class="productRate star-big clicktemprate">
                                                <div class="for_comment"style="width: 0%"></div>
                                                <input id="ratec" name="ratec" type="hidden" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End star reiting -->
                                {if !$is_logged_in}
                                    <label>
                                        <span class="frame_form_field__icsi-css">
                                            <div class="msg">
                                                <div class="success">
                                                    {lang('Коментарий будет отправлен на модерацию', 'webinger')}
                                                </div>
                                            </div>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title__icsi-css">{lang('Ваше имя','webinger')}</span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
                                        </span>
                                    </label>
                                    <label>
                                        <span class="title__icsi-css">{lang('Почта','webinger')}</span>
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                                        </span>
                                    </label>
                                    <!--
                                <label>
                                    <span class="title__icsi-css">{lang('Сайт','webinger')}</span>
                                    <span class="frame_form_field__icsi-css">
                                        <input type="text" name="comment_site" id="comment_site" value="{get_cookie('comment_site')}"/>
                                    </span>
                                </label>
                                    -->
                                {/if}

                                <label>
                                    <span class="title__icsi-css">{lang('Комментарий','webinger')}</span>
                                    <span class="frame_form_field__icsi-css">
                                        <textarea name="comment_text" class="comment_text">{$_POST.comment_text}</textarea>
                                    </span>
                                </label>
                                <!-- If you want get plus and minus for products - uncoment it
                            <label>
                                <span class="title__icsi-css">{lang('Плюсы','webinger')}</span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_plus" id="comment_text_plus">{$_POST.comment_text}</textarea>
                                </span>
                            </label>
                            <label>
                                <span class="title__icsi-css">{lang('Минусы','webinger')}</span>
                                <span class="frame_form_field__icsi-css">
                                    <textarea name="comment_text_minus" id="comment_text_minus" >{$_POST.comment_text}</textarea>
                                </span>
                            </label>
                                -->
                                {if $use_captcha}
                                    <label>
                                        <span class="title__icsi-css">{lang('Код протекции','webinger')}</span>
                                        {$cap_image}
                                        <span class="frame_form_field__icsi-css">
                                            <input type="text" name="captcha" id="captcha"/>
                                        </span>
                                    </label>
                                {/if}

                                <div class="frameLabel__icsi-css">
                                    <span class="title__icsi-css">&nbsp;</span>
                                    <span class="frame_form_field__icsi-css">
                                        <input type="submit" value="{lang('Оставить отзыв','webinger')}" class="btn__icsi-css" onclick="post(this)"/>
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

    <div class="frame-drop-comment__icsi-css" data-rel="whoCloneAddPaste">
        <div class="form-comment__icsi-css form__icsi-css">
            <form>
                <label>
                    <span class="frame_form_field__icsi-css">
                        <div class="frameLabel__icsi-css error_text" name="error_text"></div>
                    </span>
                </label>

                {if !$is_logged_in}
                    <label>
                        <span class="title__icsi-css">{lang('Ваше имя','webinger')}</span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_author" id="comment_author" value="{get_cookie('comment_author')}"/>
                        </span>
                    </label>
                    <label>
                        <span class="title__icsi-css">{lang('Почта','webinger')} </span>
                        <span class="frame_form_field__icsi-css">
                            <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}"/>
                        </span>
                    </label>

                    <label>
                        <span class="frame_form_field__icsi-css">
                            <div class="msg">
                                <div class="success">
                                    {lang('Коментарий будет отправлен на модерацию', 'webinger')}
                                </div>
                            </div>
                        </span>
                    </label>
                {/if}
                <label>
                    <span class="title__icsi-css">{lang('Комментарий', 'webinger')}</span>
                    <span class="frame_form_field__icsi-css">
                        <textarea class="comment_text" name="comment_text"></textarea>
                    </span>
                </label>
                <div class="frameLabel__icsi-css">
                    <span class="title__icsi-css">&nbsp;</span>
                    <span class="frame_form_field__icsi-css">
                        <input type="hidden" id="parent" name="comment_parent" value="">
                        <input type="submit" value="{lang('Оставить отзыв','webinger')}" class="btn__icsi-css" onclick="post(this)"/>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>