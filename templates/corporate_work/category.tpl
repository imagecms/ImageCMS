<div class="frame-inside">
    <div class="container">
        <div class="wrap-frame-top clearfix">        
            <div class="frame-company frame-comments f_l">
                {$category.short_desc}
            </div> 
            <div class="wrap-company-news f_r">
                <div class="company-news frame-side-menu">
                    <h3>Страници категории</h3>
                    <nav>
                        {if count($pages) > 0}
                        <ul >
                            {foreach $pages as $page}
                            <li>
                                <a href="{site_url($page.full_url)}">{$page.title}</a>
                            </li>
                            {/foreach}
                        </ul> 
                        {/if}
                    </nav>
                </div>
            </div>
        </div>  
        <div class="bottom-description clearfix">   
            
        </div>   
    </div>    
</div>