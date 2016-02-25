<section class="mini-layout">
         <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Menu item translate", "menu")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/menu/menu_item/{$menu_name}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", "menu")}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#item_t_save_form"><i class="icon-ok icon-white"></i>{lang("Save", "menu")}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <form action="{$BASE_URL}admin/components/cp/menu/translate_item/{$id}" method="post" id="item_t_save_form" class="form-horizontal">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th>{lang("Settings", "menu")}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="inside_padd">
                                    <div class="row-fluid">
                                        {foreach $langs as $l}
                                            <div class="control-group">
                                                <label class="control-label" for="{$l.lang_name}">{$l.lang_name}:</label>
                                                <div class="controls">
                                                    <input type="text" name="lang_{$l.id}" value="{$l.curt}" id="{$l.lang_name}"/>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {form_csrf()}
            </form>
        </div>
    </div>
</section>