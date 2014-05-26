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
        <div id="action_products">
            {widget('action_products')}
        </div>
        <div id="popular_products">
            {widget('popular_products', TRUE)}
        </div>
        {/*}
        <div id="new_products">
            {widget('new_products')}
        </div>
        { */}
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