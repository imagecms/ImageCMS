<article class="container">
    <div>
        {widget('path')}
        <div class="clearfix frame_brand main">
            <ul class="items">
                {foreach $model as $m}
                    <li>
                        <a href="{shop_url('brand/'.$m[url])}">
                            <span class="photo">
                                <span class="helper"></span>
                                <img src="{site_url('uploads/shop/brands/'.$m[image])}"/>
                            </span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>                            
    </div>
</article>
