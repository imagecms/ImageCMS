

<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">MailChimp</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/init_window/mail_chimp" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span> 
                        <span class="t-d_u">Назад</span>
                    </a>
                </div>
                <div class="d-i_b">
                    <button type="button"
                            class="btn btn-small btn-success action_on formSubmit"
                            data-form="#mail_form"
                            data-action="tomain">
                        <i class="icon-ok"></i>Сохранить
                    </button>
                </div>
            </div>                            
        </div>

        <div class="row-fluid">
            <form method="post" action="/admin/components/init_window/mail_chimp/create/" class="form-horizontal" id="mail_form">
                <div class="tab-pane">
                    <div class="control-group">
                        <label class="control-label" for="inputFromEmail">Email:</label>
                        <div class="controls">
                            <input type="text" id="inputFromEmail" class="input-large" placeholder="{lang('Email','mail_chimp')}" name="from_email" value="a.gula@imagecms.net"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputFromEmailSubject">Тема:</label>
                        <div class="controls">
                            <input type="text" id="inputFromEmailSubject" class="input" placeholder="{lang('Email subject','mail_chimp')}" name="subject"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="from_name">Отправитель:</label>
                        <div class="controls">
                            <input type="text" id="from_name" class="input" placeholder="{lang('Sender name','mail_chimp')}" name="from_name"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Текст:</label>
                        <div class="controls">
                            <textarea class="elRTE" name="text"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Виберите список пользователей:</label>
                        <div class="controls">
                            <select name="list">
                                {foreach $lists['data'] as $list}
                                    <option value="{echo $list['id']}">{echo $list['name']}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
