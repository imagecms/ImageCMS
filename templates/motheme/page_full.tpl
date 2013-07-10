{$Comments = $CI->load->module('comments')->init()}
{widget('path')}
<h2>{$page.title}</h2>

<div id="detail">
    {$page.full_text}
</div>

<script type="text/javascript">
    {literal}
        $(function() {
            renderPosts(this);
        })
    {/literal}
</script>

<div id="comment">
    <div id="for_comments" name="for_comments"></div>
</div>
