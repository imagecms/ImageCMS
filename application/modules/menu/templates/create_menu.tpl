<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Creating menu", "menu")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/cp/menu" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", "menu")}</span></a>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#createForm" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create", "menu")}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#createForm" data-action="tomain"><i class="icon-ok"></i>{lang("Create and exit", "menu")}</button>
                </div>
            </div>                            
        </div>
        <form action="{$BASE_URL}admin/components/cp/menu/create_menu" id="createForm" method="post" class="m-t_10">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang("Settings", "menu")}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label" for="menu_name">{lang("Name", "menu")}: <span class="must">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="textbox" name="menu_name" id="menu_name" required/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="main_title">{lang("Title", "menu")}: <span class="must">*</span></label>
                                        <div class="controls">
                                            <input type="text" class="textbox" name="main_title" id="main_title" required/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="menu_desc">{lang("Description", "menu")}:</label>
                                        <div class="controls">
                                            <input type="text" class="textbox" name="menu_desc" id="menu_desc"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="menu_tpl">{lang("Template folder", "menu")}:</label>
                                        <div class="controls">
                                            <input type="text" class="textbox" name="menu_tpl" id="menu_tpl" value="{$tpl}" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="menu_expand_level">{lang("Open a menu, level", 'menu')}:</label>
                                        <div class="controls number">
                                            <input type="text" class="textbox" name="menu_expand_level" id="menu_expand_level" value="{$expand_level}" />   
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
    </section>
</div>