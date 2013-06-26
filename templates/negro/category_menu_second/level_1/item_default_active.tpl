<li>
    <span title="{$title}" {if $wrapper != FALSE} class="title-category-l1">
        <span class="text-el">{$title}</span>
        {if $image}
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{$image}" alt="{echo $title}"/>
            </span>
        {/if}
    </span>
    {$wrapper}
</li>
