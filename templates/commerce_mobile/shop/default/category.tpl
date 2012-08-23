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
            <div class="crumbs">{renderCategoryPath($model)}</div>
            <a href="filter.html" class="check_filter h_f"><span class="helper"></span><span class="v-a_m"><span class="check_filter_ico icon"></span><span class="title">Подбор по параметрам</span></span></a>
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
        <ul class="pagination">
            <!--    Pagination    -->
            <div class="pagination"><div class="t-a_c">{$pagination}</div></div>
            <!--    Pagination    -->
            <li>
                <span class="active">
                    <span class="helper"></span>
                    <span class="v-a_m">1</span>
                </span>
            </li>
            <li>
                <a href="#">
                    <span class="helper"></span>
                    <span class="v-a_m">2</span>
                </a>
            </li>
            <li class="hellip">
                <span class="helper"></span>
                <span class="v-a_m">...</span>
            </li>
            <li>
                <a href="#">
                    <span class="helper"></span>
                    <span class="v-a_m">23</span>
                </a>
            </li>
        </ul>
