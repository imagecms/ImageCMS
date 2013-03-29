{if $comment_errors}
    <div class="msg">
        <div class="error">
            <p>{$comment_errors}</p>
        </div>
    </div> 
{elseif $comment_notice}
    <div class="msg">
        <div class="notice">
            <h4>Спасибо!</h4>
            <p>Ваш отзыв будет опубликован на нашем сайте после проверки модератором</p>
        </div>
    </div>
{/if}