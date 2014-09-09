<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Update files', 'translator')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/translator"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'translator')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <!--button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#create_file_form"-->
                    <button type="button" class="btn btn-small btn-success action_on" onclick="SAAS_UPDATES.update($(this))">
                        <i class="icon-ok"></i>
                        {lang('Update', 'translator')}
                    </button>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form method="post" action="{site_url('admin/components/init_window/translator/saas_updates')}" class="form-horizontal" id="create_file_form">
                <table class="table  table-bordered table-hover table-condensed t-l_a content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Update files', 'translator')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Update mode', 'translator')}:</label>
                                        <div class="controls">
                                            <select id="update_mode" name="mode">
                                                <option value="0">{lang('One file', 'translator')}</option>
                                                <option value="1">{lang('All files', 'translator')}</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="control-group all_file_mode" style="display: none">
                                        <label class="control-label" for="file">{lang('Choose files locale', 'translator')}:</label>
                                        <div class="controls poSelectorsHolder">
                                            <div class="d-i_b">
                                                <select id="langs" class="langs" name="locale">
                                                    {if $langs}
                                                        <option value="">-- {lang('Choose locale', 'translator')} --</option>
                                                        {foreach $langs as $locale}
                                                            <option class="{echo $locale}">{echo $locale}</option>
                                                        {/foreach}

                                                    {else:}
                                                        <option>{lang('No locales', 'translator')}</option>
                                                    {/if}
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="control-group one_file_mode">
                                        <label class="control-label" for="file">{lang('Choose file location', 'translator')}:</label>
                                        <div class="controls poSelectorsHolder">
                                            <div class="d-i_b">
                                                <select id="langs" class="langs_one_mode" name="locale" onchange="Selectors.langs($(this))">
                                                    {if $langs}
                                                        <option value="">-- {lang('Choose locale', 'translator')} --</option>
                                                        {foreach $langs as $locale}
                                                            <option class="{echo $locale}">{echo $locale}</option>
                                                        {/foreach}

                                                    {else:}
                                                        <option>{lang('No locales', 'translator')}</option>
                                                    {/if}
                                                </select>
                                            </div>
                                            <div class="d-i_b">
                                                <select id="types" name="type" style="display: none" onchange="Selectors.types($(this))">
                                                    <option  value="">-- {lang('Choose type', 'translator')} --</option>
                                                    <option class="modules" value="modules">{lang('Modules', 'translator')}</option>
                                                    <option class="main" value="main">{lang('Main', 'translator')}</option>
                                                </select>
                                            </div>
                                            <div class="d-i_b">
                                                <select id="modules_templates" name="module_template" style="display: none">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                                <div class="control-group all_file_mode_progress" style="display: none">
                                        <div class="controls">
                                            <div id="progressBlock" style="margin-top:15px; width: 600px;">
                                                <label id="progressLabel"></label>
                                                <div class="progress progress-striped active" style="margin-top:15px;">
                                                    <div class="bar" style="width: 1%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
</div>