<div class="frame-inside">
    <div class="container">
        <h1>{$album.name}</h1>
        <div class="frame-gallery">
            <ul class="items items-photo-galery">
                {foreach $album.images as $image}
                    <li>
                        <a href="{site_url($album_url . $image.full_name)}" title="{$image.description}" class="photo-block" rel="group">
                            <img src="{site_url($thumb_url . $image.full_name)}" alt="{$image.description}" />
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
        { /* }
        <div class="comments w_50">
            {$comments}
        </div>
        { */ }
    </div>
</div>
<link rel="stylesheet" type="text/css" href="{$THEME}css/fancybox.css" media="all" />
<script type="text/javascript" src="{$THEME}js/jquery.fancybox-1.3.4.pack.js"></script>
{literal}
    <script type="text/javascript">

        $(function() {
            $('[rel="group"]').fancybox({
                'margin': 0,
                'padding': 0,
                'transitionIn': 'none',
                'transitionOut': 'none',
                'titlePosition': 'over',
                'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                    return '<div id="fancybox-title-over">' + (title && title.length ? title : '') + '{/literal}{lang('Картинка','corporate')}{literal} ' + (currentIndex + 1) + ' из ' + currentArray.length + '</div>';
                }
            });
        })
    </script>
{/literal}