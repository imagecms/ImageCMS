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
                    <a href="#logofav" class="btn btn-small">{lang('Logo & Favicon', 'template_manager')}</a>
                    <a href="#properties_template" class="btn btn-small active">{lang('Template properties', 'template_manager')}</a>
                    <a href="#list" class="btn btn-small">{lang('Templates list', 'template_manager')}</a>
                    <a href="#upload_template" class="btn btn-small">{lang('Upload template', 'template_manager')}</a>
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

                <div class="tab-pane" id="list">

                    <div class="inside_padd">
                        <h4>Список шаблонов</h4>
                        <form method="post">
                            {foreach $templates as $tpl}
                                <div class="row-fluid">
                                    <div class="span1">
                                        <input {if $currTpl == $tpl->name}checked="checked"{/if} type="radio" name="template_name" value="{echo $tpl->name}">
                                    </div>        
                                    <div class="span5">
                                        <img src="{echo $tpl->mainImage}" />
                                    </div>        
                                    <div class="span6">
                                        <p><b>Названия:</b> {echo $tpl->name}</p>
                                        <p><b>Тип:</b> {echo $tpl->type}</p>
                                        <p><b>Версия:</b> {echo $tpl->version}</p>
                                        <p><b>Описание:</b> {echo $tpl->description}</p>
                                    </div>
                                </div>
                                <hr />
                            {/foreach}

                            <button name="install_template" type="submit" class="pull-right btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Install', 'template_manager')}</button>
                                {form_csrf()}
                        </form>
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
                            <input type="file" name="template_file" id="template_file"/>
                        </div>
                        <br />
                        <input id="submit" type="submit" name="upload_template" class="btn btn-primary" value="{lang('Upload','template_manager')}" />
                    </form>
                </div>

                <div class="tab-pane" id="logofav">

                    <form method="POST" enctype="multipart/form-data">

                        <div class="control-group">
                            <label class="control-label" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_logo'">
                                {lang('Logo', 'admin')} 
                                <i class="icon-info-sign"></i>
                            </label>
                            <input type="file" id="siteinfo_logo" name="siteinfo_logo" data-url="file">
                            <input type="hidden" id="si_delete_logo" class="si_delete_image" name="si_delete_logo" value="0">

                            <div class="controls siteinfo_logoimage">
                                <div class='siteinfo_image_container'>
                                    {$logo = siteinfo('siteinfo_logo_url')}
                                    {if !empty($logo)}
                                        <button type="button" class="btn btn-small remove_btn">
                                            <i class="icon-trash"></i>
                                        </button>
                                        <img class="img-polaroid" src="{site_url($logo)}" alt="{lang('Click to select the image', 'admin')}" />
                                    {else:}
                                        <img class="img-polaroid" src="{$BASE_URL}templates/administrator/images/select-picture.png" alt="{lang('Click to select the image', 'admin')}" />
                                    {/if}
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" data-toggle="ttip" data-title="{$tooltipText} 'siteinfo_favicon'">Favicon 
                                <i class="icon-info-sign"></i>
                            </label>
                            <input type="file" id="siteinfo_favicon" name="siteinfo_favicon" data-url="file">
                            <input type="hidden" id="si_delete_favicon" class="si_delete_image" name="si_delete_favicon" value="0">

                            <div class="controls siteinfo_faviconimage">
                                <div class='siteinfo_image_container'>
                                    {$favicon = siteinfo('siteinfo_favicon_url')}
                                    {if !empty($favicon)}
                                        <button type="button" class="btn btn-small remove_btn">
                                            <i class="icon-trash"></i>
                                        </button>
                                        <img class="img-polaroid" src="{site_url($favicon)}" alt="{lang('Click to select the image', 'admin')}" />
                                    {else:}
                                        <img class="img-polaroid" src="{$BASE_URL}templates/administrator/images/select-picture.png" alt="{lang('Click to select the image', 'admin')}" />
                                    {/if}
                                </div>
                            </div>
                        </div>

                        <button name="set_logofav" type="submit" class="pull-right btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Save', 'template_manager')}</button>

                        {form_csrf()}
                    </form>

                </div>

            </div>
        </div>
    </section>
</div>



