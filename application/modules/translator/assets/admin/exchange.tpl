<div class="container">
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Translation exchange', 'translator')}</span>
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
                    <button type="button" class="btn btn-small btn-success" onclick="Exchange.go($(this));">
                        <i class="icon-ok icon-white"></i>
                        {lang('Exchange', 'translator')}
                    </button>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form method="post" class="form-horizontal m-t_15">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('Exchange files', 'translator')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group poSelectorsHolder exchanger">
                                        <label class="control-label" for="file">{lang('Choose file exchanger location', 'translator')}:</label>
                                        <div class="controls">
                                            <div class="d-i_b">
                                                <select id="langs" name="locale" onchange="Selectors.langs($(this))">
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
                                        <label class="control-label" for="file">{lang('Choose file receiver location', 'translator')}:</label>
                                        <div class="controls poSelectorsHolder receiver">
                                            <div class="d-i_b">
                                                <select id="langs" name="locale" onchange="Selectors.langs($(this))">
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