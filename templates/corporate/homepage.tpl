{widget('benefits')}
<div class="fon-noise">
    <div class="container">
        <div class="left">
            <div class="blog-news">
                {widget('blog')}
                <div class="btn btn-link-rss ">
                    <a href="{site_url('/rss')}"><span class="icon-rss"></span>Подписаться  на блог</a>
                </div>
            </div>
        </div>
        <div class="right">
            {widget('news')}
        </div>
    </div>        
</div>
<script type="text/javascript" src="{$THEME}js/jquery.cycle.js"></script>