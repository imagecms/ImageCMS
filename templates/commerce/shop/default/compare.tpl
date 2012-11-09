<div id="has"  >
    <div class="content" >
        {$CI->load->helper('translit')}
        <div class="center">
            <h1>{lang('s_compare_tovars')}</h1>
            {if count($products) > 0}
                <!--<a class="active" style="cursor: pointer; display:none;">{lang('s_all_par')}</a>-->
                <!--<a class="prod_dif" id="all" style="cursor:pointer;">{lang('s_only_diff')}</a>-->
                <a class="prod_show_diff" style="cursor:pointer;">{lang('s_only_diff')}</a>
                {$cnt = 1}
                {$cnc = 1}
                {foreach $categorys as $category}
                    <div class="comparison_slider">
                        <div class="parameters_compr" style="position: relative; min-width: 50px;">        
                            <div class="title">{lang('lang_categories')}: {echo $category.Name}</div>
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
                                    {$prices = currency_convert($product->firstvariant->getPrice(), $product->firstvariant->getCurrency())}
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
                                                    <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo $product->getName()}</a>
                                                    <div class="buy">
                                                        <div class="price f-s_14">{echo $prices.main.price} <sub>{$prices.main.symbol}</sub>
                                                            <br/>
                                                            {if $NextCS != $CS}
                                                                <span>{echo $prices.second.price} {$prices.second.symbol}</span>
                                                            {/if}
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
        <div class="f-s_18 m-t_29 t-a_c">{lang('s_compare_list_em')}</div>
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
