<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>Все теги ({count($tags_cloud)})</p>
            </li>
            </ul>
        </div>
</div>
<div style="clear:both;"></div>

<div style="padding:5px;">
    <div class="tags">
    {foreach $tags_cloud as $tag}
        <a href="#" style="font-size:{$tag.font_size}px">{$tag.value}<sup style="font-size:12px;">{$tag.count}</sup></a>
    {/foreach}
    </div>
</div>
{literal}
    <style>
        .tags {
            padding:3px;
        }

        .tags a {
            text-decoration: none;
            padding:2px;
        }

        .tags a:hover {
            background-color:#B7B07B; 
            color:#fff;
        }
    </style>
{/literal}
