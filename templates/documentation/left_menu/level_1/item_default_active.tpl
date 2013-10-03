<li{if $is_active_hard == 1} class="active"{/if}>
    <a href="{$link}">{$title}</a>
    {if !empty($wrapper)}
        <span class="tree_menu_icon glyphicon glyphicon-chevron-down"></span>
    {/if}
    {$wrapper}
</li>