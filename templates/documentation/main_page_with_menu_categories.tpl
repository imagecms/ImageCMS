<div class="frame-inside">
    <div class="">
        <div class="crumbs-custome">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="text left container">
                <h1 class="">{$page.title}</h1>
                <div class="">
                    {echo $CI->load->module('documentation')->preTags($page.full_text)}
                </div>
            </div>
            {$Comments = $CI->load->module('comments')->init($page)}
            <script type="text/javascript">
                {literal}
                    $(function() {
                        renderPosts($('.for_comments'));
                    });
                {/literal}
            </script>
            <div id="comment">
                <div class="for_comments" id="comment-documentation"></div>
            </div>
        </div>
    </div>
</div>