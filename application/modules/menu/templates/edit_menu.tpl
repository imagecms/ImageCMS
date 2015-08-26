<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Edit a menu', "menu")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/menu" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", "menu")}</span></a>
                <!--<button type="submit" class="btn btn-small action_on saveButton"  idMenu="{$id}"><i class="icon-ok"></i>Сохранить</button>-->
                <button type="submit" class="btn btn-small btn-primary action_on formSubmit"  data-form="#saveForm" data-submit><i class="icon-ok"></i>{lang("Save", "menu")}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#saveForm" data-action="tomain"><i class="icon-check"></i>{lang('Save and exit', 'menu')}</button>
            </div>
        </div>                            
    </div>
    <form action="/admin/components/cp/menu/update_menu/{$id}" method="POST"  id="saveForm">
        <div class="tab-content">
            <div class="tab-pane active" id="modules">

                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Edit a menu", "menu")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">
                                        <div class="control-group m-t_10">
                                            <label class="control-label" for="inputParent">{lang("Name", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="menu_name" name1='ssss' value="{$name}" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputWayImg">{lang("Title", "menu")}: <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="main_title" value="{$main_title}" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputWayImg">{lang("Description", "menu")}:</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="menu_desc" value="{$description}" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputWayImg">{lang("Template folder", "menu")}:</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="menu_tpl" value="{$tpl}" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="inputWayImg">{lang("Open a menu, level", 'menu')}:</label>
                                            <div class="controls">
                                                <input type="text" class="textbox" name="menu_expand_level" value="{$expand_level}" />  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {form_csrf()}
    </form>
</section>