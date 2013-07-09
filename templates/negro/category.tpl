<div class="frame-inside">
    <div class="container">
        <div class="clearfix">
            <div class="text">
                <h1>{echo encode($category.name)}</h1>
                <ul class="help-cont">
                    {foreach $pages as $p}
                    <li>
                        <div class="hel-tit"><span class="arr-d-icon"></span>{$p.title}</div>
                        <div class="help-body">{$p.prev_text}</div>
                    </li>
                    {/foreach}
                </ul>  
            </div>
        </div>
    </div>
</div>