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
                    {$CI->load->module('documentation')}
                    {echo $CI->documentation->preTags($page.full_text)}
                </div>
            </div>
        </div>
    </div>
</div>