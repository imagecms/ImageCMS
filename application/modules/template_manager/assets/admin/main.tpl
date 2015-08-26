{$logo = siteinfo('siteinfo_logo')}
{$favicon = siteinfo('siteinfo_favicon')}
{$tooltipText = lang('Please use function siteinfo() with the parameter', 'admin')}
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Templates manager', 'template_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    {/*}<a href="{$BASE_URL}admin/components/modules_table"
                           class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>{ */}
                </div>
            </div>
        </div>
        <div class="">
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
            <div class="btn-group myTab m-t_20 tabs" data-toggle="buttons-radio">
                <a href="#properties_template"
                   class="btn btn-small {if !$_GET['remote_templates']}active{/if}">{lang('Templates properties', 'template_manager')}</a>
                <a href="#list" class="btn btn-small">{lang('Template list', 'template_manager')}</a>
                {if !MAINSITE}
                    <a href="#upload_template" class="btn btn-small">{lang('Upload template', 'template_manager')}</a>
                    <a href="{site_url('/admin/components/cp/template_manager?remote_templates=show')}" class="btn btn-small nav-btn-last {if $_GET['remote_templates']}active{/if}">{lang('Repository templates', 'template_manager')}</a>
                {/if}
                <div class="input-append pull-right filter_container" style="width: 210px; display: none;">
                    <input type="text" id="templates_filter"
                           placeholder="{lang('Start typing name here...', 'template_manager')}">
                    {/*}
                    <a href="#" onclick="$('#templates_filter').val('').trigger('keyup')" class="add-on">
                        <i class="icon-remove"></i>
                    </a>
                    { */}
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane {if !$_GET['remote_templates']}active{/if}" id="properties_template">
                    <div class="row-fluid">
                        <div class="span3 m-t_10">
                            <p style="font-size: 15pt; color: #676767;">
                                <span style="color: #cacaca;">{lang('Template','template_manager')}
                                    :</span> {echo $currTpl}
                            </p>
                            <ul class="nav myTab nav-tabs nav-stacked">
                                {$components = $template->getComponents()}
                                <li class="active">
                                    <a href="#logofav">{lang('Logo & Favicon', 'template_manager')}</a>
                                </li>
                                {foreach $components as $componentName => $component}
                                    {if !$component->notRenderAdminTemplate}
                                        <li>
                                            <a href="#{echo $componentName}">{echo $component->getLabel()}</a>
                                        </li>
                                    {/if}
                                {/foreach}
                            </ul>
                            {$userGuideUrl = './templates/' . $currTpl . '/User_Guide.pdf'}
                            {if file_exists($userGuideUrl)}
                                {if $CI->config->item('language') != 'en_US'}
                                    <a href="{echo site_url($userGuideUrl)}"
                                       target="_blank">{lang('User Guide', 'template_manager')}</a>
                                    <br/>
                                    <br/>
                                {/if}
                            {/if}
                            {if $template->demodataArchiveExists}
                                <buttton type="button" class="btn btn-small btn-warning"
                                         onclick="$('#demodataArchivModal').modal('show');">
                                    {lang('Install full demodata', 'template_manager')}
                                </buttton>
                            {/if}
                        </div>
                        <div class="span9">
                            <div class="tab-content">
                                {foreach $template->getComponents() as $componentName => $component}
                                    <div class="tab-pane" id="{echo $componentName}">
                                        {$component->renderAdmin()}
                                    </div>
                                {/foreach}
                                <div class="tab-pane active" id="logofav">
                                    <form method="POST" enctype="multipart/form-data" id="set_logo_fav">
                                        <input type="hidden" name="action" value="setLogoFav">

                                        <div class="control-group">
                                            <label class="control-label">
                                                {lang('Logo', 'admin')}
                                                <i class="icon-info-sign" data-toggle="ttip"
                                                   data-title="{$tooltipText} 'siteinfo_logo'"></i>
                                            </label>
                                            <input type="file" id="siteinfo_logo" name="siteinfo_logo" data-url="file"
                                                   class="d_n">
                                            <input type="hidden" id="si_delete_logo" class="si_delete_image"
                                                   name="si_delete_logo" value="0">

                                            <div class="controls siteinfo_logoimage siteinfo_image_container f_l">
                                                {if !empty($logo)}
                                                    <img class="img-polaroid" src="{site_url($logo)}"
                                                         alt="{lang('Click to select the image', 'admin')}"/>
                                                {else:}
                                                    <img class="img-polaroid"
                                                         src="{$BASE_URL}templates/administrator/images/select-picture.png"
                                                         alt="{lang('Click to select the image', 'admin')}"/>
                                                {/if}
                                                {if !empty($logo)}
                                                    <button type="button" class="btn btn-small remove_btn">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                {/if}
                                            </div>

                                        </div>

                                        <div style="clear:both;"></div>
                                        <br/>

                                        <div class="control-group">
                                            <label class="control-label">Favicon
                                                <i class="icon-info-sign" data-toggle="ttip"
                                                   data-title="{$tooltipText} 'siteinfo_favicon'"></i>
                                            </label>
                                            <input type="file" id="siteinfo_favicon" name="siteinfo_favicon"
                                                   data-url="file" class="d_n">
                                            <input type="hidden" id="si_delete_favicon" class="si_delete_image"
                                                   name="si_delete_favicon" value="0">

                                            <div class="clearfix">
                                                <div class="controls siteinfo_faviconimage siteinfo_image_container f_l">
                                                    {$favicon = siteinfo('siteinfo_favicon_url')}
                                                    {if !empty($favicon)}
                                                        <img class="img-polaroid" src="{site_url($favicon)}"
                                                             alt="{lang('Click to select the image', 'admin')}"/>
                                                    {else:}
                                                        <img class="img-polaroid"
                                                             src="{$BASE_URL}templates/administrator/images/select-picture.png"
                                                             alt="{lang('Click to select the image', 'admin')}"/>
                                                    {/if}
                                                    {if !empty($favicon)}
                                                        <button type="button" class="btn btn-small remove_btn">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    {/if}
                                                </div>

                                            </div>
                                        </div>
                                        <br/>
                                        <button type="button" class="btn btn-small action_on formSubmit btn-primary"
                                                data-action="setLogoFav" data-form="#set_logo_fav"
                                                data-after="setTimeout(function(){literal}{{/literal}location.reload();{literal}}{/literal},2000);">
                                            <i class="icon-ok"></i>{lang('Save', 'template_manager')}
                                        </button>
                                        {form_csrf()}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane row-fluid" id="list">
                    <div class="span9">
                        <form method="post" id="templates_list_form" style="margin-bottom: 0;">
                            {form_csrf()}
                        </form>
                        <ul class="items items-template">
                            {foreach $templates as $key => $tpl}
                                <li class="download_{echo strtolower($tpl->name)} template_tile">
                                    <div>
                                        {if $tpl->mainImage}
                                            {$image = $tpl->mainImage}
                                        {else:}
                                            {$image = site_url('uploads/shop/nophoto/nophoto.jpg')}
                                        {/if}
                                        <a href="{echo $image}" rel="group{$key}" class="d_b frame-photo-template"
                                           style="background-image: url('{echo $image}');">
                                            <span class="overlay-in"><span class="icon-search icon-white"></span></span>
                                        </a>
                                        {if count($tpl->screenshots) > 0}
                                            <div class="d_n">
                                                {if is_array($tpl->screenshots)}
                                                    {foreach $tpl->screenshots as $scr}
                                                        <a href="{echo $scr}" rel="group{$key}"></a>
                                                    {/foreach}
                                                {/if}
                                            </div>
                                        {/if}
                                    </div>
                                    <div>{lang('Дизайн интернет-магазина', 'template_manager')} <span
                                                class="template_name">{if $tpl->label}{echo $tpl->label}{else:}{echo $tpl->name}{/if}</span>
                                    </div>
                                    <div class="text-price">
                                        {if $remoteTemplates['Template']['Price']}
                                            {lang('Платный', 'template_manager')}: {echo $remoteTemplates['Template']['Price']} {echo $remoteTemplates['Template']['CurrencySymbol']}
                                        {else:}
                                            {lang('Бесплатный', 'template_manager')}
                                        {/if}
                                    </div>
                                    <div>
                                        {if $currTpl == $tpl->name}
                                            <span class="label label-info2">{lang('Installed', 'template_manager')}</span>
                                        {else:}
                                            <button type="button"
                                                    class="btn btn-small btn-primary show_template_agreement"
                                                    data-template_name="{echo $tpl->name}">
                                                <i class="icon-ok"></i>&nbsp;{lang('Install', 'template_manager')}
                                            </button>
                                        {/if}
                                        {if $currTpl != $tpl->name}
                                            <button type="button" class="btn btn-small action_on formSubmit btn-danger"
                                                    data-adddata="{literal}{{/literal}'addData': '{echo $tpl->name}'{literal}}{/literal}"
                                                    data-action="delete" data-form="#templates_list_form"
                                                    onclick="setTimeout($(this).closest('.template_tile').hide(), 1000)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        {/if}
                                    </div>
                                    <div>
                                        <p class="description">
                                            <span class="title">{lang('Type', 'template_manager')}</span>
                                            <span class="text-el">{echo $tpl->type}</span>
                                            <br/>
                                            {if $tpl->version}
                                                <span class="title">{lang('Version', 'template_manager')}</span>
                                                <span class="text-el">{echo $tpl->version}</span>
                                            {/if}
                                        </p>
                                    </div>
                                </li>
                            {/foreach}
                            {if $templateToPay}

                                {foreach $templateToPay as $key => $tpl}
                                    {$tpl = json_decode($tpl)}
                                    <li class="template_tile">
                                        <div>
                                            {if $tpl->img}
                                                {$image = $tpl->img}
                                            {else:}
                                                {$image = site_url('uploads/shop/nophoto/nophoto.jpg')}
                                            {/if}
                                            <!--div class="frame-photo-template"  style="background-image: url('{echo $image}');"></div-->
                                            <a href="{echo $image}" rel="" class="d_b frame-photo-template"
                                               style="background-image: url('{echo $image}');">
                                                <span class="overlay-in"><span
                                                            class="icon-search icon-white"></span></span>
                                            </a>

                                        </div>
                                        <div>{lang('Дизайн интернет-магазина', 'template_manager')} <span
                                                    class="template_name">{echo $tpl->tpllabel}</span></div>
                                        <div class="text-price">
                                            {if $tpl->price}
                                                {lang('Платный', 'template_manager')}: {echo $tpl->price} {echo $tpl->curr}
                                            {else:}
                                                {lang('Бесплатный', 'template_manager')}
                                            {/if}
                                        </div>
                                        <div>
                                            {echo $tpl->form}
                                            <button type="button" onclick="$(this).prev('form').submit()"
                                                    class="btn btn-small btn-success">
                                                <i class="icon-ok"></i>&nbsp;{lang('Pay', 'template_manager')}
                                            </button>

                                            {/*}
                                            <div class="btn btn-small">
                                                <i class="icon-attach"></i>
                                            </div>
                                            { */}

                                            <a href="{echo $tpl->server}/saas/orders/deleteOrder/{echo $key}"
                                               class="btn btn-small action_on formSubmit btn-danger">
                                                <i class="icon-trash"></i>
                                            </a>

                                        </div>
                                        <div>
                                            <p class="description">
                                                <span class="title">{lang('Status', 'template_manager')}</span>
                                                <span class="text-el">{lang('No', 'template_manager')}</span>
                                                <br/>
                                                <span class="title">{lang('Number', 'template_manager')}</span>
                                                <span class="text-el">{echo $key}</span>
                                                <br/>
                                                <span class="title">{lang('Date', 'template_manager')}</span>
                                                <span class="text-el">{echo date("d-m-Y", $tpl->date)}</span>
                                                <br/>
                                                <span class="title">{lang('System Pay', 'template_manager')}</span>
                                                <span class="text-el">{echo $tpl->system_pay}</span>
                                            </p>
                                        </div>
                                    </li>
                                {/foreach}
                            {/if}
                        </ul>
                    </div>
                    {if MAINSITE}
                        <div class="span3" style="margin-left: 0;float: right;">
                            <a href="{echo $CI->load->module('mainsaas')->getThemesUrl()}" class="frame-add-new-templ">
                                <span class="helper"></span>
                    <span>
                        <span class="icon-plus-big"></span>
                        <span class="title">{lang('Add design', 'template_manager')}</span>
                    </span>
                            </a>
                        </div>
                    {/if}
                </div>

                <div class="tab-pane {if $_GET['remote_templates']}active{/if}" id="remote_templates">
                    {if !isset($remoteTemplates['Template']['Id'])}
                    {/*}
                        <h4>{echo $remoteTemplates['CategoryName']} ({count($remoteTemplates['Template'])})</h4>
                        { */}
                        <form method="post" id="templates_download_form">
                            <ul class="items items-template">
                                {foreach $remoteTemplates['Template'] as $key => $remoteTemplate}
                                    <li class='template_tile'>
                                        {if isset($remoteTemplate['Images']['MainImage']) && $remoteTemplate['Images']['MainImage']}
                                            {$image = $remoteTemplate['Images']['MainImage'];}
                                        {else:}
                                            {$image = site_url('uploads/shop/nophoto/nophoto.jpg');}
                                        {/if}
                                        <a href="{echo $image}" rel="group{$key}" class="d_b frame-photo-template"
                                           style="background-image: url('{echo $image}');">
                                            <span class="overlay-in"><span class="icon-search icon-white"></span></span>
                                        </a>
                                        {if $remoteTemplate['Images']['AdditionalImages']['Image']}
                                            <div class="d_n">
                                                {if is_array($remoteTemplate['Images']['AdditionalImages']['Image'])}
                                                    {foreach $remoteTemplate['Images']['AdditionalImages']['Image'] as $image}
                                                        <a href="{echo $image}" rel="group{$key}"></a>
                                                    {/foreach}
                                                {/if}
                                            </div>
                                        {/if}
                                        {if $remoteTemplate['Name']}
                                            <div>{lang('Дизайн интернет-магазина', 'template_manager')} <a
                                                        href="{echo $remoteTemplate['Url']}" target="_blank"
                                                        class='template_name'>{echo $remoteTemplate['Name']}</a></div>
                                        {/if}
                                        <div class="text-price">
                                            {if $remoteTemplate['Price']}
                                                {lang('Платный', 'template_manager')}: {echo $remoteTemplate['Price']} {echo $remoteTemplate['CurrencySymbol']}
                                            {else:}
                                                {lang('Бесплатный', 'template_manager')}
                                            {/if}
                                        </div>
                                        <div class="c_b">
                                            {if $remoteTemplate['IsFree'] == 'Yes'}
                                                <button type="button"
                                                        class="btn btn-small action_on formSubmit btn-success"
                                                        data-adddata="{literal}{{/literal}'addData': '{echo $remoteTemplate['Id']}'{literal}}{/literal}"
                                                        data-action="download" data-form="#templates_download_form">
                                                    <i class="icon-download-alt icon-white"></i>  {lang('Download', 'template_manager')}
                                                </button>
                                            {else:}
                                                <a class="btn btn-small btn-primary"
                                                   href="{echo $remoteTemplate['Url']}" target="_blank">
                                                    <i class="icon-white icon-shopping-cart"></i>
                                                    {lang('Buy', 'template_manager')}
                                                </a>
                                            {/if}
                                            {if $remoteTemplate['Demo']}
                                                <a class="btn btn-small" href="{echo $remoteTemplate['Demo']}"
                                                   target="_blank">
                                                    {lang('Demo online', 'template_manager')}&nbsp;<span
                                                            class="icon-share-alt"></span>
                                                </a>
                                            {/if}
                                        </div>

                                        <div>
                                            <p class="description">
                                                {if $remoteTemplate['Type']}
                                                    <span class="title">{lang('Type', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplate['Type']}</span>
                                                    <br/>
                                                {/if}
                                                {if $remoteTemplate['Version']}
                                                    <span class="title">{lang('Version', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplate['Version']}</span>
                                                    <br/>
                                                {/if}
                                                {if $remoteTemplate['SupportedVersions']}
                                                    <span class="title">{lang('Support from', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplate['SupportedVersions']}</span>
                                                {/if}
                                            </p>
                                        </div>
                                    </li>
                                {/foreach}
                            </ul>
                            {form_csrf()}
                        </form>
                    {else:}
                        {if $remoteTemplates['Template']}
                            <h4>{echo $remoteTemplates['CategoryName']} (1)</h4>
                            <form method="post">
                                <ul class="items items-template">
                                    <li>
                                        {if isset($remoteTemplates['Template']['Images']['MainImage']) && $remoteTemplates['Template']['Images']['MainImage']}
                                            {$image = $remoteTemplates['Template']['Images']['MainImage'];}
                                        {else:}
                                            {$image = site_url('uploads/shop/nophoto/nophoto.jpg');}
                                        {/if}
                                        <a href="{echo $image}" rel="group{$key}" class="d_b frame-photo-template"
                                           style="background-image: url('{echo $image}');">
                                            <span class="overlay-in"><span class="icon-search icon-white"></span></span>
                                        </a>
                                        {if $remoteTemplates['Template']['Images']['AdditionalImages']['Image']}
                                            <div class="d_n">
                                                {if is_array($remoteTemplates['Template']['Images']['AdditionalImages']['Image'])}
                                                    {foreach $remoteTemplates['Template']['Images']['AdditionalImages']['Image'] as $image}
                                                        <a href="{echo $image}" rel="group"></a>
                                                    {/foreach}
                                                {else:}
                                                    <a href="{echo $remoteTemplates['Template']['Images']['AdditionalImages']['Image']}"
                                                       rel="group">
                                                        <img src="{echo $remoteTemplates['Template']['Images']['AdditionalImages']['Image']}"/>
                                                    </a>
                                                {/if}
                                            </div>
                                        {/if}
                                        {if $remoteTemplates['Template']['Name']}
                                            <div>{lang('Дизайн интернет-магазина', 'template_manager')} {echo $remoteTemplates['Template']['Name']}</div>
                                        {/if}
                                        <div class="text-price">
                                            {if $remoteTemplates['Template']['Price']}
                                                {lang('Платный', 'template_manager')}: {echo $remoteTemplates['Template']['Price']} {echo $remoteTemplates['Template']['CurrencySymbol']}
                                            {else:}
                                                {lang('Бесплатный', 'template_manager')}
                                            {/if}
                                        </div>
                                        <div class="c_b">
                                            {if $remoteTemplates['Template']['IsFree'] == 'Yes'}
                                                <button type="button"
                                                        class="btn btn-small action_on formSubmit btn-success"
                                                        data-adddata="{literal}{{/literal}'addData': '{echo $remoteTemplates['Template']['Id']}'{literal}}{/literal}"
                                                        data-action="download" data-form="#templates_download_form">
                                                    <i class="icon-download-alt"></i>  {lang('Download', 'template_manager')}
                                                </button>
                                            {else:}
                                                <a class="btn btn-small btn-primary"
                                                   href="{echo $remoteTemplates['Template']['Url']}" target="_blank">
                                                    <i class="icon-white icon-shopping-cart"></i>
                                                    {lang('Buy', 'template_manager')}
                                                </a>
                                            {/if}
                                            {if $remoteTemplates['Template']['Demo']}
                                                <a class="btn btn-small"
                                                   href="{echo $remoteTemplates['Template']['Demo']}" target="_blank">
                                                    {lang('Demo online', 'template_manager')}&nbsp;<span
                                                            class="icon-share-alt"></span>
                                                </a>
                                            {/if}
                                        </div>
                                        <div>
                                            <p class="description">
                                                {if $remoteTemplates['Template']['Type']}
                                                    <span class="title">{lang('Type', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplates['Template']['Type']}</span>
                                                    <br/>
                                                {/if}
                                                {if $remoteTemplates['Template']['Version']}
                                                    <span class="title">{lang('Version', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplates['Template']['Version']}</span>
                                                    <br/>
                                                {/if}
                                                {if $remoteTemplates['Template']['SupportedVersions']}
                                                    <span class="title">{lang('Support from', 'template_manager')}</span>
                                                    <span class="text-el">{echo $remoteTemplates['Template']['SupportedVersions']}</span>
                                                    <br/>
                                                {/if}
                                                {if $remoteTemplates['Template']['Description']}
                                                    <span class="title">{lang('Description', 'template_manager')}</span>
                                                    <span class="text-el">{echo str_replace('href','target="_blank" href',$remoteTemplates['Template']['Description'])}</span>
                                                {/if}
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                {form_csrf()}
                            </form>
                        {else:}
                            <div class="alert alert-warning" style='margin:10px;'>
                                {lang('No templates', 'template_manager')}
                            </div>
                        {/if}
                    {/if}
                </div>

                <div class="tab-pane" id="upload_template">
                    <form method="POST" enctype="multipart/form-data" id="upload_template_form1" class="vertical-form">
                        <div class="control-group">
                            <label class="control-label"
                                   for="template_url">{lang('Enter URL','template_manager')}</label>

                            <div class="controls">
                                <input type="text" name="template_url" id="template_url" value="" placeholder="URL"
                                       class="input-xxlarge" style="margin-bottom: 0;"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-small action_on formSubmit btn-primary"
                                data-action="upload" data-form="#upload_template_form1">
                            <i class="icon-download-alt icon-white"></i>{lang('Upload', 'template_manager')}
                        </button>
                        {form_csrf()}
                    </form>
                    <form method="POST" enctype="multipart/form-data" id="upload_template_form2" class="vertical-form">
                        <div class="control-group">
                            <label class="control-label"
                                   for="template_url">{lang('Local file','template_manager')}</label>

                            <div class="controls">
                                <input type="text" class="input-xlarge" style="margin-bottom: 0;" disabled="disabled">
                        <span class="btn btn-small p_r">
                            <i class="icon-folder-open"></i>
                            <span class="v-a_m">{lang('Choose file', 'template_manager')}</span>
                            <input type="file" name="template_file" id="template_file" accept=".zip">
                        </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-small action_on formSubmit btn-primary"
                                data-action="upload" data-form="#upload_template_form2">
                            <i class="icon-download-alt icon-white"></i>{lang('Upload', 'template_manager')}
                        </button>
                        {form_csrf()}
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- License agreement modal -->
<div class="modal hide fade" id="license_agreement_modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('License agreement', 'template_manager')}</h3>
    </div>
    <div id="license_agreement_text" class="modal-body" style="height: 400px; overflow-y: auto;">

    </div>
    <div class="modal-footer">
        <div class="pull-left" style="width: 200px; text-align: left;">
            <label for="accept_license_agreement">
                <input type="checkbox" id="accept_license_agreement" name="accept_license_agreement">
                {lang('Accept license agreement', 'template_manager')}
            </label>
        </div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            {lang('Cancel', 'template_manager')}
        </button>
        <button data-dismiss="modal" type="button" class="btn btn-small btn-primary accept_license_install_template"
                data-install_demodata="0">
            {lang('Install', 'template_manager')}
        </button>
        <!--button data-dismiss="modal" type="button" class="btn btn-small btn-warning accept_license_install_template" data-install_demodata="1" data-toggle="ttip" data-title="{lang('Be careful, installing demo data can damage your data.', 'template_manager')}" data-original-title="">
        {lang('Install with demodata', 'template_manager')}
    </button-->
    </div>
</div>
<!-- End of License agreement modal -->
<div class="modal hide fade" id="demodataArchivModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Full demo data install', 'template_manager')}</h3>
    </div>
    <div class="modal-body">
        <h5>{lang('Installing full demo data can destroy all your database and uploads data.', 'template_manager')}</h5>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">
            {lang('Cancel', 'template_manager')}
        </button>
        <buttton data-dismiss="modal" type="button" class="btn btn-small btn-primary btn-warning demodataArchiveButton"
                 data-template_name="{echo $currTpl}" data-toggle="ttip">
            {lang('Install full demodata', 'template_manager')}
        </buttton>
    </div>
</div>