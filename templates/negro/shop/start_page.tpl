{$banners = ShopCore::app()->SBannerHelper->getBanners()}
{if count($banners)}
    <div class="frame-baner frame-baner-start_page">
        <section class="carousel_js baner container">
            <div class="content-carousel">
                <ul class="cycle">{/*забирати якщо не цикл*/}
                    {foreach $banners as $banner}
                        <li>
                            {if trim($banner.url)}
                                <a href="{site_url($banner.url)}"><img data-src="{media_url('/uploads/shop/banners/'.$banner.image)}" alt="{ShopCore::encode($banner.name)}"/></a>
                                {else:}
                                <span><img data-src="{media_url('/uploads/shop/banners/'.$banner.image)}" alt="{ShopCore::encode($banner.name)}"/></span>
                                {/if}
                        </li>
                    {/foreach}
                </ul>
                <span class="preloader"></span>
                <div class="pager"></div>
            </div>
            <div class="group-button-carousel">
                <button type="button" class="prev arrow"></button>
                <button type="button" class="next arrow"></button>
            </div>
        </section>
    </div>
{/if}
<div class="frame-benefits">
    {widget('benefits')}
</div>
<div class="frame-start-page-category-menu">
    <div class="container">
        {\Category\RenderMenu::create()->load('start_page_category_menu')}
    </div>
</div>
<div class="horizontal-carousel">
    {widget('action_products')}
    {widget('new_products')}
    {widget('popular_products')}
    {widget('brands')}
</div>
<div class="container">
    <div class="text seo-text">
        <h1>Интернет-магазин бытовой техники</h1>
        <blockquote><strong>В качестве внутреннего слоя при создании одежды используют натуральный пух или различные синтетические вещества. Натуральный пух делает пуховик более теплым, в то время как синтепон обезопасит одежду от проникновения в нее микроорганизмов. Среди товаров украинского производства пуховики киев отличаются наличием особого гипоаллергенного слоя.</strong></blockquote>
        <p>Существует два основных вида данного предмета зимнего гардероба. Длинные модели прекрасно защитят своих обладательниц от мороза и снегопада. Любительницам спорта, шопинга и вождения автомобилей следует купить пухловики небольшого размера, которые также называют «короткими». Кроме длинных и коротких моделей существуют так называемые универсальные варианты пуховиков. Под такой одеждой располагается специальная прокладка, отстегнув которую можно изменить размеры пуховика. Качественные и удобные пуховики можно в большом ассортименте приобрести в любом магазине зимней одежды. Чтобы найти такие магазины достаточно ввести в поиск купить пуховики киев и в результате посмотреть информацию о расположении предприятий.</p>
    </div>
</div>
{widget('latest_news')}