<li class="active">
    {if $wrapper}
        <button type="button" title="{$title}" data-drop-filter="next()" class="f-s_0">
            <span class="f-s_0">
                <span class="text-el">{$title}</span>
                <span class="icon-arrow-d"></span>
            </span>
        </button>
        {$wrapper}
    {else:}
        <span>
            {$title}
        </span>
    {/if}
</li>