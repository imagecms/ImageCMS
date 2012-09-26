<div class="container">
    <ul class="breadcrumb">
        <li><a href="#">Главная</a> <span class="divider">/</span></li>
        <li class="active">Список товаров</li>
    </ul>

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Редактирование языка</span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>

                    <button type="submit"   class="btn btn-small action_on formSubmit" data-form="#editLang" data-action="edit"><i class="icon-ok"></i>{lang('a_create')}</button>
                    <button type="submit"   class="btn btn-small action_on formSubmit" data-form="#editLang" data-action="close"><i class="icon-ok"></i>Создать и выйти</button>
                    
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
        <div class="content_big_td">
            <div class="clearfix">

                <div class="pull-right m-t_20">
                    <a href="#">Просмотр страницы <span class="f-s_14">→</span></a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    Настройки
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <form action="{$BASE_URL}admin/languages/update/{$id}" method="post" id="editLang">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputName">{lang('a_name')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="" value="{$lang_name}" />
                                                        </div>
                                                    </div>    
                                                    <div class="row-fluid">
                                                        <div class="control-group">
                                                            <label class="control-label" for="inputName">{lang('a_identif')}:</label>
                                                            <div class="controls">
                                                                <input type="text" name="identif" id="" value="{$identif}"  />
                                                            </div>
                                                        </div> 

                                                        <div class="row-fluid">
                                                            <div class="control-group">
                                                                <label class="control-label" for="inputName">{lang('a_image_url')}:</label>
                                                                <div class="controls">
                                                                    <input type="text" name="image" id="" value="{$image}"/>
                                                                </div>
                                                            </div>   
                                                            <div class="control-group">
                                                                <label class="control-label" for="inputParent">{lang('a_folder')}:</label>
                                                                <div class="controls">
                                                                    <select name="folder">
                                                                        {foreach $lang_folders as $folder}
                                                                            <option {if $folder == $folder_selected} selected="selected" {/if} >{$folder}</option>
                                                                        {/foreach}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="inputParent">{lang('a_tpl')}:</label>
                                                                <div class="controls">
                                                                    <select name="template">
                                                                        {foreach $templates as $template}
                                                                            <option {if $template == $template_selected} selected="selected" {/if} >{$template}</option>
                                                                        {/foreach}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                                </tr>
                                                </tbody>
                                                </table>
                                        </div>


                                        <div class="tab-pane">

                                        </div>
                                    </div>
                                    </div>
                                    </section>
                                    </div>{form_csrf()}
                                    </form>