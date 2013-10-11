<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <h1>{$category.name}</h1>
        <div class="text">
            {if $no_pages}
                <p>{$no_pages}</p>
            {else:}
                {$category.short_desc}
                <ul class="items items-row">
                    {foreach $pages as $page}
                        <li>
                            <span class="date">{date('d.m.Y',$page.publish_date)}</span>
                            <h2><a href="{site_url($page.full_url)}">{$page.title}</a></h2>
                                {$page.prev_text}
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
</div>
