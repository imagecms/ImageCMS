<div id="{echo $banner->getPlace()}" class="slick" style="text-align: center;">
    {foreach $banner->getBannerImages() as $image}
        <a {if $image->getTarget()}target="_blank"{/if} {if $image->getStatisticUrl()}href="{echo $image->getStatisticUrl()}"{/if}>
            <img src="{echo $image->getImageOriginPath()}" alt="{echo $image->getName()}"/>
        </a>
    {/foreach}
</div>

<script type="text/javascript">
    {literal}
    if (typeof createObjEffects === "undefined") {
        var createObjEffects = {};
    }

    {/literal}{$boolArray = [false => 'false', true => 'true'];}{literal}

    createObjEffects.{/literal}{echo $banner->getPlace()}{literal} = {
        autoplaySpeed: {/literal}{$banner->getEffects()['autoplaySpeed']}{literal},
        arrows: {/literal}{$boolArray[$banner->getEffects()['arrows']]}{literal},
        dots: {/literal}{$boolArray[$banner->getEffects()['dots']]}{literal},
        autoplay: {/literal}{$boolArray[$banner->getEffects()['autoplay']]}{literal}
    };
    {/literal}
</script>