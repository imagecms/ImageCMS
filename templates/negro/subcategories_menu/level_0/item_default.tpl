<li>
    <a href="{$link}">
        {if $image}
            <span class="photo-block">
                <span class="helper"></span>
                <img src="{$image}" alt="{echo $title}"/>
            </span>
        {/if}
        <span class="title">{echo $title}</span>
        {$wrapper}
    </a>
</li>