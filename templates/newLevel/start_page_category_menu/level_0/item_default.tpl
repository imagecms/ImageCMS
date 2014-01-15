<li>
    <a href="{$link}" class="frame-photo-title">
        {if $image}
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{$image}" alt="{echo $title}"/>
            </span>
        {/if}
        <span class="title">{echo $title}</span>
    </a>
    {$wrapper}
</li>