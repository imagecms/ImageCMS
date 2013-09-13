{# Variables
/**
* @start_page.tpl - template for displaying start page
* Variables
*   $banners: (array) which contains shop banners
*/
#}
<div class="start_page container">
    <section class="row-fluid m-b_20">
        {include_tpl('../widgets/menu_settings')}
        <!-- Show Banners in circle -->
        <div class="span9">
            <div class="mainFrameBaner">
                {$CI->load->module('banners')->render()}
            </div>
            {widget('freecode')}
        </div>
    </section>
    <section class="container">
        <div class="row-fluid">
            <div class="span7">
                {widget('infobox1')}
            </div>
            <div class="span5">
                {widget('Kits')}
                {widget('action_products')}
            </div>
    </section>
</div>
{widget('popular_products')}
{widget('new_products')}