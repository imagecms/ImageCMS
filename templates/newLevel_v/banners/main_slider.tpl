<div class="frame-baner frame-baner-start_page">
    <section class="carousel_js baner container">
        <div class="content-carousel">
            <ul class="cycle">{/*забирати якщо не цикл*/}
                {foreach $banners as $banner}
                    <li>
                        {if trim($banner.url)}
                            <a href="{site_url($banner.url)}"><img data-src="{echo $banner['photo']}" alt="{ShopCore::encode($banner.name)}"/></a>
                            {else:}
                            <span><img data-src="{echo $banner['photo']}" alt="{ShopCore::encode($banner.name)}"/></span>
                            {/if}
                    </li>
                {/foreach}
            </ul>
            <span class="preloader"></span>
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