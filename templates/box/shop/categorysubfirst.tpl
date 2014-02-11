<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside">
    <div class="container">
        <div class="left-catalog-first">
            <div class="f-s_0 title-category">
                <div class="frame-title">
                    <h1 class="title">{echo $category->getName()}</h1>
                </div>
            </div>
            {$CI->load->module('banners')->render($category->getId())}

            {\Category\RenderMenu::create()->load('category_menu_first')}
        </div>
        <div class="right-catalog-first" id="popular_product_category">
            <div class="preloader" style="height: 500px;"></div>
            {widget_ajax('popular_products_category_v', '#popular_product_category')}
        </div>
    </div>
</div>
{if trim($category->getDescription()) != ""}
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {echo trim($category->getDescription())}
            </div>
        </div>
    </div>
{/if}