<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Парнеры</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'admin')}</span>
                </a>
                <button type="button" class="btn btn-small action_on btn-success addPartnerBtn">
                    <i class="icon-plus"></i>Добавить партнера</button>
                <a class="btn btn-small pjax"  href="{$BASE_URL}admin/components/init_window/exchangeunfu/settings" >
                    <i class="icon-wrench"></i>{lang('Settings', 'admin')}
                </a>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/exchangeunfu/update_settings')}" class="form-horizontal" id="exchange_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="span1">#</th>
                    <th>Имя</th>
                    <th class="span2">Префикс</th>
                    <th>Код</th>
                    <th class="span4">Регион</th>
                    <th class="span2">Обновить</th>
                    <th class="span2">Удалить</th>
                </tr>
            </thead>
            <tbody>
                {foreach $partners as $key => $partner}
                    <tr data-partnerId="{echo $partner['id']}">
                        <td>{echo $key+1}
                        </td>
                        <td>
                            <div class="name">{echo $partner['name']}</div>
                            <input type="text" class="name" style="display: none"/>
                        </td>
                        <td>
                            <div class="prefix">{echo $partner['prefix']}</div>
                            <input type="text" class="prefix" style="display: none"/>
                        </td>
                        <td>
                            <div class="code">{echo $partner['code']}</div>
                            <input type="text" class="code" style="display: none"/>
                        </td>
                        <td>
                            <div class="region">{echo $partner['region']}</div>
                            <input type="text" class="region" style="display: none"/>
                        </td>
                        <td class="span1">
                            <button type="button" class="btn btn-small btn-success partnerRefresh">
                                <i class="icon-edit"></i></button>
                            <button type="button" class="btn btn-small btn-success partnerUpdate" style="display: none">
                                <i class="icon-refresh"></i></button>
                        </td>
                        <td class="span1">
                            <button type="button" class="btn btn-small action_on btn-danger deletePartner">
                                <i class="icon-trash"></i></button>
                        </td>

                    </tr>
                {/foreach}
                <tr class="newPartner" style="display: none">
                    <td>
                        {echo $key+2}
                    </td>
                    <td>
                        <input type="text" class="name"/>
                    </td>
                    <td>
                        <input type="text" class="prefix"/>
                    </td>
                    <td>
                        <input type="text" class="code"/>
                    </td>
                    <td>
                        <input type="text" class="region"/>
                    </td>
                    <td>
                        <button type="button" class="btn btn-small btn-success partnerAdd">
                            <i class="icon-plus"></i></button>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>