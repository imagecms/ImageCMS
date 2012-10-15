<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_edit_user_mod')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$SELF_URL}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>                   
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="close"><i class="icon-ok"></i>{lang('amt_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#update" data-action="exit"><i class="icon-check"></i>Создать и выйти</button>
                </div>
            </div>                            
        </div>
        <div class="tab-pane">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('a_data_group_mod')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <form id="update" method="post" action="{$BASE_URL}admin/components/cp/user_manager/save/{$id}">

                                            <div class="control-group">
                                                <label class="control-label" for="username">{lang('amt_tname')}</label>
                                                <div class="controls">
                                                    <input type="text" name="alt_name" id="alt_name" value="{$alt_name}"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="email">{lang('amt_identif')}</label>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{$name}" id="name" />
                                                    <span class="help-block">{lang('amt_identif')}</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="role_id">{lang('amt_description')}</label>
                                                <div class="controls">
                                                    <textarea id="desc" name="desc" class="textearea">{$desc}</textarea>
                                                </div>
                                            </div>                                                                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </section>
</div>