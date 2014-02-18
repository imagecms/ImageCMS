<div class="frame-baner frame-baner-start_page">
    <section class="carousel-js-css baner container resize cycleFrame">
        <!--remove class="resize" if not resize-->
        <div class="content-carousel">
            <ul class="cycle"><!--remove class="cycle" if not cycle-->
                {foreach $banners as $banner}
                    <li data-description="{strip_tags($banner.description)}">
                        {if trim($banner.url)}
                            <a href="{site_url($banner.url)}"><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></a>
                            {else:}
                            <span><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></span>
                            {/if}
                    </li>
                {/foreach}
            </ul>
            <div class="preloader"></div>
            <div class="frame-frame-pager">
                <div class="frame-scroll-pane">
                    <div class="frame-pager content-carousel">
                        <ol class="pager"></ol>
                    </div>
                </div>
            </div>
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
