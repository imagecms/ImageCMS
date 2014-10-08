<div class="lang-switch">
    <ul class="items">
        {foreach $languages as $lang}
            <li>
                {if $lang['default']}
                    <a href="{$current_address}">
                {else:}
                    <a href="/{echo $lang.identif . $current_address}">
                {/if}
                    {if $lang['image']}<img src="{echo $lang['image']}" class="flag" alt="{$lang.lang_name}" style="height: 16px;"/>{/if}{$lang.lang_name}
                </a>
            </li>
        {/foreach}
    </ul>
</div>
