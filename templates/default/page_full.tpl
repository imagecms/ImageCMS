{$Comments = $CI->load->module('comments')->init($page)}
<div id="titleExt">
    <h5>{widget('path')}<span class="ext">{$page.title}</span></h5>
</div>

<div id="detail">
    {$page.full_text}
</div>

<script type="text/javascript">
    {literal}
        $(function() {
            renderPosts($('#for_comments'));
        })
    {/literal}
</script>

<div id="comment">
    <div id="for_comments" name="for_comments"></div>
</div>
