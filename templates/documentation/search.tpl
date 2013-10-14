<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <h2>Результаты поиска: <span class="result">"{$search_title}"</span></h2>
        <div class="text">
            {if !$items}
                <p>{lang('Ничего не найдено','corporate')}</p>
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
            <div class="items-row pagination" align="center">
                <ul class="pagination">
                    {$pagination}
                </ul>
            </div>
        </div>
    </div>
</div>