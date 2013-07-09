<li class="column_{if !$column}0{else:}{$column}{/if}">
    <a href="{$link}" title="{$title}" class="title-category-l1 {if $wrapper != FALSE} is-sub{/if}">
        <span class="helper"></span>
        <span class="text-el">{$title}</span>
    </a>
    {$wrapper}
</li>