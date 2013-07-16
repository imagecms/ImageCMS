<div class="frame-inside">
    <div class="container">
        {getPageCategoryPath($page.id, $delim = " / ", $is_page = true)}
        <div class="clearfix head-category">
            <div class="f_l">
                <h1 class="d_i">{echo encode($page.title)}</h1>
            </div>
        </div>
        <div class="clearfix">
            <ul class="items items-brands main">
                {foreach ShopCore::app()->SBrandsHelper->mostProductBrands(500, TRUE) as $brand}
                    <li>
                        <a href="{shop_url($brand.full_url)}">
                            <span class="photo-block">
                                <span class="helper"></span>
                                <img src="{media_url($brand.img_fullpath)}" title="{$brand.name}" />
                            </span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>
