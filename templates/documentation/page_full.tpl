<div class="frame-inside">
    <div class="container">
        <div class="frame-crumbs">
            {widget('path')}
        </div>
        <div class="clearfix">
            <div class="text left">
                <h1 class="titleEditTinyMCE">{$page.title}</h1>
                <hr />
                <div class="descriptionEditTinyMCE">
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
                <div class="for_comments"></div>
            </div>
        </div>
    </div>
</div>