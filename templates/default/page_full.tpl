    {var_dump($page)}
    
    <div class="post">
        <h1><a href="{site_url($page.full_url)}">{$page.title}</a></h1>  
        <span class="post-pub-info">{date('d-m-Y', $page.publish_date)} | Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a></span>
        
        {$page.prev_text}
        
        <div class="postinfo">
           <a href="javascript:history.back(-1);">{lang('history_back')}</a>
        </div> 
     </div>
    
    <div id="comments">
        {$comments}
    </div>
