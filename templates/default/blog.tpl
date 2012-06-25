<div id="titleExt"><h5>{widget('path')}<span class="ext">{$category.name}</span></h5></div>
{$category.short_desc}
{if $no_pages}
        <p>{$no_pages}</p>
{/if}
{foreach $pages as $page}
	<div class="post">
        <h2><a href="{site_url($page.full_url)}">{$page.title}</a></h2>  
        <span class="post-pub-info">
            {date('d-m-Y', $page.publish_date)} | 
            Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
			{if $tags = page_tags($page.id)} | Теги: {foreach $tags as $tag}
                <a href="{site_url('tags/search/'.$tag.value)}">{$tag.value}</a> 
            {/foreach}{/if}
        </span>
        
        {$page.prev_text}

        <div class="postinfo">
           <a href="{site_url($page.full_url)}#comments">Комментарии ({$page.comments_count})</a> 
           &nbsp;&nbsp;
           <a href="{site_url($page.full_url)}">{lang('full_article')}</a>
        </div>

        <div style="border-bottom:1px solid #ECECEC;">
            &nbsp;
        </div>

     </div>
{/foreach}

<div class="pagination" align="center">
    {$pagination}
</div>