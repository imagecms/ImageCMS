<!-- Загружаем доп.поля для страницы. -->
{$fields = page_fields_extended($page.id)}

<!-- Параметры и описание товара -->
<h1></h1>

{literal}
<style type="text/css">
    div.item_info {
        margin-top:10px;
        width:100%;
    }
    div.image {
        float:left;
        width:250px;
        overflow:hidden;
        text-align:center;
    }
    div.details {
        float:left;
        width:400px;
    }
</style>
{/literal}

{if $CI->session->flashdata('cart_added')}
    <div class="flash">
        Товар добавлен в корзину. <a href="{site_url('simple_cart')}">Перейти в корзину</a>
    </div>
{/if}

<div class="item_info">
    <div class="image">

<div class="robot1">
        <div class="hotimage_catalog"><a href="{site_url($page.full_url)}"><img src="{media_url($fields.image.field_data)}"/></a></div>
        <div class="hot_info">
            <div class="price"><p><span>{$fields.price.field_data}$</span></p></div>
            <form action="{site_url('simple_cart/add_item')}" method="POST" name="order_form">
                <div class="add_to_cart"><a href="javascript:document.forms.order_form.submit();">В корзину</a></div>
            <input type="hidden" name="redirect" value="{uri_string()}" />          
            <input type="hidden" name="item_id" value="{$page.id}" />          
            {form_csrf()}
            </form>
        </div>
</div>
    </div>

    <div class="details">
        <h3>{$page.title}</h3>
        <a href="{site_url($page.cat_url)}"><span class="item_link">{get_category_name($page.category)}</span></a>


        <p>
        <br/>
            {$page.prev_text}
        </p>
        
        <br />
        {fields_group($page.id,'robot_params')} 

        <p style="padding-top:25px;">
        <a href="javascript:history.back(-1);">{lang('history_back')}</a>
        </p>
    </div>
</div>

{$comments}
