<div class="page-main container">
    <div class="left-start-page">
        {$CI->load->module('banners')->render()}
        <div id="action_products">
            {widget('action_products', TRUE)}
        </div>
        <div id="popular_products">
            {widget('popular_products', TRUE)}
        </div>
        <div id="new_products">
            {widget('new_products', TRUE)}
        </div>
        <div class="frame-seo-text">
            <div class="text seo-text">
                {widget('start_page_seo_text')}
            </div>
        </div>
    </div>
    <div class="right-start-page">
        <div class="frame-little-banner">
            {foreach $CI->load->module('banners')->getByGroup('right-main') as $banner}
                <p>
                    {if trim($banner.url)}
                        <a href="{site_url($banner.url)}"><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}" class="lazy"/></a>
                        {else:}
                        <span><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}" class="lazy"/></span>
                        {/if}
                </p>
            {/foreach}
        </div>
        <div class="frame-benefits">
            {widget('benefits')}
        </div>
        {widget('brands')}
        <div class="frame-seotext-news">
            {widget('latest_news', TRUE)}
        </div>
    </div>
</div>