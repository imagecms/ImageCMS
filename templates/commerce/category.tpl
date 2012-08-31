
{include_tpl('shop/default/sidebar')}

{if $no_pages}
        <p>{$no_pages}</p>
{/if}

<div class="products_list">
    {foreach $pages as $page}
        <div class="post">
            <h5><a href="{site_url($page.full_url)}">{$page.title}</a></h5>
            <span class="post-pub-info">
                {date('d-m-Y', $page.publish_date)} |
                Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a>
            </span>

            {$page.prev_text}

            <!-- Теги -->
            {if $tags = page_tags($page.id)}
            <div class="tags_list">
                {foreach $tags as $tag}
                    <a href="{site_url('tags/search/'.$tag.value)}">{$tag.value}</a>
                {/foreach}
            </div>
            {/if}

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
</div>

<div class="pagination" align="center">
    {$pagination}
</div>