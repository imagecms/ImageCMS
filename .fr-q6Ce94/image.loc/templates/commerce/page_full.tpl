<div class="content">
    <div class="center">
        <h1>{echo encode($page.title)}</h1>
        <div class="text">
            {if $page.id == 68 || $page.lang_alias == 68}
            <div class="f_l map">
                <img src="{$SHOP_THEME}images/map.jpg"/>
            </div> 
            <div class="f_r contacts_info">
                {$page.full_text}
            </div>
            {else:}
                {$page.full_text}
            {/if}
        </div>
    </div>
</div>