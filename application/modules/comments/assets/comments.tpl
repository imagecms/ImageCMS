{/*
    $parent_id - змінна доступна тільки коли добалления підкоментар містить ід батьківського
    $validation_errors - масив помилок ['назва поля' => 'текст помилки']
    
*/}
{/* Якщо корист не зареєстрованй, і коментувати можна тільки зареєстрованим*/}
{if $can_comment == 1 AND !$is_logged_in}
    <b>{sprintf(lang('Пожалуйста, войдите для комментирования', 'fullMarket'), site_url($modules.auth))}</b>
    <button type="button" data-trigger="#loginButton">
        <span class="text-el d_l_1">{lang('Войти','fullMarket')}</span>
    </button>
{/if}
<div>
    {/* Якщо корист зареєстрованй, або коментувати можна не зареєстрованим*/}
    <!-- Start of new comment fild -->
    {if $can_comment == 0 OR $is_logged_in}
        <div class="title-comment">
            {lang('Написать отзыв','fullMarket')}
        </div>
        {$main_comment_error = !$parent_id && $validation_errors}
        {/* Якщо якщо є помилка в новому коменті*/}
        {if $main_comment_error }
            <div style="color: red">
                {foreach $validation_errors as $field => $message }
                    <p>{echo $field . ':' . $message}</p>
                {/foreach}
            </div>
        {/if}
        {/* Форма комента */}
        <form method="post" action="{echo $locale}/comments/addPost">
            <div class="frame-form-field o_h">
                {if !$is_logged_in}
                    <input type="text" name="comment_author" value="{get_cookie('comment_author')}" placeholder="{lang('Ваше имя','fullMarket')}"/>
                    <input type="text" name="comment_email" id="comment_email" value="{get_cookie('comment_email')}" placeholder="{lang('E-mail','fullMarket')}"/>
                {/if}
                <!-- Start star reiting -->
                <span>{lang('Ваша оценка', 'fullMarket')}</span>
                {for $i = 1;$i <= 5; $i++}
                    <input  {if $i == $old_ratec}checked="checked"{/if}name="ratec" type="radio" value="{$i}"/>
                {/for}
                <!-- End star reiting -->
            </div>
            <textarea name="comment_text" placeholder="{lang('Текст отзыва','fullMarket')}">{if $main_comment_error}{echo $old_text}{/if}</textarea>
            {if $use_captcha}
                {$cap_image}
                <input type="text" name="captcha"  placeholder="{lang('Код защиты')}" />
            {/if}
            <input  type="submit" value="{lang('Отправить', 'fullMarket')}" />
            {form_csrf()}
        </form>
    {/if}
    <!-- End of new comment fild -->
    {if $comments_arr}
        <ul>
            {foreach $comments_arr as $key => $comment}
                <li>
                    <span >{$comment.user_name}</span>
                    <span >{echo date("d.n.Y", $comment.date)} </span>
                    <a href="/comments/setyes/{$comment.id}" class="text-el d_l_1">{lang('Полезно','fullMarket')} <span >({echo $comment.like})</span></a>
                    <a href="/comments/setno/{$comment.id}" class="text-el d_l_1">{lang('Не полезно','fullMarket')} <span >({echo $comment.disslike})</span></a>
                    {if $comment.rate != 0}
                        <div> 
                            {echo (int)$comment.rate} 
                        </div>
                    {/if}
                    <p>{$comment.text}</p>
                    {if $can_comment == 0 OR $is_logged_in}
                        {$sub_comment_error = ($parent_id === $comment.id && $validation_errors)}
                        {/* якщо є помилка в підкоменті */}
                        {if $sub_comment_error}
                            <div style="color: red">
                                {foreach $validation_errors as $field => $error}
                                    <p>{echo $field . ':' . $error}</p>
                                {/foreach}
                            </div>
                        {/if}

                        {/* форма підкомента */}
                        <form  method="post" action="/comments/addPost">
                            <input type="hidden" name="comment_parent" value="{$comment.id}">
                            {if !$is_logged_in}
                                <input type="text" name="comment_author" value="{get_cookie('comment_author')}"  placeholder="{lang('Ваше имя','fullMarket')}"/>
                                <input type="text" name="comment_email" value="{get_cookie('comment_email')}"  placeholder="{lang('E-mail','fullMarket')}"/>
                            {/if}
                            <textarea name="comment_text" placeholder="{lang('Текст ответа','fullMarket')}">{if $sub_comment_error}{echo $old_text}{/if}</textarea>
                            <!-- End star reiting -->
                            {if $use_captcha}
                                {$cap_image}
                                <input type="text" name="captcha" id="captcha" placeholder="{lang('Код защиты')}" />
                            {/if}
                            <input type="hidden"  name="comment_parent" value="{$comment.id}">
                            <input type="submit" value="{lang('Отправить', 'fullMarket')}" />
                            {form_csrf()}
                        </form>
                    {/if}

                    {$countAnswers = $CI->load->module('comments')->commentsapi->getCountCommentAnswersByCommentId($comment.id)}
                    {if $countAnswers}
                        <ul>
                            {foreach $comment_ch as $com_ch}
                                {if $com_ch.parent == $comment.id}
                                    <div>
                                        <span class="author-comment">{$com_ch.user_name},</span>
                                        <span class="date">{echo date("d.n.Y", $comment.date)} </span>
                                    </div>
                                    <p>
                                        {$com_ch.text}
                                    </p>
                                {/if}
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/foreach}
        </ul>
    {/if}
</div>
{/*Якщо ці поля треба вивести біля підкоментаря можна використати $parent_id*/}

{/* Якщо коментар успішно добавлений, але включена модерація */}
{if $moderation_enabled}
    <div style="color: green">
        {lang('Ваш комментарий будет опубликован после модерации администратором','fullMarket')}
    </div>
{/if}
{/* Якщо коментар успішно добавлений, але включена модерація */}
{if $validation_errors['time_error']}
    <div style="color: green">
        {echo $validation_errors['time_error']}
    </div>
{/if}