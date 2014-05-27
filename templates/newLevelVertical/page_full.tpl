<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-text">
    <div class="container">
        <div class="text">
            <h1>{$page.title}</h1>
            {$page.full_text}

            {$Comments = $CI->load->module('comments')->init($page)}
            {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
            <div class="forComments p_r">
                {echo $c['comments']}
            </div>
        </div>
    </div>
</div>