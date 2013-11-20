<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Create Po-file')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/translator"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back')}</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#create_file_form">
                        <i class="icon-ok"></i>
                        {lang('Save')}
                    </button>
                </div>
            </div>
        </div>
        <div class="content_big_td row-fluid">
            <form method="post" action="{site_url('admin/components/init_window/translator/createFile')}" class="form-horizontal" id="create_file_form">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Values')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Choose file location')}:</label>
                                        <div class="controls">
                                            <div class="d-i_b">
                                                <select id="langs" name="locale" onchange="Selectors.langs($(this))">
                                                    {if $langs}
                                                        <option value="">-- {lang('Choose locale')} --</option>
                                                        {foreach $langs as $locale => $lang}
                                                            <option class="{echo $locale}">{echo $locale}</option>
                                                        {/foreach}
                                                    {else:}
                                                        <option>{lang('No locales')}</option>
                                                    {/if}
                                                </select>
                                            </div>
                                            <div class="d-i_b">
                                                <select id="types" name="type" style="display: none" onchange="Selectors.types($(this))">
                                                    <option  value="">-- {lang('Choose type')} --</option>
                                                    <option class="modules" value="modules">{lang('Modules')}</option>
                                                    <option class="templates" value="templates">{lang('Templates')}</option>
                                                    <option class="main" value="main">{lang('Main')}</option>
                                                </select>
                                            </div>
                                            <div class="d-i_b">
                                                <select id="modules_templates" name="module_template" style="display: none">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Project Name')}:</label>
                                        <div class="controls">
                                            <input type="text" name="projectName">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Translator email')}:</label>
                                        <div class="controls">
                                            <input type="text" name="translatorEmail">
                                        </div>
                                    </div>
                                        
                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Translator name')}:</label>
                                        <div class="controls">
                                            <input type="text" name="translatorName">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Language-Team name')}:</label>
                                        <div class="controls">
                                            <input type="text" name="langaugeTeamName">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Language-Team email')}:</label>
                                        <div class="controls">
                                            <input type="text" name="langaugeTeamEmail">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Basepath')}:</label>
                                        <div class="controls">
                                            <input type="text" name="basepath" required="">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Paths')}:</label>
                                        <div class="controls">
                                            <button type="button" onclick="CreatePoFile.addPath($(this))" class="btn btn-small btn-success" style="float: left">
                                                <i class="icon-plus"></i>
                                                {lang('Add path')}
                                            </button>
                                            <input type="text" onkeypress="if (event.keyCode == 13) $(this).prev().click()" style="width: 422px; margin-left: 10px; margin-bottom: 10px">
                                            <select name="paths[]" multiple="true" class="span7" required="">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Language')}:</label>
                                        <div class="controls">
                                            <input type="text" name="language">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="file">{lang('Country')}:</label>
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