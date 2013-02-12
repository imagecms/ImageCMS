<div class="text">
    {if $page.id == 68}
    <div class="map">
        <span class="figure">
            <img src="{$SHOP_THEME}images/map.jpg">
        </span>
    </div>
    {/if}
    <dl class="t-a_l">
        <dt>{echo encode($page.title)}</dt>
        {$page.full_text}
    </dl>
</div>