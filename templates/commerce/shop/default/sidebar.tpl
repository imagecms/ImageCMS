<div id="categories_menu_tree">
    <ul class="categories_tree_list">
        {echo ShopCore::app()->SCategoryTree->ul()}
	</ul>

	<h3>Все бренды магазина</h3>
    <div class="brand">
    {foreach SBrandsQuery::create()->find() as $brand}
	    <a href="{shop_url('brand/' . $brand->getUrl())}">{echo $brand->getName()}</a>
	{/foreach}
    </div>
	<h3>Принимаем к оплате</h3>
	<div class="brand">
		<img src="{$SHOP_THEME}images/cards.gif" alt="logo" border="0"/>
	</div>
	<h3>Время работы</h3>
	<div class="time_work">
		Магазин работает <b>круглосуточно</b>, можете заказывать товары в любое время. <br />
		Мы готовы принимать и обрабатывать Ваши заказы каждый день с 10:00 до 19:00. Выходной - воскресенье.
	</div>

    {widget('latest_news')}
</div>