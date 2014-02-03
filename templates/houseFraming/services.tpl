<div class="wrap">  		 	       
    <div class="services_grid">
        <div class="content_bottom">
            {foreach $pages as $key => $page}
                {if $key % 2 == 0}
                    <div class="section group service_desc">
                    {/if}
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <img src="{$page.field_image}" alt="Thumb image for {$page.title}" />
                        </div>
                        <div class="text list_2_of_1">
                            <h4>{$page.title}</h4>
                            {$page.prev_text}
                            <div class="view-all">
                                <a href="{site_url($page.full_url)}">{lang('More Info', 'houseFraming')}</a>
                            </div>
                        </div>
                    </div>			                
                    {if $key % 2 == 1}</div>{/if}
                {/foreach}                 
        </div>
    </div>
    <div class="sidebar">
        {include_tpl('sidebars/sidebar_form')}
    </div>
    <div class="clear"></div>
</div>