<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Role edit","admin")}: {echo $model->name}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/roleEdit/{echo $idRole}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back","admin")}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#role_ed_form" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang("Save","admin")}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#role_ed_form" data-action="exit"><i class="icon-check"></i>{lang("Save and exit","admin")}</button>

                <div class="dropdown d-i_b">   
                    {$arr = get_lang_admin_folders()}
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                {if $lang_sel == 'en'}{lang("English","admin")}{else:}{lang("Russian","admin")}{/if}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{$BASE_URL}admin/rbac/translateRole/{echo $idRole}/{if $lang_sel == 'en'}ru{else:}en{/if}">                                    
                {if $lang_sel == 'en'} {lang("Russian","admin")} {else:} {lang("English","admin")} (beta){/if}
            </a>
        </li> 
    </ul>

</div>
</div>
</div>
</div>

<div class="tab-content clearfix">
    <form method="post" action="{$ADMIN_URL}{echo $lang_sel}" class="form-horizontal" id="role_ed_form">
        <div class="tab-pane active">
            <div class="tab-pane ">    

                <table class="table  table-bordered table-hover table-condensed content_big_td">
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
                                            <label class="control-label" for="alt_name">{lang("Description","admin")}:</label>
                                            <div class="controls">
                                                <input type="text" name="alt_name" id="alt_name" value="{echo $model->alt_name}" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Description">{lang('Full description','admin')}:</label>
                                            <div class="controls">
                                                <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
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
</div>
</section>