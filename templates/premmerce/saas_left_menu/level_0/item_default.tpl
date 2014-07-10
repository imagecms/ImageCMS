<li>
    <a href="{$link}" {$target} class="{if $wrapper}is-sub{/if}">
        <span class="icon-{$image}"></span>
        <span class="text-el">{$title}</span>
        {if $has_childs}
            <span class="icon-arrow"></span>
        {/if}
    </a>
    {$wrapper}
</li>