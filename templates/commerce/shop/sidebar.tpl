<div id="categories_menu_tree">
    <ul class="categories_tree_list">
        {echo ShopCore::app()->SCategoryTree->ul()}
	</ul>
    <h3>{lang('s_all_brand_shop')}</h3>
    <div class="brand">
    {foreach SBrandsQuery::create()->joinWithI18n(ShopController::getCurrentLocale())->find() as $brand}
	    <a href="{shop_url('brand/' . $brand->getUrl())}">{echo $brand->getName()}</a>
	{/foreach}
    </div>

    <h3>{lang('s_brand_allfa')}</h3>
    <div class="brand">
    {foreach ShopCore::app()->SBrandsHelper->getBrandsCharaters(false, array('EN')) as $brandsCharater=>$brands}
        {if $brands}
        <div class="bubbleInfo">
        <div class="trigger"><a>{echo $brandsCharater}</a></div>
            <div if class="popup">
                    {foreach $brands as $brand}
                        <a href="{shop_url('brand/' . $brand['url'])}">{echo $brand['name'].'('.$brand['total'].')'}</a>{counter("<br />", "", "")}
                    {/foreach}
            </div>
        </div>
        {else:}
        {echo $brandsCharater}
        {/if}
    {/foreach}
    </div>
	<h3>{lang('s_we_acc')}</h3>
	<div class="brand">
		<img src="{$SHOP_THEME}images/cards.gif" alt="logo" border="0"/>
	</div>
	<h3>{lang('s_oper_time')}</h3>
	<div class="time_work">
		{lang('s_shop_work_time')}
	</div>
</div>