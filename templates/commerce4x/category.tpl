<div class="container">
    <div class="row">
        <div class="span3">
            {if  $CI->uri->uri_string() != ''}
                {load_menu('left_menu')}
            {/if}
        </div>
        <div class="span6">
            <article>
                <div class="text">
                    <h1>{$category[name]}</h1>
                    {foreach $pages as $p}
                        <h2>
                            <a href="{site_url($p.full_url)}">
                                {$p.title}
                            </a>
                        </h2>
                        {$p.prev_text}
                    {/foreach}
                </div>
                {$pagination}
            </article>
        </div>
    </div>
</div>

