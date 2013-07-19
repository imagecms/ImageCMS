<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">редактирование шаблона письма</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/email/index" class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('a_return')}</span>
                </a>
                <button type="button" class="btn btn-small formSubmit" data-form="#email_form" data-action="save">
                    <i class="icon-ok"></i>{lang('a_save')}
                </button>
                <button type="button" class="btn btn-small formSubmit" data-form="#email_form" data-action="tomain">
                    <i class="icon-edit"></i>{lang('a_save_and_exit')}
                </button>
            </div>
        </div>
    </div>
    <div class="content_big_td row-fluid">
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#settings" class="btn btn-small active">Настройки шаблона</a>
                <a href="#variables" class="btn btn-small">Переменние шаблона</a>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="settings">
                <div class="inside_padd">
                    <form action="{$BASE_URL}admin/components/cp/email/edit/{$model['id']}" id="email_form" method="post" class="form-horizontal">
                        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                            <thead>
                            <th>{lang('a_sett')}</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="inside_padd">
                                            <div class="row-fluid">
                                                <div class="control-group">
                                                    <label class="control-label" for="comcount">Название шаблона письма:</label>
                                                    <div class="controls">
                                                        <input id="comcount" type="text" name="mail_name" value="{$model['name']}" disabled="disabled"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="comcount2">От кого:</label>
                                                    <div class="controls">
                                                        <input id="comcount2" type="text" name="sender_name" value="{$model['from']}"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="comcount3">От кого (mail):</label>
                                                    <div class="controls">
                                                        <input id="comcount3" type="text" name="from_email" value="{$model['from_email']}"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="comcount4">Тема:</label>
                                                    <div class="controls">
                                                        <input id="comcount4" type="text" name="mail_theme" value="{$model['theme']}"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="comcount5">Тип письма:</label>
                                                    <div class="controls">
                                                        &nbsp; HTML &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="mail_type" value="html" {if $model['type'] == 'HTML'}checked="checked"{/if} id="comcount5"/>
                                                            </span>
                                                        </span>
                                                        &nbsp; Text &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="mail_type" value="text" {if $model['type'] == 'Text'}checked="checked"{/if} id="comcount5"/>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="userMailText">Шаблон письма пользователю:
                                                        </br>&nbsp;
                                                        <select name="mail_variables[]" multiple="multiple" id="userMailVariables" size="20">
                                                            <option title="Переменная для вставки имя пользователя %userName%" value="%userName%"> Имя пользователя    </option>
                                                            <option title="Переменная для вставки email пользователя %userEmail%" value="%userEmail%">Email пользователя</option>
                                                            <option title="Переменная для вставки телефона пользователя %userPhone%" value="%userPhone%">Телефон пользователя</option>
                                                            <option title="Переменная для вставки адреса доставки %userDeliver%" value="%userDeliver%">Адресс доставки</option>
                                                            <option title="Переменная для вставки номера заказа %orderId%" value="%orderId%">Номер заказа</option>
                                                            <option title="Ключ заказа для просмотра заказа на сайте %orderKey%"value="%orderKey%">Ключ заказа</option>
                                                            <option title="Ссылка для просмотра заказа на сайте %orderLink%" value="%orderLink%">Ссылка на заказ</option>
                                                            <option title="Комментарий пользователя %userComment%" value="%userComment%">Комментарий пользователя</option>
                                                            <option title="Ключ списка желаний %wishKey%" value="%wishKey%">Ключ списка желаний</option>
                                                            <option title="Ссылка для просмотра списка желаний" value="%wishLink%">Ссылка на список желаний</option>
                                                            <option title="Дата создания списка желаний %wishDateCreated%" value="%wishDateCreated%">Дата создания списка желаний</option>
                                                            <option title="IP адресс пользователя %userIP%" value="%userIP%">Ip пользователя</option>
                                                        </select>
                                                    </label>
                                                    <div class="controls">
                                                        <textarea class="elRTE" name="userMailText" id="userMailText">{$model['user_message']}</textarea>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="userMailTextRadio">Отправлять письмо пользователю:</label>
                                                    <div class="controls">
                                                        &nbsp; ДА &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="userMailTextRadio" value="1" {if $model['user_message_active']}checked="checked"{/if} id="userMailTextRadio"/>
                                                            </span>
                                                        </span>
                                                        &nbsp; НЕТ &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="userMailTextRadio" value="0" {if !$model['user_message_active']}checked="checked"{/if} id="userMailTextRadio"/>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="adminMailText">Шаблон письма:
                                                        </br>&nbsp;
                                                        <select name="mail_variables[]" multiple="multiple" id="adminMailVariables" size="20">
                                                            <option title="Переменная для вставки имя пользователя %userName%" value="%userName%"> Имя пользователя    </option>
                                                            <option title="Переменная для вставки email пользователя %userEmail%" value="%userEmail%">Email пользователя</option>
                                                            <option title="Переменная для вставки телефона пользователя %userPhone%" value="%userPhone%">Телефон пользователя</option>
                                                            <option title="Переменная для вставки адреса доставки %userDeliver%" value="%userDeliver%">Адресс доставки</option>
                                                            <option title="Переменная для вставки номера заказа %orderId%" value="%orderId%">Номер заказа</option>
                                                            <option title="Ключ заказа для просмотра заказа на сайте %orderKey%"value="%orderKey%">Ключ заказа</option>
                                                            <option title="Ссылка для просмотра заказа на сайте %orderLink%" value="%orderLink%">Ссылка на заказ</option>
                                                            <option title="Комментарий пользователя %userComment%" value="%userComment%">Комментарий пользователя</option>
                                                            <option title="Ключ списка желаний %wishKey%" value="%wishKey%">Ключ списка желаний</option>
                                                            <option title="Ссылка для просмотра списка желаний" value="%wishLink%">Ссылка на список желаний</option>
                                                            <option title="Дата создания списка желаний %wishDateCreated%" value="%wishDateCreated%">Дата создания списка желаний</option>
                                                            <option title="IP адресс пользователя %userIP%" value="%userIP%">Ip пользователя</option>
                                                        </select>
                                                    </label>
                                                    <div class="controls">
                                                        <textarea class="elRTE" name="adminMailText" id="adminMailText">{$model['admin_message']}</textarea>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="adminMailTextRadio">Отправлять письмо администратору:</label>
                                                    <div class="controls">
                                                        &nbsp; ДА &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="adminMailTextRadio" value="1" {if $model['admin_message_active']}checked="checked"{/if} id="adminMailTextRadio"/>
                                                            </span>
                                                        </span>
                                                        &nbsp; НЕТ &nbsp;
                                                        <span class="frame_label">
                                                            <span class="niceRadio b_n">
                                                                <input type="radio" name="adminMailTextRadio" value="0" {if !$model['admin_message_active']}checked="checked"{/if} id="adminMailTextRadio"/>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="comcount3">Адресс администратора:</label>
                                                    <div class="controls">
                                                        <input id="comcount3" type="text" name="admin_email" value="{$model['admin_email']}"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="symcount2">Описание шаблона:</label>
                                                    <div class="controls">
                                                        <textarea class="elRTE" name="mail_desc" id="symcount2">{$model['description']}</textarea>
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

                </div>
            </div>
            <div class="tab-pane active" id="variables">

                <div class="inside_padd">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td variablesTable">
                        <thead>
                        <th>Переменние</th>
                        <th>Значения</th>
                        <th class="span2">Редактировать</th>
                        <th class="span1">Удалить</th>
                        </thead>
                            {foreach $variables as $variable => $variable_value}
                                <tr>
                                    <td>
                                        <div class="variable">
                                            {echo $variable}
                                        </div>
                                        <input type="text" name="variableEdit" class="variableEdit" style="display: none"/>
                                    </td>
                                    <td>
                                        <div class="variableValue">
                                            {echo $variable_value}
                                        </div>
                                        <input type="text" name="variableValueEdit" class="variableValueEdit" style="display: none"/>
                                    </td>
                                    <td class="span1">
                                        <button class="btn my_btn_s btn-small btn-success editVariable" type="button">
                                            <i class="icon-edit"></i>
                                        </button>
                                        <button data-update="count" onclick="EmailTemplateVariables.update($(this), '{$model['id']}', '{echo $variable}')" class="btn btn-small refreshVariable" type="button" style="display: none;">
                                            <i class="icon-refresh"></i>
                                        </button>
                                    </td>
                                    <td class="span1">
                                        <button class="btn my_btn_s btn-small btn-danger " type="button" onclick="EmailTemplateVariables.delete({$model['id']}, '{echo $variable}', $(this))">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr class="addVariableContainer" style="display: none">
                                <td class="span10">
                                    <input type="text" name="variableEdit" class="variableEdit"/>
                                </td>
                                <td class="span10">
                                    <input type="text" name="variableValueEdit" class="variableValueEdit"/>
                                </td>
                                <td  class="span5" colspan="2">
                                    <button data-update="count" onclick="EmailTemplateVariables.add($(this), {$model['id']})"  class="btn btn-small" type="button" style="display: block; margin-top: 4px">
                                        <i class="icon-plus"></i>
                                    </button>
                                </td>
                            </tr>
                    </table>
                    <a href="#" class="btn btn-small btn-success addVariable">
                        <i class="icon-plus icon-white"></i>&nbsp;Добавить новую переменную
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
