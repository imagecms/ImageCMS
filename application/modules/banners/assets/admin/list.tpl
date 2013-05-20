<div class="container">


    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_s_banner_list_r')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/init_window/banners/create" class="btn btn-small btn-success pjax"><i class="icon-plus-sign icon-white"></i>{lang('a_s_banner_new_r')}</a>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" id="banner_del" onclick="DeleteSliderBanner()"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                </div>
            </div>                            
        </div>
        <div class="tab-content">
            <div class="row-fluid">
                {if count($banners) > 0}
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" />
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('a_ID')}</th>
                                <th class="span3">{lang('a_name')}</th>
                                <th class="span2" style="width:80px;">Активен до</th>
                                <th class="span1" style="width:60px;">{lang('a_status')}</th>

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
                                    <td><p>{echo $b['id']}</p></td>
                                    <td>
                                        <a class="pjax" href="/admin/components/init_window/banners/edit/{echo $b['id']}/{$locale}" data-rel="tooltip" data-title="{lang('a_edit')}">{echo $b['name']}</a>
                                    </td>

                                    <td><p>{echo date('Y-m-d',$b['active_to'])}</p></td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $b['active'] == 1}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" >
                                            <span class="prod-on_off {if $b['active'] != 1 }disable_tovar{/if}" style="{if $b['active'] != 1 }left: -28px;{/if}" {if $b['active'] == 1 }rel="true"{else:}rel="false"{/if}
                                                  onclick="ChangeBannerSliderActive(this,{echo $b['id']});"></span>
                                        </div>
                                    </td>
                                    
                                    </div>
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                {else:}
                    <div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
                        {lang('a_empty_banners')}
                    </div>
                {/if}
            </div>
        </div>
    </section>
</div>
