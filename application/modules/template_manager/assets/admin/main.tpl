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
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#properties_template" class="btn btn-small active">{lang('Template properties', 'template_manager')}</a>
                    <a href="#" class="btn btn-small">{lang('Templates list', 'template_manager')}</a>
                    <a href="#upload_template" class="btn btn-small">{lang('Upload template', 'ntemplate_manager')}</a>
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
                        <table>
                            <tr>
                                <td>Enter URL</td>
                                <td><input type="text" name="template_url" value="http://localhost/newLevelCart.zip" /></td>
                            </tr>
                            <tr>
                                <td colspan='2' style="text-align: center; color: #622">OR</td>
                            </tr>
                            <tr>
                                <td>Select file</td>
                                <td><input type="file" name="template_file" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input id="submit" type="submit" name="submit" value="Upload" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>



