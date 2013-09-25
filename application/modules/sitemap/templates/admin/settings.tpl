<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Sitemap settings", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#sitemap_settings_form" data-submit><i class="icon-ok"></i>{lang("Save", 'sitemap')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <form action="/admin/components/cp/sitemap/update_settings" id="sitemap_settings_form" method="post" class="form-horizontal">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                <th>{lang("Priorities", 'sitemap')}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label" for="comcount">{lang("Main page", 'sitemap')}:</label>
                                    <div class="controls">
                                        <input type="text" id="comcount" name="main_page_priority" value="{$settings.main_page_priority}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="symcount">{lang("Categories", 'sitemap')}:</label>
                                    <div class="controls">
                                        <input type="text" id="symcount" name="cats_priority" value="{$settings.cats_priority}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang("Regular or usual pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        <input type="text" id="sppri" name="pages_priority" value="{$settings.pages_priority}" />
                                    </div>
                                </div>    
                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Send XML', 'sitemap')}:</label>
                                    <div class="controls">
                                        <input type="checkbox" id="sendXML" name="sendXML" value="true"/>
                                    </div>
                                </div>    
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                <th>{lang("Page change frequency", 'sitemap')}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label">{lang("Main page", 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('main_page_changefreq', $changefreq_options, $settings.main_page_changefreq)}
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">{lang("Other pages", 'sitemap')}:</label>
                                    <div class="controls">
                                         {form_dropdown('categories_changefreq', $changefreq_options, $settings.categories_changefreq)}
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang("Regular or usual pages", 'sitemap')}:</label>
                                    <div class="controls">
                                         {form_dropdown('pages_changefreq', $changefreq_options, $settings.pages_changefreq)}
                                    </div>
                                </div>    
                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Products page', 'sitemap')}:</label>
                                    <div class="controls">
                                         {form_dropdown('product_changefreq', $changefreq_options, $settings.pages_changefreq)}
                                    </div>
                                </div>    
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
    `           <thead>
                    <th>{lang('XML Site Map', 'sitemap')}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="inside_padd">  
                                <div class="control-group">
                                    <a href="{site_url('sitemap.xml')}" target="_blank">{lang('Shop site map', 'sitemap')}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            {form_csrf()}
        </form>
    </div>
</section>