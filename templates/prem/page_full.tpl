<div class="frame-inside page-text">
    <div class="container">
        <h1>{$page.title}</h1>
        {$CI->load->module('banners')->render($page.id)}
        <div class="text">
            {$page.full_text}

            {$Comments = $CI->load->module('comments')->init($page)}
            {$c=$CI->load->module('comments/commentsapi')->renderAsArray($CI->uri->uri_string())}
            <div class="forComments p_r">
                {echo $c['comments']}
            </div>
        </div>
    </div>
</div>