{ /* }
<style>
    {literal}
        div.page_container{
            background-color: #f8f8f8;
            width: 92%;
            height: 80px;
            padding: 15px;
            padding-right: 50px;
        }
    {/literal}
</style>

<div class="page_container">
    <div>
        <h6>{echo $page['title']}</h6>
    </div>

    <div id="detail">
        {$page.full_text}
    </div>
</div>


{$CI->load->module('cfcm')->get_form($page['category'], $page['id'], 'page', 'additional_services_form')}

{ */ }

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