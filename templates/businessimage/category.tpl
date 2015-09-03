<div class="g-container">
    <h1 class="b-content__title">
        {$category.name}
    </h1>
    {if trim($category.short_desc)}
    <div class="b-content__description g-text">
        {$category.short_desc}
    </div>
    {/if}
    
    
    {if count($pages) > 0}
        <div class="b-content__list">
        {foreach $pages as $item}
            <div class="b-content__item">
                <h2 class="b-content__item-title">
                    <a href="{site_url($item.full_url)}" class="b-content__item-title-link g-link">{$item.title}</a>
                </h2>
                <div class="b-content__item-text g-text g-text_sub">
                    {$item.prev_text}
                </div>
            </div>
        {/foreach}
        </div>
    {else:}
        <p class="b-content__noitems g-text">
            {tlang('There are no items to display. Please come back later!')}
        </p>
    {/if}

    {if $pagination}
    <div class="b-content__pagination">
        {$pagination}
    </div>
    {/if}
    
    
</div>
