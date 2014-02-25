<div class="page-main">
    <div class="container f-s_0">
        <ul class="tabs tabs-special-proposition">
            <li class="active">
                <button data-href="#popular_products" type="button">{lang('Чаще всего покупают', 'newLevel')}</button>
            </li>
            <li>
                <button data-href="#new_products" type="button">{lang('Новинки', 'newLevel')}</button>
            </li>
            <li>
                <button data-href="#action_products" type="button">{lang('Спецпредложения', 'newLevel')}</button>
            </li>
        </ul>
        <div class="frame-tabs-ref">
            <div id="popular_products">
                {widget('popular_products', TRUE)}
            </div>
            <div id="new_products">
                <div class="preloader"></div>
                {widget_ajax('new_products', '#new_products')}
            </div>
            <div id="action_products">
                <div class="preloader"></div>
                {widget_ajax('action_products', '#action_products')}
            </div>
        </div>
        {widget('latest_news', TRUE)}
    </div>
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