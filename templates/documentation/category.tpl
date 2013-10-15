<div id="titleExt"><h4>{widget('path')}</h4></div>

{foreach $pages as $page}
    <div class="col-6 col-sm-6 col-lg-4">
        <h3>{$page.title}</h3>
        <p>{truncate($page.prev_text,200)}</p>
        <p><a class="btn btn-default" href="{site_url($page.full_url)}">Детальнее &raquo;</a></p>
    </div><!--/span-->

{/foreach}
<div class="items-row" align="center">
    <ul class="pagination">
        {$pagination}
    </ul>
</div>