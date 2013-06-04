<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="span1">Ид варианта</th>
            <th class="span3">Назва варианта</th>
            <th class="span2" style="width:80px;">Вкл/Выкл</th>
            <th class="span1" style="width:60px;">В наличии</th>

        </tr>
    </thead>
    <tbody class="sortable save_positions" data-url='/admin/components/init_window/banners/save_positions'>
        {foreach $parametr as $p}
            <tr>

                <td><p>{echo $p['id']}</p></td>
                <td>
                    <p>{echo $p['name']}</p>
                </td>


                <td>
                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $p['on']}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" >
                        <span class="prod-on_off {if !$p['on']}disable_tovar{/if}" style="{if !$p['on']}left: -28px;{/if}" {if $b['on']}rel="true"{else:}rel="false"{/if}
                              onclick="ChangeProductOn(this,{echo $p['id']});"></span>
                    </div>
                </td>
                <td>
                    <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $p['in_stock']}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" >
                        <span class="prod-on_off {if !$p['in_stock']}disable_tovar{/if}" style="{if !$p['in_stock']}left: -28px;{/if}" {if $b['in_stock']}rel="true"{else:}rel="false"{/if}
                              onclick="ChangeProductInStock(this,{echo $p['id']});"></span>
                    </div>
                </td>

                </div>
                </td>
            </tr>
        {/foreach}

    </tbody>
</table>