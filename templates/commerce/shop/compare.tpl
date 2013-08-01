<div id="has"  >
    <div class="content" >
        {$CI->load->helper('translit')}
        <div class="center">
            <h1>{lang("Compare Products","admin")}</h1>
            {if count($products) > 0}
                <!--<a class="active" style="cursor: pointer; display:none;">{lang("All the parameters","admin")}</a>-->
                <!--<a class="prod_dif" id="all" style="cursor:pointer;">{lang("Only Differences","admin")}</a>-->

                {$cnt = 1}
                {$cnc = 1}
                {foreach $categories as $category}
                    <div class="comparison_slider">
                        <div class="frame_button_compare">
                            <div class="prod_show_diff button_compare disabled"><span class="js blue">{lang("All the parameters","admin")}</span></div>
                            <div class="prod_show_diff"><span class="js blue">{lang("Only Differences","admin")}</span></div>
                            <div class="no_differ">Нет различий</div>
                        </div>
                        <div class="parameters_compr">
                            <div class="title">{lang("Category","admin")}: {echo $category.Name}</div>
                        </div>
                        <div class="comparison_slider_left">
                            {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                            {foreach $data as $d}                                    
                                <span data-row="{echo translit($d)}{echo $category['Id']}">
                                    <script> var den = {$cnt}</script>
                                    <span class="todifff{echo $cnt++}">{$d}</span>
                                </span>
                            {/foreach}
                        </div>                                
                        <div class="comparison_tovars" >                               
                            <script> var bar = {$cnc}</script>
                            <ul class="comparison_slider_right{echo $cnc++}">                                   
                                {foreach $products as $product}
                                    {$style = productInCart($cart_data, $product->getId(), $product->firstVariant->getId(), $product->firstVariant->getStock())}
                                    {if $product->category_id == $category['Id']}
                                        <li class="list_desire" id="product_block_{echo $product->getId()}">
                                            <div class="frame_porivnjanja_tovar smallest_item">
                                                <div class="photo_block">
                                                    <a href="{shop_url('product/' . $product->getUrl())}">
                                                        <img src="{productImageUrl($product->getSmallModimage())}" alt="{echo ShopCore::encode($product->name)}" />
                                                    </a>
                                                    <div class="clearfix">
                                                    </div>
                                                    <span class="delete_tovar img" data-pid="{echo $product->getId()}" style="width: 20px; height: 20px;"></span>
                                                </div>
                                                <div class="func_description">
                                                    <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo $product->getName()}{echo $product->getName()}</a>
                                                    <div class="buy">
                                                        <div class="price f-s_14">
                                                            {if $product->hasDiscounts()}
                                                                <del class="price price-c_red f-s_12 price-c_9">
                                                                    {echo $product->firstVariant->toCurrency('OrigPrice')} {$CS}
                                                                </del> 
                                                                <br />
                                                            {/if}
                                                            {echo $product->firstVariant->toCurrency()} <sub>{$CS}</sub>
                                                        </div>
                                                        <div id="p{echo $product->getId()}" class="{$style.class} buttons">
                                                            <span id="buy{echo $product->getId()}" class="{$style.identif}" data-varid="{echo $product->firstVariant->getId()}" data-prodid="{echo $product->getId()}" >
                                                                {$style.message}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field_container_character">
                                                {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($product)}
                                                {$cnt = 1}   
                                                {foreach $data as $d}
                                                    {$cval = ShopCore::encode($d)}
                                                    <span data-row="{echo translit($d)}{echo $category['Id']}">
                                                        <span class="todiff" data-rows="{echo translit($d)}{echo $category['Id']}">
                                                            {if count($pdata[$cval])>1}
                                                                {$i = 0}
                                                                {foreach $pdata[$cval] as $ms}
                                                                    {echo $ms}
                                                                {if $i<(count($pdata[$cval])-1)},{/if}
                                                                {$i++}
                                                            {/foreach}
                                                        {else:}
                                                    {if $pdata[$cval]} {echo $pdata[$cval]} {else:} - {/if}
                                                {/if}
                                            </span>
                                        </span>   

                                    {/foreach}
                                </div>
                            </li>
                        {/if}
                    {/foreach}
                </ul>
            </div>
        </div> 
    {/foreach}           
{else:}
    <div class="comparison_slider">
        <div class="f-s_18 m-t_29 t-a_c">{lang("Comparison list is empty","admin")}</div>
    </div>
{/if}
{widget('latest_news')}
</div>
</div>
</div>
{literal}
    <script>

                                        for (var i = 1; i <= bar; i++) {
                                            width = 0;
                                            $('.comparison_slider_right' + i + ' li').each(function() {
                                                return width += $(this).outerWidth();
                                            });

                                            $('.comparison_slider_right' + i).css('width', width);

                                            $(function() {
                                                $('.comparison_tovars').jScrollPane({
                                                    'showArrows': true
                                                });
                                            });
                                        }
                                        $("#all").live('click', function() {
                                            $(".active").show();
                                            $("#all").hide();
                                        });
                                        $(".active").live('click', function() {
                                            $("#all").show();
                                            $(".active").hide();
                                        });



    </script>
{/literal}
