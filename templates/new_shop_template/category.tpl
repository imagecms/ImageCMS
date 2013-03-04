<div class="row">
    <div class="span3">
        {load_menu('left_menu')}
    </div>
    <div class="span6">
        <div class="text">
            <h1>{$category[name]}</h1>
            {foreach $pages as $p}
                <h2>
                    <a href="{site_url($p['full_url'])}">
                        {$p['title']}
                    </a>
                </h2>
                <p>{$p['prev_text']}</p>
            {/foreach}
        </div>
    </div>
</div>

