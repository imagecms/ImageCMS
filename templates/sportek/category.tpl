{include_tpl('shop/default/sidebar')}

{if $no_pages}
<p>{$no_pages}</p>
{/if}

<div class="products_list">
    {foreach $pages as $page}
    <div class="post">
        <h5><a href="{site_url($page.full_url)}">{$page.title}</a></h5>
        <span class="post-pub-info">
            {date('d-m-Y', $page.publish_date)} |
            Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
        </span>

        {$page.prev_text}

        <!-- Теги -->
        {if $tags = page_tags($page.id)}
        <div class="tags_list">
            {foreach $tags as $tag}
            <a href="{site_url('tags/search/'.$tag.value)}">{$tag.value}</a>
            {/foreach}
        </div>
        {/if}

        <div class="postinfo">
            <a href="{site_url($page.full_url)}#comments">Комментарии ({$page.comments_count})</a>
            &nbsp;&nbsp;
            <a href="{site_url($page.full_url)}">{lang('full_article')}</a>
        </div>

        <div style="border-bottom:1px solid #ECECEC;">
            &nbsp;
        </div>

    </div>
    {/foreach}
</div>
<div style="display: none">
    <div id="report">
        <div class="products_list" id="collback_form">
            <h1>Сообщить о появлении</h1>
            <!--    <p id="login_error">Please, enter data</p>-->
            <form action="" method="post" class="new_user commentForm callback_form">
                <h2><span id="notifyProductVariantName">{echo $model->firstVariant->getName()}</span></h2>
                <dl>
                    <dt>Ваше имя:<span>*</span</dt>
                    <dd><input type="text" name="name" class="required" value="" /></dd>
                </dl>
                <dl>
                    <dt><label>Email:</label></dt>
                    <dd><input type="text" name="email" value="" /></dd>
                </dl>
                <dl>
                    <dt><label>Мобильный телефон:</label></dt>
                    <dd><input type="text" name="phone" value=""  /></dd>
                </dl>
                <dl>
                    <dt><label>Актуально до:</label></dt>
                    <dd><input type="text" name="actual" value="" /></dd>
                </dl>
                <dl>
                    <dt><label>Дополнительная информация:</label></dt>
                    <dd><textarea name="comment"></textarea></dd>
                </dl>
                <div class="button"><input type="submit" value="Войти" /></div>
                <input type="hidden" name="productId" value="{echo $model->getId()}" />
                <input type="hidden" name="variantIds" value="{echo $varId}" />

                {form_csrf()}
            </form>
        </div>
    </div>
</div>

<div class="pagination" align="center">
    {$pagination}
</div>