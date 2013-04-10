{#
/**
* @file - template for displaying wish list
* @updated 26 February 2013;
* Variables
* $items : Array of products in wish list
* $profile : (array) Info about user
* $total_price : (string) Total price of all products
*/
#}
<div class="frame-inside">
    <div class="container">
        {if count($items) > 0}
            <div class="clearfix m-b_15">
                <div class="title_h1 f_l">Список желаний</div>
            </div>
<!--            Start. Show products in wish list-->
            <ul class="items-catalog items-wish-list" id="items-catalog-main">
                {foreach $items as $key => $item}
                    {$promos[0] = $item.model}
                    {$CI->template->assign('promos', $promos)}
                    {include_tpl('one_product_item')}
                {/foreach}
            </ul>
<!--            End. Show products-->
<!--            Start. Show form "send wish list to friend" if logged in-->
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
            <!--            End. Show form "send wish list to friend" if logged in-->
        {else:}
<!--      Start. Empty wish list-->
            <div class="clearfix m-b_15">
                <div class="title_h3 f_l">Список желаний пуст</div>
            </div>
<!--      End. Empty wishlist-->
        {/if}
    </div>
</div>