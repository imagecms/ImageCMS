{$promos = getPromoBlock('promo', 10)}
{if count($promos) > 0}
    {$CI->template->assign('promos',$promos)}
    <section class="special-proposition">
        <div class="title_h1 container">Спецпредложения</div>
        <div class="m-w_1090">
            <div class="carousel_js products-carousel">
                <div class="content-carousel container">
                    <ul class="items-catalog">
                        {include_tpl('../shop/one_product_item')}
                    </ul>
                </div>
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </div>
    </section>
{/if}