


<div class="frame-inside">
    <div class="container">
        <div class="">
            {widget('path')}
            <div class="clearfix">
                <h1 class="f_l">{$category.name}</h1>
            </div>
            {if $no_pages}
                <p>{$no_pages}</p>
            {else:}
                {$category.short_desc}
                <ul>
                    {foreach $pages as $page}
                        <li>
                            <em>{date('d.m.Y',$page.publish_date)}</em> <a href="{site_url($page.full_url)}">{$page.title}</a>
                            {$page.prev_text}
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
</div>
<div class="pagination" align="center">
    {$pagination}
</div>
