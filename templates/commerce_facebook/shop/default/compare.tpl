<div id="has"  >
    <div class="content" >
        <div class="center">
            <h1>Сравнение товаров</h1>
            {if count($products) > 0}
                   <a class="active" style="cursor: pointer">Все параметры</a><br />
                   <a class="prod_dif" id="all" style="cursor:pointer;">Только отличия</a>
                   
{$cnt = 1}
{$cnc = 1}
                {foreach $categorys as $category}
                    <div class="comparison_slider">
                        <div class="parameters_compr" style="position: relative; min-width: 50px;">        

                            <div class="title">Категория: {echo $category.Name}</div>

                        </div>
                            <div class="comparison_slider_left">

                                {$data = ShopCore::app()->SPropertiesRenderer->renderCategoryPropertiesArray($category['Id'])}
                               
                                {foreach $data as $d}                                    
                                    <span>
                                        
                                        <script> var den = {$cnt} </script>
                                        <span class="todifff{echo $cnt++}">{$d}</span>
                                        
                                    </span>
                                {/foreach}
                            </div>                                
                      
                            <div class="comparison_tovars" >                               
                                  <script> var bar = {$cnc}</script>
                                <ul class="comparison_slider_right{echo $cnc++}">                                   
                                    
                                    {foreach $products as $product}
                                        {$prices = currency_convert($product->firstvariant->getPrice(), $product->firstvariant->getCurrency())}
                                        {if $product->category_id == $category['Id']}

                                            <li class="list_desire">
                                                <div class="frame_porivnjanja_tovar smallest_item">
                                                    <div class="photo_block">

                                                        <a href="{shop_url('product/' . $product->getUrl())}">
                                                            <img src="{productImageUrl($product->getSmallModimage())}" alt="{echo ShopCore::encode($product->name)}" />
                                                        </a>
                                                        <div class="clearfix">
                        <!--                                    <div class="di_b star"><img src="{$SHOP_THEME}images/temp/STAR.png"></div>-->                                   

                                                        </div>
                                                        <a class="delete_tovar img"  href="{shop_url('compare/remove/' . $product->getId())}" style="width: 20px; height: 20px;"></a>
                                                    </div>

                                                    <div class="func_description">
                                                        <a href="{shop_url('product/' . $product->getUrl())}" class="title">{echo $product->getName()}</a>
                                                        <div class="buy">
                                                            <div class="price f-s_14">{echo $prices.main.price} <sub>{$prices.main.symbol}</sub>
                                                                <br/>
                                                                <span>{echo $prices.second.price} {$prices.second.symbol}</span>
                                                            </div>


                                                            {if $product->firstvariant->getstock()== 0}
                                                                <div class="buttons button_greys">
                                                                    <a id="goNotifMe" href="http://watermarkimagecms.loc/shop/product/74" data-prodid="{echo $product->getId()}" data-varid="{echo $product->firstVariant->getId()}">Сообщить <br /> о появлении</a>
                                                               
                                                          
                                                        {else:}
                                                            <div class="buttons button_gs">
                                                                <a href="" class="goBuy" data-prodid="{echo $product->getId()}" data-varid="{echo $product->firstVariant->getId()}" >Купить</a>

                                                            {/if}

                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="field_container_character">
                                                    {$pdata = ShopCore::app()->SPropertiesRenderer->renderPropertiesCompareArray($product)}
                                                {$cnt = 1}   
                                                    {foreach $data as $d}
                                                        {$cval = ShopCore::encode($d)}
                                                        
                                               <span>
                                                
                                                   <span class="todiff{echo $cnt++}">
                                                        {if $pdata[$cval]} {echo $pdata[$cval]} {else:} - {/if}
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
                            <div class="f-s_18 m-t_29 t-a_c">Список сравнений пуст</div>
                        </div>
                        {/if}
                        </div>
                    </div>
                </div>
                        {literal}
        <script>
             for(var i = 1; i <= bar; i++){
        width = 0;
    $('.comparison_slider_right'+i+' li').each(function(){
        return width+=$(this).outerWidth();
    });
    
    $('.comparison_slider_right'+i).css('width',width);
    
    $(function(){
        $('.comparison_tovars').jScrollPane({
            'showArrows':true
        });
    });
    }
            
            </script>
    {/literal}
