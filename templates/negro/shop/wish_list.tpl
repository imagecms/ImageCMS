<div class="frame-crumbs">
</div>
<div class="frame-inside">
    <div class="container">
        {if count($items) > 0}
            <div class="clearfix m-b_15">
                <div class="title_h1 f_l">Список желаний</div>
            </div>
            <ul class="items-catalog items-wish-list" id="items-catalog-main">
                {foreach $items as $key => $item}
                    {$promos[0] = $item.model}
                    {$CI->template->assign('promos', $promos)}
                    {include_tpl('one_product_item')}
                {/foreach}
            </ul>
            {if ShopCore::$ci->dx_auth->is_logged_in() === true}
                <form action="" method="post" name="editForm">
                    <div class="left-order">
                        <input type="text" placeholder="E-mail получателя" name="friendsMail" class="f_l" />
                    </div>
                    <div class="btn btn-order">
                        <button type="submit"  name="sendwish"> Отправить другу </button>
                    </div>
                    {form_csrf()}
                </form>
            {/if}
        {else:}
            <div class="clearfix m-b_15">
                <div class="title_h3 f_l">Список желаний пуст</div>
            </div>
        {/if}
    </div>
</div>