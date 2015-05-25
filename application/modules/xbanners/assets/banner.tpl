<div id="{echo $banner->getPlace()}" class="slick" style="text-align: center;">
    {foreach $banner->getBannerImages() as $image}
    <a {if $image->getTarget()}target="_blank"{/if} href="{echo $image->getStatisticUrl()}">
        <img src="{echo $image->getImageOriginPath()}" alt="{echo $image->getName()}"/>
    </a>
    {/foreach}
</div>

<script type="text/javascript">
    {literal}
        if (typeof createObjEffects === "undefined") {
            var createObjEffects = {};
        }
        createObjEffects.{/literal}{echo $banner->getPlace()}{literal} = {
            autoplaySpeed: {/literal}{$banner->getEffects()['autoplaySpeed']}{literal},
            arrows: {/literal}{$banner->getEffects()['arrows']}{literal},
            dots: {/literal}{$banner->getEffects()['dots']}{literal},
            autoplay: {/literal}{$banner->getEffects()['autoplay']}{literal}
        };
    {/literal}
</script>