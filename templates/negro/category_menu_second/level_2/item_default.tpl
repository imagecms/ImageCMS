<li>
    <a href="{$link}" title="{$title}">
        {if $image}
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{$image}" alt="{echo $title}"/>
            </span>
        {/if}
        <span class="text-el">{$title}</span>
    </a>
</li>