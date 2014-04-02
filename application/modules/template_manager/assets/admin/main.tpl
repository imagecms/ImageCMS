<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Online store template settings', 'template_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/modules_table"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'template_manager')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <a class="btn btn-small pjax" href="#">
                        <i class="icon-wrench"></i>
                        {lang('Settings', 'template_manager')}                
                    </a>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            {if !empty($error)}
                <div class="alert alert-error t_notice_on_load" style='margin:10px;'>
                    {$error}
                </div>
            {/if}
            {if !empty($message)}
                <div class="alert alert-success t_notice_on_load" style='margin:10px;'>
                    {$message}
                </div>
            {/if}

            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#properties_template" class="btn btn-small active">{lang('Template properties', 'template_manager')}</a>
                    <a href="/admin/components/init_window/template_manager/templates" class="btn btn-small">{lang('Templates list', 'template_manager')}</a>
                    <a href="#upload_template" class="btn btn-small">{lang('Upload template', 'template_manager')}</a>
                    <a href="#logofav" class="btn btn-small">{lang('Logo', 'template_manager')}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="properties_template">

                    <div class="clearfix">
                        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                            {$cnt = 1}
                            {foreach $template->components as $componentName}
                                {$components = $template->getComponent($componentName)}
                                <a href="#{echo $componentName}" class="btn btn-small {if $cnt == 1}active{/if}">{echo $componentName}</a>
                                {$cnt++}
                            {/foreach}
                        </div>
                    </div>

                    <div class="tab-content">
                        {$cnt = 1}
                        {foreach $template->components as $componentName}
                            {$component = $template->getComponent($componentName)}    
                            <div class="tab-pane {if $cnt == 1}active{/if}" id="{echo $componentName}">
                                {$component->renderAdmin()}
                            </div>
                            {$cnt++}
                        {/foreach}
                    </div>
                </div>

                <div class="tab-pane" id="upload_template">
                    <form method="POST" enctype="multipart/form-data" id="upload_template_form">
                        {form_csrf()}   
                        <div class="or_container">
                            {lang('Enter URL','template_manager')}
                            <input type="text" name="template_url" value="" placeholder="URL" />
                        </div>
                        <div style="margin-top: 10px;margin-bottom: 10px; font-weight: bold;">OR</div>
                        <div class="or_container">
                            {lang('Local file','template_manager')}
                            <input type="file" name="template_file" />
                        </div>
                        <br />
                        <input id="submit" type="submit" name="upload_template" class="btn btn-primary" value="{lang('Upload','template_manager')}" />
                    </form>
                </div>

                <div class="tab-pane" id="logofav">
                    Тута бде вибір лого та фавікону
                </div>

            </div>
        </div>
    </section>
</div>



