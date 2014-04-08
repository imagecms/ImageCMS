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
                    <a href="#remote_templates" class="btn btn-small">{lang('Remote templates', 'template_manager')}</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="properties_template">

                    <div class="clearfix">
                        <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                            {$cnt = 1}
                            {foreach $template->components as $componentName}
                                {$component = $template->getComponent($componentName)}
                                {if !$component->notRenderAdminTemplate}
                                    <a href="#{echo $componentName}" class="btn btn-small {if $cnt == 1}active{/if}">{echo $component->getLabel()}</a>
                                {/if}
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
                                        <img src="{echo $tpl->mainImage}" style="max-width: 60%"/>
                                    </div>        
                                    <div class="span6">
                                        <p><b>Названия:</b> {echo $tpl->name}</p>
                                        <p><b>Тип:</b> {echo $tpl->type}</p>
                                        <p><b>Версия:</b> {echo $tpl->version}</p>
                                        <p><b>Описание:</b> {echo $tpl->description}</p>
                                    </div>
                                    <div>
                                        <a {if $currTpl != $tpl->name}href="{site_url('admin/components/init_window/template_manager/deleteTemplate')}/{echo $tpl->name}"{/if} name="delete_template" type="button" class="{if $currTpl == $tpl->name}disabled{else:}pjax{/if} pull-right btn btn-small btn-danger" style="margin-top: -115px;">
                                            <i class="icon-trash icon-white"></i>{lang('Delete', 'template_manager')}
                                        </a>
                                    </div>
                                </div>
                                <hr />
                            {/foreach}
                            <button name="install_template" type="submit" class="pull-right btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Install', 'template_manager')}</button>
                                {form_csrf()}
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="remote_templates">
                    <div class="inside_padd">
                        {if $remoteTemplates}
                            <h4>{echo $remoteTemplates['CategoryName']} ({count($remoteTemplates['Template'])})</h4>
                            <form method="post">
                                {foreach $remoteTemplates['Template'] as $remoteTemplate}
                                    <div class="row-fluid">
                                        <div class="span1">
                                            <input type="radio" name="template_name" value="{echo $remoteTemplate['Name']}">
                                        </div>        
                                        <div class="span5">
                                            {if isset($remoteTemplate['Images']['MainImage']) && $remoteTemplate['Images']['MainImage']}
                                                {$image = $remoteTemplate['Images']['MainImage'];}
                                            {else:}
                                                {$image = site_url('uploads/shop/nophoto/nophoto.jpg');}
                                            {/if}
                                            <div style="height: 300px; background-image: url('{echo $image}'); background-repeat: no-repeat;"></div>
                                            {if $remoteTemplate['Images']['AdditionalImages']['Image']}
                                                <div style="height: 115px; overflow-y: scroll; margin-top: 20px; border: 2px solid lightgray; border-radius: 5px;">
                                                    {if is_array($remoteTemplate['Images']['AdditionalImages']['Image'])}
                                                        {foreach $remoteTemplate['Images']['AdditionalImages']['Image'] as $image}
                                                            <img src="{echo $image}" style="max-height: 100px; margin: 5px"/>
                                                        {/foreach}
                                                    {else:}
                                                        <img src="{echo $remoteTemplate['Images']['AdditionalImages']['Image']}" style="max-height: 100px; margin: 5px"/>
                                                    {/if}
                                                </div>
                                            {/if}
                                        </div>        
                                        <div class="span6">
                                            {if $remoteTemplate['IsFree'] == 'Yes'}
                                                <a class="btn btn-small btn-success pull-right pjax" href="{site_url('admin/components/init_window/template_manager/getRemoteTemplate')}/{echo $remoteTemplate['Id']}">
                                                    <i class="icon-white icon-download-alt"></i>
                                                    {lang('Download', 'template_manager')}
                                                </a>
                                            {else:}
                                                <a class="btn btn-small btn-primary pull-right" href="{echo $remoteTemplate['Url']}" target="_blank">
                                                    <i class="icon-white icon-shopping-cart"></i>
                                                    {lang('Buy', 'template_manager')}
                                                </a>
                                            {/if}

                                            <p><b>Названия:</b> {echo $remoteTemplate['Name']}</p>
                                            <p><b>Тип:</b> {echo $remoteTemplate['Type']}</p>
                                            {if $remoteTemplate['Price']}
                                                <p><b>Цена:</b> {echo $remoteTemplate['Price']} {echo $remoteTemplate['CurrencySymbol']}</p>
                                            {/if}
                                            {if $remoteTemplate['Version']}
                                                <p><b>Версия:</b> {echo $remoteTemplate['Version']}</p>
                                            {/if}
                                            {if $remoteTemplate['SupportedVersions']}
                                                <p><b>Поддерживается с:</b> {echo $remoteTemplate['SupportedVersions']}</p>
                                            {/if}
                                            {if $remoteTemplate['Demo']}
                                                <p><b>Демо:</b> {echo $remoteTemplate['Demo']}</p>
                                            {/if}
                                            {if $remoteTemplate['Description']}
                                                <p><b>Описание:</b> {echo $remoteTemplate['Description']}</p>
                                            {/if}
                                        </div>
                                        <div>
                                            <!--a {if $currTpl != $tpl->name}href="{site_url('admin/components/init_window/template_manager/deleteTemplate')}/{echo $tpl->name}"{/if} name="delete_template" type="button" class="{if $currTpl == $tpl->name}disabled{else:}pjax{/if} pull-right btn btn-small btn-danger" style="margin-top: -115px;">
                                                <i class="icon-trash icon-white"></i>{lang('Delete', 'template_manager')}
                                            </a-->
                                        </div>
                                    </div>
                                    <hr />
                                {/foreach}
                                <button name="install_template" type="submit" class="pull-right btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Install', 'template_manager')}</button>
                                    {form_csrf()}
                            </form>
                        {else:}
                            <div class="alert alert-warning" style='margin:10px;'>
                                {lang('No templates', 'template_manager')}
                            </div>
                        {/if}
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



