<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Список виджетов</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <button type="button" class="btn btn-small disabled action_on" id="del_sel_wid"><i class="icon-trash"></i>Удалить</button>
                <button type="button" class="btn btn-small" id="cr_wid_page"><i class="icon-plus-sign"></i>Создать виджет</button>
            </div>
        </div>  
    </div>
    <div class="tab-content">
        {if count($widgets)>0}
        <div class="row-fluid">
            <form method="post" action="#" class="form-horizontal">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span1">
                                <span class="frame_label">
                                    <span class="niceCheck b_n">
                                        <input type="checkbox" value="On"/>
                                    </span>
                                </span>
                            </th>
                            <th class="span1">{lang('a_id')}</th>
                            <th>{lang('a_n')}</th>
                            <th>{lang('a_type')}</th>
                            <th>{lang('a_desc')}</th>
                            <th class="span1">Создан</th>
                        </tr>    
                    </thead>
                    <tbody class="sortable">
                        {foreach $widgets as $widget}
                            <tr>
                                <td>
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox" value="{$widget.name}"/>
                                        </span>
                                    </span>
                                </td>
                                <td>{$widget.id}</td>
                                <td {if $widget.config == TRUE}{/if}  {if $widget.type == 'html'}{/if} >{$widget.name}</td>
                                <td>
                                    {switch $widget.type}
                                        {case 'module':}
                                            {lang('a_module')} {$widget.data}
                                                {break}
                                        {case 'html':}
                                            {lang('a_html')}
                                        {break}
                                    {/switch}
                                </td>
                                <td>{$widget.description}</td>
                                <td>{date('d-m-Y',$widget.created)}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </form>
        </div>
        {else:}
            <div class="alert alert-info">
                Нет созданых виджетов
            </div>
        {/if}
    </div>
</section>