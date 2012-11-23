<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Создание шаблона письма</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/sample_mail/index" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#widget_form" data-action="tomain"><i class="icon-edit"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <form action="{$BASE_URL}admin/components/cp/sample_mail/create" id="widget_form" method="post" class="form-horizontal">
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
                                            <label class="control-label" for="comcount">Название шаблона письма (только латиница):</label>
                                            <div class="controls">
                                                <input id="comcount" type="text" name="mail_name" value=""/> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="comcount2">От кого:</label>
                                            <div class="controls">
                                                <input id="comcount2" type="text" name="sender_name" value=""/> 
                                                <span class="help-inline">По умолчанию от "Администрация сайта"</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="comcount3">От кого (mail):</label>
                                            <div class="controls">
                                                <input id="comcount3" type="text" name="from_email" value=""/> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="comcount4">Тема:</label>
                                            <div class="controls">
                                                <input id="comcount4" type="text" name="mail_theme" value=""/> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="comcount5">Тип письма:</label>
                                            <div class="controls">
                                                &nbsp; HTML &nbsp;
                                                <span class="frame_label">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="mail_type" value="html" checked="checked" id="comcount5"/> 
                                                    </span>
                                                </span>
                                                &nbsp; Text &nbsp;
                                                <span class="frame_label">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="mail_type" value="text" id="comcount5"/> 
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="mailText">Шаблон письма:
                                                </br>&nbsp;
                                                <select name="mail_variables[]" multiple="multiple" id="mailVariables" size="20">
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
                                                <textarea class="elRTE" name="mail_text" id="mailText"></textarea>
                                            </div>
                                        </div>    
                                        <div class="control-group">
                                            <label class="control-label" for="symcount2">Описание шаблона:</label>
                                            <div class="controls">
                                                <textarea class="elRTE" name="mail_desc" id="symcount2"></textarea>
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
</section>
