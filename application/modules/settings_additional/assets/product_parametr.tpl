
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="span1">{lang('Ид варианта', 'settings_additional')}</th>
            <th class="span3">{lang('Назва варианта', 'settings_additional')}</th>
            {if count($parametr) > 1}<th class="span2" style="width:80px;">{lang('Вкл/Выкл', 'settings_additional')}</th>{/if}
            <th class="span1" style="width:60px;">{lang('В наличии', 'settings_additional')}</th>

        </tr>
    </thead>
    <tbody class="sortable save_positions" data-url='/admin/components/init_window/banners/save_positions'>
        {foreach $parametr as $key => $p}

            <tr>

                <td><p>{echo $p['id']}</p></td>
                <td>
                    <p>{echo $p['name']}</p>
                </td>

                {if count($parametr) > 1}
                
                <td>
                    {if $key != 0}
                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $p['on'] OR $p['on'] === NULL}{lang('Показывать', 'settings_additional')}{else:}{lang('Не показывать', 'settings_additional')}{/if}" >                       
                        <span class="prod-on_off {if $p['on'] === '0'}disable_tovar{/if}" style="{if $p['on'] === '0'}left: -28px;{/if}" {if $p['on'] OR $p['on'] === NULL}rel="true"{else:}rel="false"{/if}
                              onclick="ChangeProductOn(this,{echo $p['id']}, {echo $p['pid']});"></span>                           
                    </div>
                    {else:}
                            {/*} {lang('Первый вариант всегда включенный, для выключения первого варианта сделайте второй - первим и виключите его!', 'settings_additional')} { */}
                            {lang('Невозможноё', 'webinger')}
                    {/if}           
                    
                </td>
                {/if}
                <td>
                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $p['in_stock'] OR $p['in_stock'] === NULL}{lang('Показывать', 'settings_additional')}{else:}{lang('Не показывать', 'settings_additional')}{/if}" >
                        <span class="prod-on_off {if $p['in_stock'] === '0'}disable_tovar{/if}" style="{if $p['in_stock'] === '0'}left: -28px;{/if}" {if $p['in_stock'] OR $p['in_stock'] === NULL}rel="true"{else:}rel="false"{/if}
                              onclick="ChangeProductInStock(this,{echo $p['id']}, {echo $p['pid']});"></span>
                    </div>
                </td>

                </div>
                </td>
            </tr>
        {/foreach}

    </tbody>
    
</table>