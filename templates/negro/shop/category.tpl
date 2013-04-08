{$Comments = $CI->load->module('comments')->init($products)}
{$forCompareProducts = $CI->session->userdata('shopForCompare')}
<div class="frame-crumbs">
    <div class="container">
        {myCrumbs($model->id, " / ")}
    </div>
</div>
{$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)}
{if count($banners)}
    <div class="frame_baner">
        <section class="carousel_js baner container">
            <div class="content-carousel">
                 <ul class="cycle">
                    {foreach $banners as $banner}
                        <li>
                            {if trim($banner['url']) != ""}
                                <a href="{echo $banner['url']}">
                                    <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                                </a>
                            {else:}
                                <img src="/uploads/shop/banners/{echo $banner['image']}" alt="{echo ShopCore::encode($banner['name'])}" />
                            {/if}
                        </li>
                    {/foreach}
                </ul>
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </section>
    </div>
{/if}
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog">
            <div class="f-s_0 title-head-ategory">
                <div class="d_i m-r_15">
                    <h1 class="d_i">{echo $model->name}</h1>
                </div>
                {if $totalProducts > 0}
                    <span class="count">(Найдено {$totalProducts} {echo SStringHelper::Pluralize($totalProducts, array('товар','товара','товаров'))})</span>
                {/if}
            </div>

            {include_tpl('catalogue_header')}

            {if count($products) > 0}
                <ul class="items-catalog {if $_COOKIE['listtable'] == 1}list{/if}" id="items-catalog-main">
                    {include_tpl('one_product_item')}
                </ul>
                {$pagination}
            {else:}
                <div class="alert alert-search-result">
                    <div class="title_h2 t-a_c">По вашему запросу товаров не найдено</div>
                </div>
            {/if}
        </div>

        {$CI->load->module('smart_filter')->init()}
</div>
{if trim($model->description) != ""}
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {echo trim($model->description)}
            </div>
        </div>
    </div>
{/if}
{widget('popular_products')}