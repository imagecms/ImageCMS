<div class="frame-menu-main vertical-menu">
    {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
    <div class="frame-benefits">
        {widget('benefits')}
    </div>
    {widget('brands')}
</div>
<div class="content">

    <div class="page-main">
        {$CI->load->module('banners')->render()}

        {/*}<div class="frame-start-page-category-menu">
        <div class="container">
            {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('start_page_category_menu')}
        </div>
    </div>{ */}
    <div id="action_products">
        <div class="preloader"></div>
        {widget_ajax('action_products', '#action_products')}
    </div>
    <div id="popular_products">
        {widget('popular_products', TRUE)}
    </div>
    {/*}
    <div id="new_products">
        <div class="preloader"></div>
        {widget_ajax('new_products', '#new_products')}
    </div>
    {*/}
    {widget('latest_news', TRUE)}
    <div class="frame-seotext-news">
        <div class="frame-seo-text">
            <div class="container">
                <div class="text seo-text">
                    {widget('start_page_seo_text')}
                </div>
            </div>
        </div>
    </div>
</div>

</div>