{$CI->load->module('banners')->render()}
<div class="frame-benefits">
    {widget('benefits')}
</div>
<div class="horizontal-carousel">
    <div id="popular_products">
        {widget('popular_products')}
    </div>
    <div id="action_products">
        <div class="preloader"></div>
        {widget_ajax('action_products', '#action_products')}
    </div>
    <div id="new_products">
        <div class="preloader"></div>
        {widget_ajax('new_products', '#new_products')}
    </div>
    {widget('brands')}
</div>
<div class="frame-seo-text">
    <div class="container">
        <div class="text seo-text">
            {widget('start_page_seo_text')}
        </div>
    </div>
</div>