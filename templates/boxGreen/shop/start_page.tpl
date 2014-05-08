<div class="page-main">
    <div class="container">
        <div class="left-start-page">
            {$CI->load->module('banners')->render()}
            <div id="action_products">
                {widget('action_products', TRUE)}
            </div>
            {widget('brands')}
        </div>
        <div class="right-start-page">
            <div id="popular_products">
                {widget('popular_products', TRUE)}
            </div>
            <div id="new_products">
                {widget('new_products', TRUE)}
            </div>
            {widget('latest_news', TRUE)}
        </div>
    </div>
</div>