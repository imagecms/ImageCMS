<li>
    {if $wrapper}
        <button type="button" title="{$title}" data-drop-filter="next()">
            {$title}
            <span class="icon-arrow-d"></span>
        </button>
        {$wrapper}
    {else:}
        <a href="{$link}" title="{$title}">
            {$title}
        </a>
    {/if}
</li>
