{# Variables
/**
* @start_page.tpl - template for displaying start page
* Variables
*   $banners: (array) which contains shop banners
*/
#}
<div class="start_page">

    <!-- Show Banners in circle -->
    {$CI->load->module('banners')->render()}
    <!-- Show banners in circle -->
    {//widget_ajax('action_products', '.mainFrameBaner')}

    {//widget_ajax('new_products', '.mainFrameBaner')}

    {//widget_ajax('popular_products','.mainFrameBaner')}

    {widget('action_products')}

    {widget('new_products')}

    {widget('popular_products')}



</div>
<script type="text/javascript" src="{$THEME}js/jquery.cycle.all.min.js"></script>