<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Create Po-file', 'translator')}</span>
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
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#create_file_form">
                        <i class="icon-ok"></i>
                        {lang('Save', 'translator')}
                    </button>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-action="showEdit" data-form="#create_file_form">
                        <i class="icon-ok icon-white"></i>
                        {lang('Save and Go to Edit', 'translator')}
                    </button>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form method="post" action="{site_url('admin/components/init_window/translator/createFile')}" class="form-horizontal m-t_15" id="create_file_form">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <tr>
                        <th colspan="6">
                            {lang('Values', 'translator')}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Choose file location', 'translator')}
                                        :</label>

                                    <div class="controls poSelectorsHolder">
                                        <div class="d-i_b">
                                            <select id="langs" name="locale" onchange="Selectors.langs($(this))">
                                                {if $langs}
                                                    <option value="">-- {lang('Choose locale', 'translator')}--
                                                    </option>
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
                                                <option value="">-- {lang('Choose type', 'translator')} --</option>
                                                <option class="modules" value="modules">{lang('Modules', 'translator')}</option>
                                                <option class="templates" value="templates">{lang('Templates', 'translator')}</option>
                                                <option class="main" value="main">{lang('Main', 'translator')}</option>
                                            </select>
                                        </div>
                                        <div class="d-i_b">
                                            <select id="modules_templates" name="module_template" style="display: none">
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Project Name', 'translator')}
                                        :</label>

                                    <div class="controls">
                                        <input type="text" name="projectName">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Translator email', 'translator')}
                                        :</label>

                                    <div class="controls">
                                        <input type="text" name="translatorEmail">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Translator name', 'translator')}
                                        :</label>

                                    <div class="controls">
                                        <input type="text" name="translatorName">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Language-Team name', 'translator')}
                                        :</label>

                                    <div class="controls">
                                        <input type="text" name="langaugeTeamName">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Language-Team email', 'translator')}
                                        :</label>

                                    <div class="controls">
                                        <input type="text" name="langaugeTeamEmail">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Basepath', 'translator')}:</label>

                                    <div class="controls">
                                        <input type="text" name="basepath" required="">
                                         <span data-title="{lang('Paths usage', 'translator')}:" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>

                                        <div class="d_n">
                                            {lang('Paths define where to search phrases for translation. Folder location which contains files with this phrases.', 'translator')}
                                            <br/>
                                            <b>{lang('Basepath', 'translator')}</b>
                                            - {lang('Defines relatively to .po file location(folder), which contains translation phrases.', 'translator')}
                                            <br/>

                                            <b>{lang('Additional paths', 'translator')}</b>
                                            - {lang('Defines additional locations to search translation phrases. From location where points main path.', 'translator')}
                                            <br/>

                                            <b>{lang('All paths must be relative', 'translator')}</b>
                                            <br/>

                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Paths', 'translator')}:</label>

                                    <div class="controls">
                                        <div class="m-b_10">
                                            <input type="text" class="createPagePathsAddInput m-r_15" onkeypress="if (event.keyCode == 13)
                                            $(this).next().click()" style="width: 422px;">
                                            <button type="button" onclick="CreatePoFile.addPath($(this))" class="createPagePathsAddButton btn btn-small ">
                                                <i class="icon-plus"></i>
                                                {lang('Add path', 'translator')}
                                            </button>
                                        </div>
                                        <select name="paths[]" multiple="true" class="span7 createPagePaths notchosen" required="">
                                        </select>
                                        <span class="help-block">{lang('Double click to deleting', 'translator')}</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Language', 'translator')}:</label>

                                    <div class="controls">
                                        <input type="text" name="language">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="file">{lang('Country', 'translator')}:</label>

                                    <div class="controls">
                                        <input type="text" name="country">
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