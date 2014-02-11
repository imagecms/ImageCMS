<div class="wrap">  		 	       
    <div class="services_grid">
        <div class="content_bottom">
            {foreach $pages as $page}
                <div class="image group marketing">
                    <div class="grid images_3_of_1">
                        <a href="{site_url($page.full_url)}"><img src="{$page.field_marketing_image}" alt=""></a>
                    </div>
                    <div class="grid blog-desc">
                        <h4><a href="{site_url($page.full_url)}">{$page.title}</a></h4>
                        {$page.prev_text}
                        <div class="view-all"><a href="{site_url($page.full_url)}">{lang('More Info', 'houseFraming')}</a></div>
                    </div>
                </div>
            {/foreach}            
        </div>
    </div>
    <div class="sidebar">
        {include_tpl('/sidebars/sidebar_menu')}
    </div>
    <div class="clear"></div>
</div>