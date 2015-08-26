{$loc_items_num = count($items)}
<div class="g-container">
    <h1 class="b-content__title">
        {tlang('Search results')}
    </h1>

    <div class="b-search__info g-text">
        <p class="b-search__info-query">{tlang('Search for:')} <q>{$search_title}</q></p>
        <p class="b-search__info-results">{tlang('Result:')} {$loc_items_num}</p>
    </div>

        {if $loc_items_num > 0}
            <div class="b-content__list">
            {foreach $items as $item}
                {$loc_page_category_name = get_category_name($item.category)}
                <div class="b-content__item">
                    <h2 class="b-content__item-title">
                        <a href="{site_url($item.full_url)}" class="b-content__item-title-link g-link">{$item.title}</a>
                    </h2>
                    {if $loc_page_category_name}
                    <p class="b-content__item-category">
                        <span class="b-content__item-category-title">{tlang('Category:')}</span>
                        <a href="{site_url($item.cat_url)}" class="b-content__item-category-link g-link">{$loc_page_category_name}</a>
                    </p>
                    {/if}
                    <div class="g-text g-text_sub">
                        {if $item.parsedText}
                            {$item.parsedText}
                        {else:}
                            {$item.prev_text}
                        {/if}
                    </div>
                </div>
            {/foreach}
            </div>
        {else:}
            <p class="b-content__noitems g-text">
                {tlang('No results were found! Please try typing something else, or use the menu to find more content')}
            </p>
        {/if}

        {if $pagination}
        <div class="b-content__pagination">
            {$pagination}
        </div>
        {/if}
    </div>