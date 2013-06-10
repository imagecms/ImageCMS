{$Comments = $CI->load->module('comments')->init($pages)}
<h2>{$category.name}<span>{$category.short_desc}</span></h2>
<div class="blog">
{if $no_pages}
        <p>{$no_pages}</p>
{/if}
{foreach $pages as $page}
				<div class="blogpost_title">
                	<time datetime="{date('d-m-Y', $page.publish_date)}">{date('d M', $page.publish_date)}</time>
                    <h3>{$page.title}</h3>
                    <span><span class="fleft">Раздел: <a href="{site_url($page.cat_url)}">{get_category_name($page.category)}</a></span><a href="{site_url($page.full_url)}#comments" class="comment">{$Comments[$page.id]}</a></span>
                </div>
            	<div class="blogpost">
                	<div>{$page.prev_text}<a href="{site_url($page.full_url)}" class="btn">{lang('full_article')}</a>
                    </div>
                </div>
{/foreach}

<div class="pagination" align="center">
    {$pagination}
</div>
</div>