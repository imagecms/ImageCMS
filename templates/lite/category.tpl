{if $no_pages}
        <p>{$no_pages}</p>
{/if}

{foreach $pages as $page}
    <div>
        <h2><a href="{site_url($page.full_url)}">{$page.title}</a></h2>
        {$page.prev_text}
        <div class="postbot">
            <div class="date">{date('d-m-Y H:i', $page.publish_date)} | Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a></div>
            <div class="commentsnum"><a href="{site_url($page.full_url)}#comments">Комментарии ({$page.comments_count})</a></div>
        </div>
    </div>
{/foreach}

    <div class="pagination" align="center">
        {$pagination}
    </div>
