<div class="frame-menu-main vertical-menu">
    {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('category_menu')}
    {widget('latest_news', TRUE)}
</div>
<div class="content">

    <div class="page-main">
        <div class="container">
            <div class="left-start-page">
                {$CI->load->module('banners')->render()}
                <div id="action_products">
                    {widget('action_products', TRUE)}
                </div>
                {widget('brands')}
            </div>
            {/*}
            <div class="right-start-page">
                <div id="popular_products">
                    {widget('popular_products', TRUE)}
                </div>
                <div id="new_products">
                    {widget('new_products', TRUE)}
                </div>
            </div>
            {*/}
        </div>
    </div>

</div>