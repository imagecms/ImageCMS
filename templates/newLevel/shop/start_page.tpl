{$CI->load->module('banners')->render()}
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
<div class="frame-seo-text">
    <div class="container">
        <div class="text seo-text">
            <h1>{lang('Online store of household equipment','newLevel')}</h1>
            <blockquote><strong>{lang('','newLevel')}</strong></blockquote>
            <p>Существует два основных вида данного предмета зимнего гардероба. Длинные модели прекрасно защитят своих обладательниц от мороза и снегопада. Любительницам спорта, шопинга и вождения автомобилей следует купить пухловики небольшого размера, которые также называют «короткими». Кроме длинных и коротких моделей существуют так называемые универсальные варианты пуховиков. Под такой одеждой располагается специальная прокладка, отстегнув которую можно изменить размеры пуховика. Качественные и удобные пуховики можно в большом ассортименте приобрести в любом магазине зимней одежды. Чтобы найти такие магазины достаточно ввести в поиск купить пуховики киев и в результате посмотреть информацию о расположении предприятий.</p>
        </div>
    </div>
</div>
{widget('latest_news')}
<script type="text/javascript" src="{$THEME}js/jquery.cycle.min.js"></script>