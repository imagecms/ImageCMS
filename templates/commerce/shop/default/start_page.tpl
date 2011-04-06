{literal}
    <script type="text/javascript">
    $(window).load(function()
    {
        init_slideshow();
    })

    init_slideshow = function()
    {
        $('#slides').cycle({
            fx:'fade',
            timeout:8000,
            pager:'#slide_navigation',
            after:update_slide_caption,
            before:fade_slide_caption
        })
    }
    </script>
{/literal}

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">

    <!-- BEGIN SLIDESHOW -->
    <div id="slideshow">
            <ul id="slides" style="width: 693px; height: 259px;">
              <li><a href="/shop/product/74"><img src="/uploads/shop/74_main.jpg" alt="" height="256"></a><span class="slide_caption"> <a href="/shop/product/74" class="title">Samsung LN40C650 40" LCD TV</a> Высоко технологический продукт, который поможет Вам оценить качество.</span></li>
              <li><a href="/shop/product/106"><img src="/uploads/shop/106_main.jpg" alt="" height="256"></a><span class="slide_caption"> <a href="/shop/product/106" class="title">Panasonic KX-TG7433B Expandable</a> Высоко технологический продукт, который поможет Вам оценить качество.</span></li>
              <li><a href="/shop/product/98"><img src="/uploads/shop/98_main.jpg" alt="" height="256"></a><span class="slide_caption"> <a href="/shop/product/98" class="title">Samsung NX10 14 Megapixel Digital</a> Высоко технологический продукт, который поможет Вам оценить качество.</span></li>
              <li><a href="/shop/product/96"><img src="/uploads/shop/96_main.jpg" alt="" height="256"></a><span class="slide_caption"> <a href="/shop/product/96" class="title">Canon VIXIA HF R11 Digital</a> Высоко технологический продукт, который поможет Вам оценить качество.</span></li>
            </ul>
            <div id="slideshow_violator" class="clearfix">
              <div id="project_caption"></div>
              <div id="slide_navigation" class="clearfix"></div>
            </div>
    </div>
    <!-- END SLIDESHOW -->

    <!-- BEGIN HITS -->
    <div id="titleExt">
        <h5 class="left">Хиты</h5>
        <div class="sp"></div>
    </div>
    <br/>
    <ul class="products">
    {$count = 1}
    {foreach $hits as $p}
        <li class="{counter('', '', 'last')}">
            <div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
                <a href="{shop_url('product/' . $p->getUrl())}">
                    <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                </a>
            </div>
            <h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
            <div class="price">
                {$p->firstVariant}
                {if $p->hasDiscounts()}
                    <s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
                    <br/>
                    <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                {else:}
                    <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                {/if}            
            </div>
            <div class="compare"><a href="#">Сравнить</a></div>
        </li>
            {if $count == 3}<li class="separator"></li> {$count=0}{/if}
            {$count++}
    {/foreach}
    </ul>
    <!-- END HITS -->

    <div style="clear:both;"></div>

    <!-- BEGIN NEW -->
    <div id="titleExt">
        <h5 class="left">Новые</h5>
        <div class="sp"></div>
    </div>
    <br/>
    <ul class="products">
    {$count = 1}
    {foreach $newest as $p}
        <li class="{counter('', '', 'last')}">
            <div class="image" style="display:table-cell;vertical-align:middle;overflow:hidden;">
                <a href="{shop_url('product/' . $p->getUrl())}">
                    <img src="{productImageUrl($p->getId() . '_small.jpg')}" border="0"  alt="image" />
                </a>
            </div>
            <h3 class="name"><a href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a></h3>
            <div class="price">
                {$p->firstVariant}
                {if $p->hasDiscounts()}
                    <s>{echo $p->firstVariant->toCurrency('origPrice')} {$CS}</s>
                    <br/>
                    <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                {else:}
                    <span style="font-size:14px;">{echo $p->firstVariant->toCurrency()} {$CS}</span>
                {/if}            
            </div>
            <div class="compare"><a href="#">Сравнить</a></div>
        </li>
            {if $count == 3}<li class="separator"></li> {$count=0}{/if}
            {$count++}
    {/foreach}
    </ul>
    <!-- END NEW -->

</div>
