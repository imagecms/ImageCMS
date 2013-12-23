<li>
    <span title="{$title}" {if $wrapper != FALSE} class="title-category-l1 frame-photo-title"{/if}>
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
