<h1>{$category.name}</h1>

{if $CI->session->flashdata('cart_added')}
    <div class="flash">
        Товар добавлен в корзину. <a href="{site_url('simple_cart')}">Перейти в корзину</a>
    </div>
{/if}

<br />

{if $no_pages}
        <p>В категории нет страниц.</p>
        {return}
{/if}

{foreach $pages as $page}
<!-- Загружаем доп.поля для каждой страницы. -->
{$fields = page_fields_extended($page.id)}

<div class="robot1">
        <h4><a href="{site_url($page.full_url)}">{$page.title}</a></h4>
        <div class="hotimage_catalog"><a href="{site_url($page.full_url)}"><img src="{media_url($fields.image.field_data)}"/></a>
        <br/>
        <a href="{site_url($page.cat_url)}"><span class="item_link">{get_category_name($page.category)}</span></a>
        </div>
        <div class="hot_info">
            <div class="price"><p><span>{$fields.price.field_data}$</span></p></div>
        <form action="{site_url('simple_cart/add_item')}" method="POST" name="order_form_{$page.id}">
            <div class="add_to_cart"><a href="javascript:document.forms.order_form_{$page.id}.submit();">В корзину</a></div>
        <input type="hidden" name="redirect" value="{uri_string()}" />
        <input type="hidden" name="item_id" value="{$page.id}" />
        {form_csrf()}
        </form>  
        </div>
</div>
{/foreach}

<div class="pagination" style="clear:both;padding-top:25px;" align="center">
{$pagination}
</div>
