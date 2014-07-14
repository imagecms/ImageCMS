<li{if $wrapper} class="is-sub"{/if}>
    {if $wrapper}
        <button type="button" title="{$title}" data-drop-filter="next()">
            <span class="f-s_0">
                <span class="text-el">{$title}</span>
                <span class="icon-arrow-d"></span>
            </span>
        </button>
        {$wrapper}
    {else:}
        <a href="{$link}" {$target} title="{$title}">
            {$title}
        </a>
    {/if}
</li>
