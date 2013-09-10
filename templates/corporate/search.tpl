<div class="frame-inside">
    <div class="frame-crumbs">
        {widget('path')}
    </div>
    <div class="container">
        <h2>Результаты поиска: <span class="result">"{$search_title}"</span></h2>
        <div class="text">
            {if !$items}
                <p>{lang('no_pages_found')}</p>
            {/if}
            <ul class="items items-row items-search">
                {foreach $items as $page}
                    <li>
                        <a href="{site_url($page.full_url)}">{$page.title}</a>
                        <p>
                            {$page.parsedText}
                        </p>
                    </li>
                {/foreach}
            </ul>
            <div class="pagination" align="center">
                {$pagination}
            </div>
        </div>
    </div>
</div>