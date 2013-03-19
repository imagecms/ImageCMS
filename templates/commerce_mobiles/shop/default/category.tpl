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
            <div class="crumbs">{renderCategoryPathNoSeo($model)}</div>
            <a href="{shop_url('category/'.$model->getFullPath())}?filteronly" class="check_filter h_f"><span class="helper"></span><span class="v-a_m"><span class="check_filter_ico icon"></span><span class="title">Подбор по параметрам</span></span></a>
        </div>Всего товаров({$totalProducts})
        <div class="f-s_24 f_l">{echo ShopCore::encode($model->getTitle())} <span class="count_search">({$totalProducts})</span></div>
                    <div class="f_r">
                        <form method="GET">
                            <div class="lineForm f_l w_145">
                                <select id="sort" name="order">
                                    <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                                    <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                                    <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                                    <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                                    <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                                    <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
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
                </div>
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