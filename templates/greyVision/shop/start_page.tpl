<div class="page-main">
    {$CI->load->module('banners')->render()}
    {widget('action_products', TRUE)}
    {widget('popular_new_products', TRUE)}

    {widget('brands')}
    <div class="frame-seotext-news">
        <div class="container">
            {widget('latest_news', TRUE)}
            <div class="text seo-text">
                {widget('start_page_seo_text')}
            </div>
        </div>
    </div>
</div>