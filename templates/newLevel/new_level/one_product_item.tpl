{$widget = $widget != false && $widget != NULL}
{$default = $defaultItem != false && $defaultItem != NULL}
{$wishlist = $wishlist != false && $wishlist != NULL}
{$compare = $compare != false && $compare != NULL}
{$codeArticle = $codeArticle != false && $codeArticle != NULL}
{$defaultItem = $defaultItem != false && $defaultItem != NULL}
{$limit = $limit != false && $limit != NULL}

{foreach $products as $key => $p}
    {if $key >= $limit && $limit}
        {break}
    {/if}
    {$Comments = $CI->load->module('comments')->init($p)}
    <li {if $p->firstVariant->getStock() == 0}class="not-avail"{/if} data-pos="top">
        <a href="{shop_url('product/' . $p->getUrl())}" class="frame-photo-title" title="{echo ShopCore::encode($p->getName())}">
            <span class="photo-block">
                <span class="helper"></span>
                {$photo = $p->firstVariant->getMediumPhoto()}
                <img data-original="{echo $photo}"
                     src="{$THEME}images/blank.gif"
                     alt="{echo ShopCore::encode($p->firstVariant->getName())}"
                     class="vimg lazy"/>
                {$discount = 0}
                {if $p->hasDiscounts()}
                    {$discount = $p->firstVariant->getvirtual('numDiscount') / $p->firstVariant->toCurrency('origprice') * 100}
                {/if}
                {promoLabel($p->getAction(), $p->getHot(), $p->getHit(), $discount)}
            </span>
            <span class="title">{echo ShopCore::encode($p->getName())}</span>
        </a>
        <div class="description">
            {if $codeArticle}
                <div class="frame-variant-name-code">
                    {$hasCode = $p->firstVariant->getNumber() == ''}
                    <span class="frame-variant-code" {if $hasCode}style="display:none;"{/if}>{lang('Артикул','newLevel')}:
                        <span class="code">
                            {if !$hasCode}
                                {trim($p->firstVariant->getNumber())}
                            {/if}
                        </span>
                    </span>
                    {$hasVariant = $p->firstVariant->getName() == ''}
                    <span class="frame-variant-name" {if $hasVariant}style="display:none;"{/if}>{lang('Вариант','newLevel')}:
                        <span class="code">
                            {if !$hasVariant}
                                {trim($p->firstVariant->getName())}
                            {/if}
                        </span>
                    </span>
                    {if $brand = $p->getBrand()}
                        {$brand = $brand->getName()}
                        {$hasBrand = trim($brand) != ''}
                        <span class="frame-item-brand">{lang('Бренд','newLevel')}:
                            <span class="code">
                                {if $hasBrand}
                                    <a href="{shop_url('brand/'.$p->getBrand()->getUrl())}">
                                        {echo trim($brand)}
                                    </a>
                                {/if}
                            </span>
                        </span>
                    {/if}
                </div>
            {/if}
            {if !$vertical}
                {if $p->enable_comments && intval($Comments[$p->getId()]) !== 0}
                    <div class="frame-star f-s_0">
                        {$CI->load->module('star_rating')->show_star_rating($p, false)}
                        <a href="{shop_url('product/'.$p->url.'#comment')}" class="count-response">
                            {intval($Comments[$p->getId()])}
                            {echo SStringHelper::Pluralize($Comments[$p->getId()], array(lang("отзыв","newLevel"),lang("отзыва","newLevel"),lang("отзывов","newLevel")))}
                        </a>
                    </div>
                {/if}
            {/if}
            <div class="frame-prices f-s_0">
                <!-- Check for discount-->
                {$oldoprice = $p->getOldPrice() && $p->getOldPrice() != 0 && $p->getOldPrice() > $p->firstVariant->toCurrency()}
                {$hasDiscounts = $p->hasDiscounts()}
                {if $hasDiscounts}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo $p->firstVariant->toCurrency('OrigPrice')}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                {if $oldoprice && !$hasDiscounts}
                    <span class="price-discount">
                        <span>
                            <span class="price priceOrigVariant">{echo intval($p->getOldPrice())}</span>
                            <span class="curr">{$CS}</span>
                        </span>
                    </span>
                {/if}
                {if $p->firstVariant->toCurrency() > 0}
                    <span class="current-prices f-s_0">
                        <span class="price-new">
                            <span>
                                <span class="price priceVariant">{echo $p->firstVariant->toCurrency()}</span>
                                <span class="curr">{$CS}</span>
                            </span>
                        </span>
                        {if $NextCS != null}
                            <span class="price-add">
                                <span>
                                    (<span class="price addCurrPrice">{echo $p->firstVariant->toCurrency('Price',$NextCSId)}</span>
                                    <span class="curr-add">{$NextCS}</span>)
                                </span>
                            </span>
                        {/if}
                    </span>
                {/if}
            </div>
            {$variants = $p->getProductVariants()}
            {if !$widget && !$defaultItem && !$compare}
                {if count($variants) > 1}
                    <div class="check-variant-catalog">
                        <div class="lineForm">
                            <select id="сVariantSwitcher_{echo $p->firstVariant->getId()}" name="variant">
                                {foreach $variants as $key => $pv}
                                    {if $pv->getName()}
                                        {$name = ShopCore::encode($pv->getName())}
                                    {else:}
                                        {$name = ShopCore::encode($p->getName())}
                                    {/if}
                                    <option value="{echo $pv->getId()}" title="{echo $name}">
                                        {echo $name}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                {/if}
            {/if}

            <!--            End. Price-->
            <div class="funcs-buttons">
                <!-- Start. Collect information about Variants, for future processing -->
                {foreach $variants as $key => $pv}
                    {if $pv->getStock() > 0}
                        <div class="frame-count-buy variant_{echo $pv->getId()} variant" {if $key != 0}style="display:none"{/if}>
                            {if !$widget && !$default}
                                <div class="frame-count">
                                    <div class="number" data-title="{lang('Количество на складе','newLevel')} {echo $pv->getstock()}" data-prodid="{echo $p->getId()}" data-varid="{echo $pv->getId()}" data-rel="frameplusminus">
                                        <div class="frame-change-count">
                                            <div class="btn-plus">
                                                <button type="button">
                                                    <span class="icon-plus"></span>
                                                </button>
                                            </div>
                                            <div class="btn-minus">
                                                <button type="button">
                                                    <span class="icon-minus"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="text" value="1" data-rel="plusminus" data-title="{lang('Только цифры','newLevel')}" data-min="1" data-max="{echo $pv->getstock()}">
                                    </div>
                                </div>
                            {/if}
                            <div class="btn-buy">
                                <button
                                    {$discount = 0}
                                    {if $hasDiscounts}
                                        {$discount = $pv->getvirtual('numDiscount')/$pv->toCurrency()*100}
                                    {/if}
                                    disabled="disabled"
                                    class="btnBuy infoBut"
                                    type="button"
                                    data-id="{echo $pv->getId()}"
                                    data-prodid="{echo $p->getId()}"
                                    data-varid="{echo $pv->getId()}"
                                    data-count="1"
                                    data-name="{echo ShopCore::encode($p->getName())}"
                                    data-vname="{echo trim(ShopCore::encode($pv->getName()))}"
                                    data-maxcount="{echo $pv->getstock()}"
                                    data-number="{echo trim($pv->getNumber())}"
                                    data-mediumImage="{echo $pv->getMediumPhoto()}"
                                    data-img="{echo $pv->getSmallPhoto()}"
                                    data-url="{echo shop_url('product/'.$p->getUrl())}"
                                    data-price="{echo $pv->toCurrency()}"
                                    data-origPrice="{if $p->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                    data-addPrice="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                    data-prodStatus='{json_encode(promoLabelBtn($p->getAction(), $p->getHot(), $p->getHit(), $discount))}'>
                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                    <span class="text-el">{lang('Купить', 'newLevel')}</span>
                                </button>
                            </div>
                        </div>
                    {else:}
                        <div class="btn-not-avail variant_{echo $pv->getId()} variant" {if $key != 0}style="display:none"{/if}>
                            <button
                                class="infoBut"
                                type="button"
                                data-drop=".drop-report"
                                data-source="/shop/ajax/getNotifyingRequest"

                                data-id="{echo $pv->getId()}"
                                data-prodid="{echo $p->getId()}"
                                data-varid="{echo $pv->getId()}"
                                data-url="{echo shop_url('product/'.$p->getUrl())}"
                                data-price="{echo $pv->toCurrency()}"
                                data-origPrice="{if $p->hasDiscounts()}{echo $pv->toCurrency('OrigPrice')}{/if}"
                                data-addPrice="{if $NextCS != null}{echo $pv->toCurrency('Price',$NextCSId)}{/if}"
                                data-name="{echo ShopCore::encode($p->getName())}"
                                data-vname="{echo trim(ShopCore::encode($pv->getName()))}"
                                data-maxcount="{echo $pv->getstock()}"
                                data-number="{echo trim($pv->getNumber())}"
                                data-img="{echo $pv->getSmallPhoto()}"
                                data-mediumImage="{echo $pv->getMediumPhoto()}"
                                <span class="icon-but"></span>
                                <span class="text-el">{lang('Сообщить о появлении','newLevel')}</span>
                            </button>
                        </div>
                    {/if}
                {/foreach}
            </div>
            {if !$widget && !$defaultItem}
                <div class="p_r frame-without-top">
                    <div class="frame-wish-compare-list no-vis-table">
                        {if $wishlist}
                            <!-- Wish List buttons -->
                            {foreach $variants as $key => $pv}
                                <div class="frame-btn-wish variant_{echo $pv->getId()} variant d_i-b_" {if $key != 0}style="display:none"{/if} data-id="{echo $p->getId()}" data-varid="{echo $pv->getId()}">
                                    {$CI->load->module('wishlist')->renderWLButton($pv->getId())}
                                </div>
                            {/foreach}
                            <!-- end of Wish List buttons -->
                        {/if}
                        {if !$compare}
                            <div class="frame-btn-comp">
                                <!-- compare buttons -->
                                <div class="btn-compare">
                                    <button class="toCompare"
                                            data-prodid="{echo $p->getId()}"
                                            type="button"
                                            data-title="{lang('В список сравнений','newLevel')}"
                                            data-firtitle="{lang('В список сравнений','newLevel')}"
                                            data-sectitle="{lang('В списке сравнений','newLevel')}"
                                            data-rel="tooltip">
                                        <span class="icon_compare"></span>
                                        <span class="text-el d_l">{lang('В список сравнений','newLevel')}</span>
                                    </button>
                                </div>
                                <!-- end of compare buttons -->
                            </div>
                        {/if}
                    </div>
                </div>
            {/if}
            <!-- End. Collect information about Variants, for future processing -->
            {if !$widget && !$compare && !$defaultItem}
                <div class="p_r frame-without-top">
                    <div class="no-vis-table">
                        <!--Start. Description-->
                        {if trim($p->getShortDescription()) != ''}
                            <div class="short-desc">
                                {echo strip_tags($p->getShortDescription())}
                            </div>
                        {elseif $props = ShopCore::app()->SPropertiesRenderer->renderPropertiesInlineNew($p->getId(), 1)}
                            <div class="short-desc">
                                <p>{echo $props}</p>
                            </div>
                        {/if}
                        <!-- End. Description-->
                    </div>
                </div>
            {/if}
        </div>
        <!--        Start. Remove buttons if compare or wishlist-->
        {if $compare && !$widget}
            <button type="button" class="icon_times deleteFromCompare" onclick="Shop.CompareList.rm({echo  $p->getId()}, this)"></button>
        {/if}
        <!--        End. Remove buttons if compare or wishlist-->

        <div class="decor-element"></div>
    </li>
{/foreach}