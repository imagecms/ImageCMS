<div class="container">
    {$ci = get_instance()}
    {$ci->load->model('dx_auth/users', 'users')}
    <form action="/admin/components/run/callbacks/index" id="filter_form" method="get" class="listFilterForm">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('Callback list','admin')} ({$totalCallbacks})</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <button type="button" onclick="$('.modal-remove-callback').modal();"
                        class="btn btn-small btn-danger disabled action_on"><i
                        class="icon-trash"></i>{lang('Delete','admin')}
                    </button>
                    <button title="{lang('Filter','admin')}" type="submit"
                    class="d_n btn btn-small disabled listFilterSubmitButton">
                    <i class="icon-filter"></i>{lang('Filter','admin')}
                </button>
                <button title="{lang('Reset filter','admin')}"
                onclick="if (!$(this).hasClass('disabled'))
                location.href = '/admin/components/run/callbacks/'"
                type="button"
                class="btn btn-small {if $_GET['_pjax'] && count($_GET)==1 || $_GET == null || ($_GET['WithoutImages'] == 1 && count($_GET)==1)}disabled{/if}">
                <i class="icon-refresh"></i>{lang('Cancel filter','admin')}
            </button>
        </div>
    </div>
</div>
<div class="tab-content">
    <div class="active  row-fluid tab-pane" id="callbacks_all">
        <table class="table  table-bordered table-hover table-condensed">
            <colgroup>
            <col width="3%">
            <col width="6%">
            <col width="19%">
            <col width="19%">
            <col width="12%">
            <col width="12%">
            <col width="24%">
            <col width="5%">
        </colgroup>
        <thead>
            <tr>
                <th class="t-a_c" style="width:30px">
                    <span class="frame_label">
                        <span class="niceCheck" style="background-position: -46px 0px; ">
                            <input type="checkbox">
                        </span>
                    </span>
                </th>
                <th class="span1">{lang('ID','admin')}</th>
                <th>{lang('User name','admin')}</th>
                <th>{lang('Telephone','admin')}</th>
                <th>{lang('Theme','admin')}</th>
                <th>{lang('Status','admin')}</th>
                <th>{lang('Date','admin')}</th>
                <th class="span1">{lang('Delete', 'admin')}</th>
            </tr>
            <tr class="head_body">
                <input type="hidden" name="orderMethod" value="{$_GET.orderMethod}"/>
                <input type="hidden" name="order" value="{$_GET.order}"/>
                <td class="t-a_c">

                </td>
                <td class="">
                    <div>
                        <input id="filterID" name="filterID" onkeypress='validateN(event)' type="text"
                        value="{$_GET.filterID}"/>
                    </div>
                </td>
                <td>
                    <input type="text" name="user_name" value="{htmlspecialchars($_GET.user_name)}" maxlength="500"/>
                </td>
                <td>
                    <input type="text" name="phone" value="{htmlspecialchars($_GET.phone)}" maxlength="500"/>
                </td>
                <td>
                    <select onchange="$(this).closest('form').submit()" name="ThemeId">
                        <option value="0">{lang('All','admin')}</option>
                        <option value="without" {if $_GET.ThemeId == 'without'}selected="selected"{/if}>{lang('Does not have','admin')}</option>
                        {foreach $callbackThemes as $theme}
                        {$selected = ''}
                        {if $theme->getId() == (int)$_GET.ThemeId}
                        {$selected='selected="selected"'}
                        {/if}
                        <option value="{echo $theme->getId()}" {$selected} >{echo ShopCore::encode($theme->getText())}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <select onchange="$(this).closest('form').submit()" name="StatusId">
                        <option value="0">{lang('All','admin')}</option>
                        {foreach $callbackStatuses as $status}
                        {$selected = ''}
                        {if $status->getId() == (int)$_GET.StatusId}
                        {$selected='selected="selected"'}
                        {/if}
                        <option value="{echo $status->getId()}" {$selected} >{echo ShopCore::encode($status->getText())}</option>
                        {/foreach}
                    </select>
                </td>
                <td class="f-s_0">
                    <label class="v-a_m"
                    style="width:47%;margin-right:6%; display: inline-block;margin-bootom:0px;">
                    <span class="o_h d_b p_r">
                        <input type="text"
                        placeholder="{lang('from','admin')}"
                        data-placement="top"
                        data-original-title="{lang('choose a date','admin')}"
                        data-rel="tooltip"
                        class="datepicker "
                        name="created_from"
                        value="{$_GET['created_from']}">
                        <i class="icon-calendar"></i>
                    </span>
                </label>
                <label class="v-a_m" style="width:47%; display: inline-block;margin-bootom:0px;">
                    <span class="o_h d_b p_r">
                        <input type="text" placeholder="{lang('to','admin')}" data-placement="top"
                        data-original-title="{lang('choose a date','admin')}" data-rel="tooltip"
                        class="datepicker " name="created_to" value="{$_GET['created_to']}">
                        <i class="icon-calendar"></i>
                    </span>
                </label>
            </td>
            <td></td>
            {form_csrf()}
        </tr>
    </thead>
    <tbody>
        {foreach $model as $c}
        <tr data-status="{echo $c->getStatusId()}" data-id="{echo $c->getId()}"
            class="simple_tr">
            <td class="t-a_c">
                <span class="frame_label">
                    <span class="niceCheck" style="background-position: -46px 0px; ">
                        <input type="checkbox" name="ids" value="{echo $c->getId()}">
                    </span>
                </span>
            </td>
            <td>{echo $c->getId()}</td>
            <td><a class="elips-text" href="{$ADMIN_URL}callbacks/update/{echo $c->getId()}"
             data-rel="tooltip" title="" data-title="{lang('Edit callback','admin')}">
             {truncate(ShopCore::encode($c->getName()), 50)}
         </a></td>
         <td><span class="elips-text">{echo encode($c->getPhone())}</span></td>
         <td>
            <div>
                <select name="theme"
                onchange="callbacks.changeTheme({echo $c->getId()}, this.value)">
                <option value="0"
                selected="selected">{lang('Does not have','admin')}</option>
                {foreach $callbackThemes as $callbackTheme}
                <option value="{echo $callbackTheme->getId()}" {if $callbackTheme->getId() == $c->getThemeId()} selected="selected" {/if}>{echo $callbackTheme->getText()}</option>
                {/foreach}
            </select>
        </div>
    </td>
    <td>
        <div>
            <select name="status"
            onchange="callbacks.changeStatus({echo $c->getId()}, this.value)">
            {foreach $callbackStatuses as $callbackStatus}
            <option value="{echo $callbackStatus->getId()}" {if $callbackStatus->getId() == $c->getStatusId()} selected="selected" {/if}>{echo $callbackStatus->getText()}</option>
            {/foreach}
        </select>
    </div>
</td>
<td>{echo date('d-m-Y H:i', $c->getDate())}</td>
<td class="t-a_c span1">
    <a href="#" class="btn btn-small btn-danger"
    onclick="callbacks.deleteOne({echo $c->getId()})"><i class="icon-trash"></i></a>
</td>
</tr>
{/foreach}
</tbody>
</table>
</div>
{foreach $callbackStatuses as $s}
<div class="row-fluid tab-pane  " id="callbacks_{echo $s->getId()}">
    <table class="table  table-bordered table-hover table-condensed t-l_a">
        <thead>
            <tr>
                <th class="t-a_c span1">
                    <span class="frame_label">
                        <span class="niceCheck" style="background-position: -46px 0px; ">
                            <input type="checkbox">
                        </span>
                    </span>
                </th>
                <th>{lang('ID','admin')}</th>
                <th>{lang('User name','admin')}</th>
                <th>{lang('Telephone','admin')}</th>
                <th>{lang('Theme','admin')}</th>
                <th>{lang('Status','admin')}</th>
                <th>{lang('Date','admin')}</th>
                <!-- <th  >{lang('Manager','admin')}</th>  -->
                <th>{lang('Delete', 'admin')}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $model as $c}
            {if $c->getStatusId() == $s->getId()}
            <tr data-status="{echo $c->getStatusId()}" id="callback_{echo $c->getId()}"
                class="simple_tr">
                <td class="t-a_c">
                    <span class="frame_label">
                        <span class="niceCheck"
                        style="background-position: -46px 0px; ">
                        <input type="checkbox" name="ids"
                        value="{echo $c->getId()}">
                    </span>
                </span>
            </td>
            <td>{echo $c->getId()}</td>
            <td><a href="{$ADMIN_URL}callbacks/update/{echo $c->getId()}"
             data-rel="tooltip"
             data-title="{lang('Edit callback','admin')}">
             {truncate(ShopCore::encode($c->getName()), 50)}
         </a>
     </td>
     <td>{echo encode($c->getPhone())}</td>
     <td>
        <select name="theme"
        onchange="callbacks.changeTheme({echo $c->getId()}, this.value)">
        <option value="0"
        selected="selected">{lang('Does not have','admin')}</option>
        {foreach $callbackThemes as $callbackTheme}
        <option value="{echo $callbackTheme->getId()}" {if $callbackTheme->getId() == $c->getThemeId()} selected="selected" {/if}>{echo $callbackTheme->getText()}</option>
        {/foreach}
    </select>
</td>
<td>
    <div>
        <select name="status"
        onchange="callbacks.changeStatus({echo $c->getId()}, this.value)">
        {foreach $callbackStatuses as $callbackStatus}
        <option value="{echo $callbackStatus->getId()}" {if $callbackStatus->getId() == $c->getStatusId()} selected="selected" {/if}>{echo $callbackStatus->getText()}</option>
        {/foreach}
    </select>
</div>
</td>
<td>{echo date('Y-m-d H:i:s', $c->getDate())}</td>
<td>
    <a href="#" class="btn btn-small"
    onclick="callbacks.deleteOne({echo $c->getId()})"><i
    class="icon-trash"></i></a>
</td>
</tr>
{/if}
{/foreach}
</tbody>
</table>
</div>
{/foreach}
{if !sizeof($model)}
<div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
    {lang('Empty callback list.','admin')}
</div>
{else:}
<div id="gopages" class="navigation">
    {$pagination}
    <div class="pagination pull-right">
        <select style="max-width:60px;" onchange="change_per_page(this);
        return false;">
        {if $_COOKIE['per_page'] == ShopCore::app()->SSettings->adminProductsPerPage}
        <option selected="selected"
        value="{echo $_COOKIE['per_page']}">{echo $_COOKIE['per_page']}</option>{/if}
        <option {if $_COOKIE['per_page'] == 10}selected="selected"{/if} value="10">10</option>
        <option {if $_COOKIE['per_page'] == 20}selected="selected"{/if} value="20">20</option>
        <option {if $_COOKIE['per_page'] == 30}selected="selected"{/if} value="30">30</option>
        <option {if $_COOKIE['per_page'] == 40}selected="selected"{/if} value="40">40</option>
        <option {if $_COOKIE['per_page'] == 50}selected="selected"{/if} value="50">50</option>
        <option {if $_COOKIE['per_page'] == 60}selected="selected"{/if} value="60">60</option>
        <option {if $_COOKIE['per_page'] == 70}selected="selected"{/if} value="70">70</option>
        <option {if $_COOKIE['per_page'] == 80}selected="selected"{/if} value="80">80</option>
        <option {if $_COOKIE['per_page'] == 90}selected="selected"{/if} value="90">90</option>
        <option {if $_COOKIE['per_page'] == 100}selected="selected"{/if} value="100">100</option>
    </select>
</div>
</div>
{/if}
</div>
</section>
</form>
</div>

<div class="modal modal-remove-callback hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Remove callback(s)','admin')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('Really delete callback(s)','admin')}?</p>
    </div>
    <div class="modal-footer">
        <a href="#" onclick="callbacks.deleteMany();" class="btn btn-primary formSubmit"
        data-form="#deleteOrderStatus">{lang('Remove','admin')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>