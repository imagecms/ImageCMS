<div style="max-width: 530px;" id="consult" class="fancy">
    <div class="panel-default">
        <div class="title-default-out">
            <div class="title">
                {echo lang('Консультация', 'premmerce')}
            </div>
        </div>
        <div class="footer-panel">
            <div class="inside-padd">
                <span class="s-t">{echo lang('Ваш запрос обработает менеджер и отправит ответ в ближайшие сроки', 'premmerce')}</span>
            </div>
        </div>
        <form method="post" action="{site_url('saas/support/create_fast_ticket')}" enctype="multipart/form-data">
            <div class="content-panel">
                <textarea name="ticket[text]" placeholder="{echo lang('Введите Ваше сообщение', 'premmerce')}&hellip;" style="padding-left: 27px;"></textarea>
            </div>
            <div class="footer-panel clearfix">
                <button type="submit" class="btn btn-primary f_l" style="margin: 11px 28px;">
                    <span class="text-el">{echo lang('Отправить', 'premmerce')}</span>
                </button>
                <div class="hidden-type-file f_r btn-attach-file btn">
                    <span class="icon-attach"></span>
                    <span class="text-el">{echo lang('Прикрепить', 'premmerce')}</span>
                    <input type="file" title="{echo lang('Выберете файл', 'premmerce')}" name="attachment"/>
                </div>
            </div>
            {form_csrf()}
        </form>
    </div>
</div>