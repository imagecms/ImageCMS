<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('a_role_group_edit')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/rbac/groupEdit/{echo $id}" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#group_ed_form" data-action="tomain" data-submit><i class="icon-ok"></i>{lang('a_save')}</button>                
                <button type="button" class="btn btn-small formSubmit" data-form="#group_ed_form" data-action="toedit"><i class="icon-check"></i>Сохранить и выйти</button>

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                {if $lang_sel == 'en'}{lang('a_english')}{else:}{lang('a_russian')}{/if}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{$BASE_URL}admin/rbac/translateGroup/{echo $id}/{if $lang_sel == 'en'}ru{else:}en{/if}">                                   
                {if $lang_sel == 'en'} {lang('a_russian')} {else:} {lang('a_english')} (beta){/if}
            </a>
        </li> 
    </ul>

</div>
</div>
</div>

</div>  
<form method="post" action="{$ADMIN_URL}{echo $lang_sel}" class="form-horizontal" id="group_ed_form">
    <div class="tab-content">
        <div class="tab-pane active" id="params">
            <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('a_param')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd span9">
                                <div class="control-group">
                                    <label class="control-label" for="Description">{lang('a_desc')}:</label>
                                    <div class="controls">
                                        <input type="text" name="Description" id="Description" value="{echo $model->description}"/>
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