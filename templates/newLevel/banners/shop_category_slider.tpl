<div class="frame-baner-catalog frame-baner">
    <section class="carousel_js baner container resize">
        <div class="content-carousel">
            <ul class="cycle">{/*забирати якщо не цикл*/}
                {foreach $banners as $banner}
                    <li>
                        {if trim($banner.url)}
                            <a href="{site_url($banner.url)}"><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></a>
                            {else:}
                            <span><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></span>
                            {/if}
                    </li>
                {/foreach}
            </ul>
            <div class="preloader"></div>
            <div class="pager"></div>
        </div>
        <div class="group-button-carousel">
            <button type="button" class="prev arrow">
                <span class="icon_arrow_p"></span>
            </button>
            <button type="button" class="next arrow">
                <span class="icon_arrow_n"></span>
            </button>
        </div>
    </section>
</div>
