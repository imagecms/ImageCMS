{if !$items}
        <p>{lang('no_pages_found')}</p>
{/if}

{foreach $items as $item}

    <h2><a href="{site_url($item.full_url)}">{$item.title}</a></h2>
    {$item.prev_text}
    <div class="postbot">
    <div class="date">{date('d-m-Y H:i', $item.publish_date)} | Раздел: <a href="{site_url($item.cat_url)}">{get_category_name($item.category)}</a></div>
       <div class="commentsnum"><a href="{site_url($item.full_url)}#comments">Комментарии ({$item.comments_count})</a></div>
    </div>

{/foreach}

<div class="pagination" align="center">
    {$pagination}
</div>
