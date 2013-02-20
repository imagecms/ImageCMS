{# Variables
# @var products
# @var totalProducts
# @var brandsInSearchResult
# @var pagination
# @var tree
# @var model
# @var editProductUrl
# @var jsCode
#}
{# Display sidebar.tpl #}
{if !isset($_GET['text'])}
        <div class="frame_search">
            <form method="get" action="/shop/search">
                <input type="submit" class="f_r search_button" value="Искать"/>
                <div class="frame_frame_input">
                    <span class="icon search_ico"></span>
                    <div class="frame_input">
                        <span class="l_p"></span>
                        <input type="text" name="text" />
                        <span class="r_p"></span>
                    </div>
                </div>
            </form>
        </div>
{else:}
       {if !empty(ShopCore::$_GET['text'])}
       <div class="frame_search">
            <form method="get" action="/shop/search">
                <input type="submit" class="f_r search_button" value="Искать"/>
                <div class="frame_frame_input">
                    <span class="icon search_ico"></span>
                    <div class="frame_input">
                        <span class="l_p"></span>
                        <input type="text" name="text" value="{encode($_GET['text'])}" />
                        <span class="r_p"></span>
                    </div>
                </div>
            </form>
        </div>
       <div class="content_head"><div class="crumbs"><h1>Вы искали: "{encode($_GET['text'])}"</h1>{/if}
       {if $totalProducts > 0}
        </div></div>
         <ul class="catalog">
             {foreach $products as $p}
             {$style = productInCart($cart_data, $p->getId(), $p->firstVariant->getId(), $p->firstVariant->getStock())}
            <li>
                <a href="{shop_url('product/' . $p->getUrl())}" class="top_frame_tov">
                    <span class="figure"><img src="{productImageUrl($p->getMainModimage())}"/></span>
                    <span class="descr">
                        <span class="title">{echo ShopCore::encode($p->getName())}</span>
                        <span class="d_b price">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                    </span>
                </a>
            </li>
        {/foreach}
        </ul>
       {if $pagination}
	   <div class="pagination">
            {echo $pagination}
        </div>
       {/if}
    {else:}
    <h1>{echo ShopCore::t('По вашему запросу ничего не найдено')}.</h1>
    </div></div>
    {/if}
{/if}