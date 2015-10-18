<div class="container">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('Callback statuses', 'admin')}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <a  href="{$ADMIN_URL}callbacks/createStatus" class="pjax btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('Create status','admin')}</a>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    {if sizeof($model)}
                        <table class="table  table-bordered table-hover table-condensed t-l_a">
                            <thead>
                                <tr>
                                    <th class="span1">{lang('ID','admin')}</th>
                                    <th>{lang('Title','admin')}</th>
                                    <th>{lang('By default','admin')}</th>
                                    <th>{lang('Delete','admin')}</th>
                                </tr>
                            </thead>
                            <tbody >

                                {foreach $model as $c}
                                    <tr data-original-title="" data-id="{echo $c->getId()}">
                                        <td>{echo $c->getId()}</td>
                                        <td>
                                            <a href="{$ADMIN_URL}callbacks/updateStatus/{echo $c->getId()}/{$locale}" data-rel="tooltip" data-title="{lang('Edit callback status','admin')}">{echo ShopCore::encode($c->getText())}</a>
                                        </td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{lang('By default','admin')}" >
                                                <span class="prod-on_off {if !$c->getIsDefault()} disable_tovar" style="left: -28px;" {else:}" style="left: 0px;" {/if} onclick="callbacks.setDefaultStatus({echo $c->getId()}, $(this))" ></span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" onclick="callbacks.deleteStatus({echo $c->getId()}, $(this));
                                                        return false;" class="btn btn-small"{if $c->getIsDefault()}disabled="disabled"{/if}> <i class="icon-trash"></i> </a>
                                        </td>
                                    </tr>
                                {/foreach}

                            </tbody>
                        </table>
                    {else:}
                        <br>
                        <div id="notice" class="alert alert-info">{lang('Empty callbacks status list.','admin')}</div>
                    {/if}
                </div>
            </div>
        </section>
</div>