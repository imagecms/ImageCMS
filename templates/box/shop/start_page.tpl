<div class="page-main">
    <div class="container">
        <div class="left-start-page">
            {$CI->load->module('banners')->render()}
            <div id="action_products">
                <div class="preloader"></div>
                {widget_ajax('action_products', '#action_products')}
            </div>
            {widget('brands')}
        </div>
        <div class="right-start-page">
            <div id="popular_products">
                {widget('popular_products', TRUE)}
            </div>
            <div id="new_products">
                <div class="preloader"></div>
                {widget_ajax('new_products', '#new_products')}
            </div>
            <div class="frame-seotext-news">
                <div class="frame-seo-text">
                    <div class="container">
                        <div class="text seo-text">
                            {widget('start_page_seo_text')}
                        </div>
                    </div>
                </div>
                {widget('latest_news', TRUE)}
            </div>
        </div>
    </div>
    <div class="frame-benefits">
        {widget('benefits')}
    </div>
</div>