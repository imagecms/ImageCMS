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