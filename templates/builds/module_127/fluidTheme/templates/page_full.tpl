<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-text">
    <div class="container">
        <div class="text-left">
            <div class="btn-additional-s_c2 mq-w-480 mq-min mq-block m-b_20">
                <button type="button">
                    <span class="text-el" data-hide='<span class="d_l">{lang('Скрыть меню','newLevel')}</span> <span class="icon-show-part up"></span>' data-show='<span class="d_l">{lang('Показать меню','newLevel')}</span> <span class="icon-show-part"></span>'></span>
                </button>
            </div>
            <div class="info-menu-page-height">
                {load_menu('left_menu')}
            </div>
        </div>
        <div class="text-right">
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
</div>