<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Settings', 'new_level')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/init_window/new_level/"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'new_level')}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="content_big_td row-fluid">
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#properties" class="btn btn-small active">{lang('Properties settings', 'new_level')}</a>
                <a href="#columns" class="btn btn-small">{lang('Columns settings', 'new_level')}</a>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="properties">
                <div class="inside_padd">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('Properties types', 'new_level')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="control-group">
                                            <label class="control-label" for="settings[propertiesTypes]"></label>
                                            <div class="controls">
                                                <table class="propertyTypes table table-striped table-bordered table-hover table-condensed">
                                                    {foreach $settings['propertiesTypes'] as $type}
                                                        <tr>
                                                            <td>
                                                                <div class="p_r o_h frame_price ">
                                                                    <div class="propertyType">{$type}</div>
                                                                    <input type="text" name="typeEdit" class="typeEdit" style="display: none"/>
                                                                    <button data-update="count" onclick="PropertiesTypes.edit($(this), '{$type}')" class="btn btn-small" type="button" style="display: none;">
                                                                        <i class="icon-refresh"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td class="span1">
                                                                <button class="btn my_btn_s btn-small btn-danger" type="button" onclick="PropertiesTypes.delete('{$type}', $(this))">
                                                                    <i class="icon-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td class="span1">
                                                                <button class="btn my_btn_s btn-small btn-success" type="button">
                                                                    <i class="icon-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                    <tr class="addTypeContainer" style="display: none">
                                                        <td style="width: 950px;" colspan="3">
                                                            <div class="p_r o_h frame_price">
                                                                <input type="text" name="typeAdd" class="typeAdd" style="display: block"/>
                                                                <button data-update="count" onclick="PropertiesTypes.add($(this))" class="btn btn-small" type="button" style="display: inline-block;">
                                                                    <i class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a href="#properties" class="btn btn-small btn-success addType">
                                                    <i class="icon-plus icon-white"></i>&nbsp;{lang('Add new properties type', 'new_level')}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {form_csrf()}
                </div>
            </div>
            <div class="tab-pane" id="columns">
                <div class="inside_padd">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang('Columns', 'new_level')}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="control-group">
                                            <label class="control-label" for="settings[propertiesTypes]"></label>
                                            <div class="controls">
                                                <table class="columns table table-striped table-bordered table-hover table-condensed">
                                                    {foreach $settings['columns'] as $column}
                                                        <tr>
                                                            <td>
                                                                <div class="p_r o_h frame_price ">
                                                                    <div class="columns">{$column}</div>
                                                                    <input type="text" name="columnEdit" class="columnEdit" style="display: none"/>
                                                                    <button data-update="count" onclick="Columns.edit($(this), '{$column}')" class="btn btn-small" type="button" style="display: none;">
                                                                        <i class="icon-refresh"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td class="span1">
                                                                <button class="btn my_btn_s btn-small btn-danger" type="button" onclick="Columns.delete('{$column}', $(this))">
                                                                    <i class="icon-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td class="span1">
                                                                <button class="btn my_btn_s btn-small btn-success" type="button">
                                                                    <i class="icon-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                    <tr class="addColumnContainer" style="display: none">
                                                        <td colspan="3" style="width: 950px;">
                                                            <div class="p_r o_h frame_price">
                                                                <input type="text" name="columnAdd" class="columnAdd" style="display: block"/>
                                                                <button data-update="count" onclick="Columns.add($(this))" class="btn btn-small" type="button" style="display: inline-block;">
                                                                    <i class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a href="#columns" class="btn btn-small btn-success addColumn">
                                                    <i class="icon-plus icon-white"></i>&nbsp;{lang('Add new column', 'new_level')}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {form_csrf()}
                </div>
            </div>
        </div>
    </div>
</section>