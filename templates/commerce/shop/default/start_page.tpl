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
 
    function mycarousel_itemLoadCallback(carousel, state)
    {
        // Check if the requested items already exist
        if (carousel.has(carousel.first, carousel.last)) {
            return;
        }

        jQuery.get(
            '/shop/ajax/getCarouselImages',
            {
                first: carousel.first,
                last: carousel.last
            },
            function(xml) {
                mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
            },
            'xml'
        );
    };

    function mycarousel_itemAddCallback(carousel, first, last, xml)
    {
        // Set the size of the carousel
        carousel.size(parseInt(jQuery('total', xml).text()));
        jQuery('product', xml).each(function(i) {
              var url = $("url", this).text();
              var image_url = $("image", this).text();
              carousel.add(first + i, mycarousel_getItemHTML(url, image_url));
        });
    };

    /**
     * Item html creation helper.
     */
    function mycarousel_getItemHTML(url, image_url)
    {
        return '<a class = "product_url" href="/shop/product/' + url +'"><img src="' + image_url + '" width="75" height="75" alt="" /></a>';
    };

    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            // Uncomment the following option if you want items
            // which are outside the visible range to be removed
            // from the DOM.
            // Useful for carousels with MANY items.

            // itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
            scroll:6,
            itemLoadCallback: mycarousel_itemLoadCallback
        });
    });

    </script>
{/literal}

{# Display sidebar.tpl #}
{include_tpl ('sidebar')}

<div class="products_list">
    {$banners = ShopBanersQuery::create()->orderByPosition()->find()}
    {if count($banners)}
    <!-- BEGIN SLIDESHOW -->
    <div id="slideshow">
            <ul id="slides" style="width: 693px; height: 260px;">
                {foreach $banners as $banner}
                    <li><a href="{echo $banner->getUrl()}"><img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="" height="256"></a><span class="slide_caption"> <a href="{echo $banner->getUrl()}" class="title">{echo ShopCore::encode($banner->getName())}</a> {echo ShopCore::encode($banner->getText())}</span></li>
                {/foreach}
            </ul>
            <div id="slideshow_violator" class="clearfix">
              <div id="project_caption"></div>
              <div id="slide_navigation" class="clearfix"></div>
            </div>
    </div>
    <!-- END SLIDESHOW -->
    {/if}
    <div align="center" style="padding-bottom: 38px;">
        <div id="mycarousel" class="jcarousel-skin-ie7">
            <ul>
              <!-- The content will be dynamically loaded in here -->
            </ul>
        </div>
    </div>
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
            <div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">Сравнить</a></div>
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
            <div class="compare"><a href="{shop_url('compare/add/' . $p->getId())}">Сравнить</a></div>
        </li>
            {if $count == 3}<li class="separator"></li> {$count=0}{/if}
            {$count++}
    {/foreach}
    </ul>
    <!-- END NEW -->

</div>
