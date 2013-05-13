<div class="container">
    <div class="row-fluid">
        <div class="span3">
            {load_menu('left_menu')}
        </div>
        <div class="span6">
            <article>
                <h1>{echo encode($page.title)}</h1>
                <div class="text">
                    {if $page.id == 68 || $page.lang_alias == 68}
                        <div class="f_l map">
                            <img src="{$THEME}images/map.jpg" alt="map"/>
                            {$page.full_text}
                        </div> 
                    {else:}
                        {$page.full_text}
                    {/if}
                </div>
            </article>
        </div>
    </div>
</div>
