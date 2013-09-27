{$n = rand(0, (count($banners)-1));}
<div class="baner">
    <a href="{echo $banners[$n]['url']}" class="figure">
        <img src="{echo $banners[$n]['photo']}"  style="max-height:250px;"/>
    </a>
</div>
