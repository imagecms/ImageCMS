<div class="title-default2">
    <div class="title">{echo $page['title']}</div>
</div>
<div class="title-default2">
    <div class="s-t">{$page.full_text}</div>
</div>
<div class="panel-form panel-add-services">
    <div class="inside-padd">
        {$CI->load->module('cfcm')->get_form($page['category'], $page['id'], 'page', 'additional_services_form')}
    </div>
</div>