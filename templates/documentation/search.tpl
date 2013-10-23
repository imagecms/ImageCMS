<div class="frame-inside">
    <div class="">
        <div class="crumbs-custome">
            {widget('path')}
        </div>
        <div class="text left container search-res">
            <h2>Результаты поиска: <span class="result">"{$search_title}"</span></h2>
            <div class="find-in-cat">Найдено статей: 32</div>
            <div class="text">
                {if !$items}
                <p>{lang('Ничего не найдено','corporate')}</p>
                {/if}
                <ul class="items items-row items-search">
                    {foreach $items as $page}
                    <li>
                        <a href="{site_url($page.full_url)}">{$page.title}</a>
                        <div class="search-cat">категория: Разработчикам</div>
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
</div>