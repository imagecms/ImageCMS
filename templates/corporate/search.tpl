<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <h2>{lang('Результаты поиска','corporate')}: <span class="result">"{$search_title}"</span></h2>
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
            <div class="pagination" align="center">
                {$pagination}
            </div>
        </div>
    </div>
</div>