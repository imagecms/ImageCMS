<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="left">
                <!-- Start. Show banner. -->
                {$CI->load->module('banners')->render($category.id)}
                <!-- End. Show banner. -->
                {widget('offers')}
            </div>
            <div class="right">
                {widget('offers_all')}
            </div>
        </div>  
    </div>    
</div>