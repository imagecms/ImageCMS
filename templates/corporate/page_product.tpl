<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="text left">
                <h1>{$page.title}</h1>
                <!-- Start. Show banner. -->
                {$CI->load->module('banners')->render()}
                <!-- End. Show banner. -->
                <div class="description">
                    {$page.full_text}
                </div>
                {$comments}
            </div>
            <div class="right">
                {widget('product_all')}
            </div>
        </div>
    </div>
</div>