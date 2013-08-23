{$CI->load->module('banners')->render()}
<div class="frame-benefits">
    {widget('benefits')}
</div>
<div class="frame-start-page-category-menu">
    <div class="container">
        {\Category\RenderMenu::create()->setConfig(array('cache'=>TRUE))->load('start_page_category_menu')}
    </div>
</div>
<div class="horizontal-carousel">
    <div id="popular_products">
        {widget('popular_products')}
    </div>
    <div id="action_products">
        <div class="preloader"></div>
        {widget_ajax('action_products', '#action_products')}
    </div>
    <div id="new_products">
        <div class="preloader"></div>
        {widget_ajax('new_products', '#new_products')}
    </div>
    {widget('brands')}
</div>
<div class="frame-seo-text">
    <div class="container">
        <div class="text seo-text">
            <h1>Интернет-магазин бытовой техники</h1>
            <blockquote><strong>В качестве внутреннего слоя при создании одежды используют натуральный пух или различные синтетические вещества. Натуральный пух делает пуховик более теплым, в то время как синтепон обезопасит одежду от проникновения в нее микроорганизмов. Среди товаров украинского производства пуховики киев отличаются наличием особого гипоаллергенного слоя.</strong></blockquote>
            <p>Существует два основных вида данного предмета зимнего гардероба. Длинные модели прекрасно защитят своих обладательниц от мороза и снегопада. Любительницам спорта, шопинга и вождения автомобилей следует купить пухловики небольшого размера, которые также называют «короткими». Кроме длинных и коротких моделей существуют так называемые универсальные варианты пуховиков. Под такой одеждой располагается специальная прокладка, отстегнув которую можно изменить размеры пуховика. Качественные и удобные пуховики можно в большом ассортименте приобрести в любом магазине зимней одежды. Чтобы найти такие магазины достаточно ввести в поиск купить пуховики киев и в результате посмотреть информацию о расположении предприятий.</p>
        </div>
    </div>
</div>
{widget('latest_news')}