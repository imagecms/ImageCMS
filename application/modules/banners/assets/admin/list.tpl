<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Banners management', 'banners')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <span style="position: relative" class="d-i_b v-a_m">
                        <a href="#" onclick="$(this).next().slideToggle();
                                return false" class="btn btn-small">{lang('Template settings', 'banners')}</a>
                        <div style="position: absolute; display: none; background-color: white; padding: 8px; margin-top: 5px;width: 335px;border: 1px solid #ccc;">
                            <input {if $show_tpl}checked='checked'{/if}type="checkbox" onclick="chckTplParam(this);" /> {lang('Use different templates for different pages', 'banners')}
                        </div>
                    </span>

                    <a href="/admin/components/init_window/banners/create" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('Create a banner', 'banners')}</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="banner_del" onclick="DeleteSliderBanner()"><i class="icon-trash"></i>{lang('Delete', 'banners')}</button>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="row-fluid">
                {if count($banners) > 0}
                    <table class="table  table-bordered table-hover table-condensed t-l_a">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" />
                                        </span>
                                    </span>
                                </th>
                                <th>{lang('ID', 'banners')}</th>
                                <th>{lang('Name', 'banners')}</th>
                                <th>{lang('Groups', 'banners')}</th>
                                <th style="width:80px;">{lang('Active to', 'banners')}</th>
                                <th style="width:60px;">{lang('Status', 'banners')}</th>

                            </tr>
                        </thead>
                        <tbody class="sortable save_positions" data-url='/admin/components/init_window/banners/save_positions'>
                            {foreach $banners as $b}
                                <tr>
                                    <td class="t-a_c span1">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" value="{echo $b['id']}"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        {echo $b['id']}
                                    </td>
                                    <td>
                                        <a href="/admin/components/init_window/banners/edit/{echo $b['id']}/{$locale}" data-rel="tooltip" data-title="{lang('Edit banner', 'banners')}">{echo $b['name']}</a>
                                    </td>
                                    <td>
                                        {echo implode(', ',unserialize($b['group']))}
                                    </td>

                                    <td>
                                        {if $b['active_to'] != -1}
                                            <p>{echo date('Y-m-d',$b['active_to'])}</p>
                                        {else:}
                                            <p>{lang('Permanent','banners')}</p>
                                        {/if}
                                    </td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $b['active'] == 1}{lang('show', 'banners')}{else:}{lang("don't show", 'banners')}{/if}" >
                                            <span class="prod-on_off {if $b['active'] != 1}disable_tovar{/if}" style="{if $b['active'] != 1}left: -28px;{/if}" {if $b['active'] == 1}rel="true"{else:}rel="false"{/if}
                                                  onclick="ChangeBannerSliderActive(this,{echo $b['id']});"></span>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                {else:}
                    <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                        {lang('Empty banner list.', 'banners')}
                    </div>
                {/if}
            </div>
        </div>
    </section>
</div>
