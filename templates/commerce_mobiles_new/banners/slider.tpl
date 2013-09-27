{$n = rand(0, (count($banners)-1));}
<div class="baner" >
    <a href="{echo $banners[$n]['url']}" class="figure">
        <img style="max-height:250px;" src="{echo $banners[$n]['photo']}"/>
    </a>
</div>