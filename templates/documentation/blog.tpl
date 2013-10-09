{if $no_pages}
    <p>{$no_pages}</p>
{/if}
{foreach $pages as $page}
    <div class="col-6 col-sm-6 col-lg-4">
        <h2>{$page.title}</h2>
        <p>{truncate($page.prev_text, 300,'...',true)}</p>
        <p><a class="btn btn-default" href="{site_url($page.full_url)}">View details »</a></p>
    </div><!--/span-->

{/foreach}

