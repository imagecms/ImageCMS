<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('amt_create_menu')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#createForm"><i class="icon-ok"></i>Сохранить</button>                 
                    <div class="dropdown d-i_b">
                        <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                            Русский
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Английский</a></li>
                        </ul>
                    </div>
                </div>
            </div>                            
        </div>
        <form action="{$BASE_URL}admin/components/cp/menu/create_menu" id="createForm" method="post">
            <div class="content_big_td">

                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                Основное
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">

                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="inputTemplateCategory">{lang('amt_name')}:</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="menu_name" />

                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputUrl">{lang('amt_tname')}</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="main_title" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputSortdefault">{lang('amt_description')}:</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="menu_desc" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputSortdefault">{lang('amt_template_folder')}:</label>
                                                <div class="controls">
                                                    <input type="text" class="textbox" name="menu_tpl" value="{$tpl}" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="inputSortdefault">{lang('amt_open_menu_folder')}:</label>
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
    </section>
</div>
{form_csrf()} 
</form>