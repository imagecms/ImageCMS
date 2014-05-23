<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="text left">
                <h1>{$page.title}</h1>
                <!-- Start. Show banner. -->
                {$CI->load->module('banners')->render()}
                <!-- End. Show banner. -->
                <div class="description">
                    {$page.full_text}
                </div>
                {$Comments = $CI->load->module('comments')->init($page)}

                <script type="text/javascript">
                    {literal}
                        $(function() {
                            renderPosts($('.for_comments'));
                        })
                    {/literal}
                </script>
                <div id="comment">
                    <div class="for_comments"></div>
                </div>
            </div>
            <div class="right">
                {widget('news')}
            </div>
        </div>
    </div>
</div>