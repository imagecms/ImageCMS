<li class="active">
    {if $wrapper}
        <button type="button" title="{$title}" data-drop-filter="next()">
            {$title}
            <span class="icon-arrow-d"></span>
        </button>
        {$wrapper}
    {else:}
        <span>
            {$title}
        </span>
    {/if}
</li>