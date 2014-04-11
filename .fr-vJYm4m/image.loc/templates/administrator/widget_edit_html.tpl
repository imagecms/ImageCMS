<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="title">{lang('Widget editing',"admin")}<b> {$widget.name}</b></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                {if $widget.id == 16 || $widget.id == 17}
                    <a href="/admin/widgets_manager" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return','admin')}</span></a>
                 {else:}
                    <a href="{$BASE_URL}admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Return','admin')}</span></a>
                 {/if}
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#wid_ed_form"><i class="icon-list-alt icon-white"></i>{lang('Save','admin')}</button>
                {if !$widget.id == 16 and $widget.id != 17}
                <button type="button" class="btn btn-small formSubmit" data-form="#wid_ed_form" data-action="tomain"><i class="icon-check"></i>{lang('Save and exit','admin')}</button>
                {/if}
                    {echo create_language_select($languages, $locale, "/admin/widgets_manager/edit_html_widget/".$widget.id)}
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action="{$BASE_URL}admin/widgets_manager/update_html_widget/{$widget.id}/{echo $locale}" class="form-horizontal" id="wid_ed_form">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Properties","admin")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group m-t_10">
                                                <label class="control-label" for="inputName">{lang("Name","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="name" id="inputName" value="{$widget.name}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputDesc">{lang("Description","admin")}:</label>
                                                <div class="controls">
                                                    <input type="text" name="desc" id="inputDesc" value="{$widget.description}">
                                                    <p class="help-block">{lang("Short widget description","admin")}</p>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputType">{lang('HTML code','admin')}:</label>
                                                <div class="controls">
                                                    <textarea class="elRTE" name="html_code" rows="15">{htmlspecialchars($widget.data)}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {include_tpl('modules_additions')}
                </form>
            </div>
        </div>
        <div class="tab-pane"></div>
    </div>
</section>