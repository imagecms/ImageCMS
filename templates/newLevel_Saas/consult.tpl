<div style="max-width: 530px;" id="consult" class="fancy">
    <div class="panel-default">
        <div class="title-default-out">
            <div class="title">
                Консультация
            </div>
        </div>
        <div class="footer-panel">
            <div class="inside-padd">
                <span class="s-t">Ваш запрос обработает менеджер и отправит ответ в ближайшие сроки</span>
            </div>
        </div>
        <form method="post" action="{site_url('saas/support/create_fast_ticket')}" enctype="multipart/form-data">
            <div class="content-panel">
                <textarea name="ticket[text]" placeholder="Введите Ваше сообщение&hellip;" style="padding-left: 27px;"></textarea>
            </div>
            <div class="footer-panel clearfix">
                <button type="submit" class="btn btn-primary f_l" style="margin: 11px 28px;">
                    <span class="text-el">Отправить</span>
                </button>
                <div class="hidden-type-file f_r btn-attach-file btn">
                    <span class="icon-attach"></span>
                    <span class="text-el">Прикрепить</span>
                    <input type="file" title="Выберете файл" name="attachment"/>
                </div>
            </div>
            {form_csrf()}
        </form>
    </div>
</div>