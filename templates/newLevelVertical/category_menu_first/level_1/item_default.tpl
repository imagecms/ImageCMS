<li>
    <a href="{$link}" title="{$title}" class="title-category-l1 frame-photo-title">
        <span class="text-el">{$title}</span>
        {if $image}
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{$image}" alt="{echo $title}"/>
            </span>
        {/if}
    </a>
    {$wrapper}
</li>