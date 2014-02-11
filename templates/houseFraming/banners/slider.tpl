<div class="slider">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            {foreach $banners as $banner}
            <img src="{echo $banner['photo']}" data-thumb="{echo $banner['photo']}" alt="" />
            {/foreach}
        </div>
    </div>
</div>