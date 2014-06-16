{# Variables
# @var model
# @var jsCode
# @var products
# @var totalProducts
# @var brandsInCategory
# @var pagination
# @var cart_data
#}


<div class="content_head">
    <div class="crumbs">{renderCategoryPathNoSeo($category)}
        <h1>{echo ShopCore::encode($category->getTitle())}</h1>
    </div>
    <a href="{shop_url('category/'.$category->getFullPath())}?filteronly" class="check_filter h_f"><span class="helper"></span><span class="v-a_m"><span class="check_filter_ico icon"></span><span class="title">{lang('Подбор по параметрам','commerce_mobiles')}</span></span></a>
<!--        <div class="f-s_24 f_l">{echo ShopCore::encode($category->getTitle())} <span class="count_search">({$totalProducts})</span></div>-->
    <!--                    <div class="f_r">
                            <form method="GET">
                                <div class="lineForm f_l w_145">
                                    <select id="sort" name="order">
                                        <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang("По рейтенгу","commerce_mobiles")}</option>
                                        <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang("От дешевых к дорогим","commerce_mobiles")}</option>
                                        <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang("От дорогих к дешевым","commerce_mobiles")}</option>
                                        <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang("Популярные","commerce_mobiles")}</option>
                                        <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang("Новые","commerce_mobiles")}</option>
                                        <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang("Акционные","commerce_mobiles")}</option>
                                    </select>
                                </div>
                                <div class="lineForm f_l w_50 m-l_10">
                                    <select id="count" name="user_per_page">
                                        <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                                        <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                                        <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                                    </select>
                                </div>
    {if isset($_GET['lp'])}<input type="hidden" name="lp" value="{echo $_GET['lp']}">{/if}
    {if isset($_GET['rp'])}<input type="hidden" name="rp" value="{echo $_GET['rp']}">{/if}
    <input type="submit" value="FIN">
</form>
</div>
</div>-->

    <ul class="catalog">
        {foreach $products as $product}
            <li>
                <a href="{shop_url('product/' . $product->getUrl())}" class="top_frame_tov">
                    <span class="figure"><img src="{productImageUrl($product->getMainModimage())}"/></span>
                    <span class="descr">
                        <span class="title">{echo ShopCore::encode($product->name)}</span>
                        <span class="d_b price">{echo $product->firstVariant->toCurrency()} {$CS}</span>
                    </span>
                </a>
            </li>
        {/foreach}
    </ul>
    <div class="pagination">
        {echo $pagination}
    </div>