{$n = rand(0, (count($banners)-1));}
<div class="baner" style="height:250px;">
    <a href="{echo $banners[$n]['url']}" class="figure">
        <img src="{echo $banners[$n]['photo']}"/>
    </a>
</div>