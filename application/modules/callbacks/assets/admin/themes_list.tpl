<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Collbacks topics','admin')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$ADMIN_URL}callbacks/createTheme" class="pjax btn btn-small btn-success"><i
                                class="icon-plus-sign icon-white"></i>{lang('Create topic','admin')}</a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="row-fluid">
                <table class="table  table-bordered table-hover table-condensed t-l_a">
                    <thead>
                    <tr>
                        {/*}
                        <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                        </th>
                        { */}
                        <th class="span1">ID</th>
                        <th>{lang('Title','admin')}</th>
                        <th>{lang('Delete','admin')}</th>
                    </tr>
                    </thead>
                    <tbody class="sortable save_positions"
                           data-url="/admin/components/run/callbacks/reorderThemes">
                    {foreach $model as $c}
                        <tr data-id="{echo $c->getId()}">
                            {/*}
                            <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" value="{echo $c->getId()}"/>
                                            </span>
                                        </span>
                            </td>
                            { */}
                            <td>{echo $c->getId()}</td>
                            <td>
                                <a href="{$ADMIN_URL}callbacks/updateTheme/{echo $c->getId()}/{$locale}"
                                   data-rel="tooltip"
                                   data-title="{lang('Edit callback theme','admin')}">{echo ShopCore::encode($c->getText())}</a>
                            </td>
                            <td class="t-a_c span1">
                                <a href="#" onclick="callbacks.deleteTheme({echo $c->getId()});
                                        return false;" class="btn btn-small "> <i class="icon-trash"></i></a>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
