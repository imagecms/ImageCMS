<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Partners', 'exchangeunfu')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'exchangeunfu')}</span>
                </a>
                <button type="button" class="btn btn-small action_on btn-success addPartnerBtn">
                    <i class="icon-plus"></i>{lang('Add partner', 'exchangeunfu')}</button>
                <a class="btn btn-small pjax"  href="{$BASE_URL}admin/components/init_window/exchangeunfu/settings" >
                    <i class="icon-wrench"></i>{lang('Settings', 'exchangeunfu')}
                </a>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/exchangeunfu/update_settings')}" class="form-horizontal" id="exchange_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th class="span1">#</th>
                    <th>{lang('Name', 'exchangeunfu')}</th>
                    <th class="span2">{lang('Prefix', 'exchangeunfu')}</th>
                    <th>{lang('Code', 'exchangeunfu')}</th>
                    <th class="span4">{lang('Region', 'exchangeunfu')}</th>
                    <th class="span2">{lang('Edit', 'exchangeunfu')}</th>
                    <th class="span2">{lang('Delete', 'exchangeunfu')}</th>
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
                                <i class="icon-edit"></i>{lang('Edit', 'exchangeunfu')}</button>
                            <button type="button" class="btn btn-small btn-success partnerUpdate" style="display: none">
                                <i class="icon-refresh"></i>{lang('Refresh', 'exchangeunfu')}</button>
                        </td>
                        <td class="span1">
                            <button type="button" class="btn btn-small action_on btn-danger deletePartner">
                                <i class="icon-trash"></i>{lang('Delete', 'exchangeunfu')}</button>
                        </td>

                    </tr>
                {/foreach}
                <tr class="newPartner" style="display: none">
                    <td class="countPartners">
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
                            <i class="icon-plus"></i>{lang('Add', 'exchangeunfu')}</button>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</section>