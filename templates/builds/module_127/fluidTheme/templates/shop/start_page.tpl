<div class="page-main">
    <div class="container f-s_0">
        <ul class="tabs tabs-special-proposition">
            <li class="active">
                <button data-href="#popular_products" type="button">{lang('Хиты', 'newLevel')}</button>
            </li>
            <li>
                <button data-href="#new_products" type="button">{lang('Новинки', 'newLevel')}</button>
            </li>
            <li>
                <button data-href="#action_products" type="button">{lang('Спецпредложения', 'newLevel')}</button>
            </li>
        </ul>
        <div class="frame-tabs-ref">
            <div id="popular_products">
                {widget('popular_products')}
            </div>
            <div id="new_products">
                {widget('new_products')}
            </div>
            <div id="action_products">
                {widget('action_products')}
            </div>
        </div>
        {widget('latest_news')}
    </div>
</div>