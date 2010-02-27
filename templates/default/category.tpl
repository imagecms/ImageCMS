{if $no_pages}
        <p>{$no_pages}</p>
{/if}

{foreach $pages as $page}
    <div class="post">
        <h1><a href="{site_url($page.full_url)}">{$page.title}</a></h1>  
        <span class="post-pub-info">
            {date('d-m-Y', $page.publish_date)} | 
            Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
        </span>
        
        {$page.prev_text}
        
        <div class="postinfo">
           <a href="{site_url($page.full_url)}#comments">Комментарии ({$page.comments_count})</a> 
           &nbsp;&nbsp;
           <a href="{site_url($page.full_url)}">{lang('full_article')}</a>
        </div> 
     </div><!-- post END -->
{/foreach}

<div class="pagination" align="center">
    {$pagination}
</div>
