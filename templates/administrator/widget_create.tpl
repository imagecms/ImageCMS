<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Widget creating")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/widgets_manager/index/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back")}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#wid_cr_form" data-action="tomain" data-submit><i class="icon-plus-sign icon-white"></i>{lang("Create")}</button>
                <!--<button type="button" class="btn btn-small formSubmit" data-form="#wid_cr_form" data-action="tomain"><i class="icon-check"></i>{lang("Save and go back")}</button>-->
            </div>
        </div>                            
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <form method="post" action="{$BASE_URL}admin/widgets_manager/create" class="form-horizontal" id="wid_cr_form">
                <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang("Properties")}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="control-group m-t_10">
                                        <label class="control-label" for="inputName">{lang("Name")}:</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="inputName" class="required"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputDesc">{lang("Description")}:</label>
                                        <div class="controls">
                                            <input type="text" name="desc" id="inputDesc">
                                            <p class="help-block">{lang("Short widget discription")}</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="inputType">{lang("Type")}:</label>
                                        <div class="controls">
                                            <select id="inputType" name="type">
                                                <option value="module">{lang("Module")}</option>
                                                <option value="html">{lang("HTML")}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group" id="mod_name">
                                        <label class="control-label">{lang("Module name")}:</label>
                                        <div class="controls">
                                            <span class="selmod">Выберите тип модуля с таблицы ниже</span>
                                            <input type="hidden" class="required" name="module" value="" id="sw">
                                            <input type="hidden" name="method" value="" id="swm">
                                        </div>
                                    </div>

                                    <div class="control-group" id="textareaholder" style="display:none;">
                                        <label class="control-label">HTML:</label>
                                        <div class="controls" style="top: 6px;">
                                            <textarea name="html_code" rows="15" class="elRTE"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="moduleholder">
                        <thead>
                            <tr>
                                <th class="t-a_c span1"></th>
                                <th class="span3">{lang("Name")}</th>
                                <th class="span5">{lang("Description")}</th>
                                <th class="span2">{lang("Type")}</th>
                            </tr>
                        </thead>
                        <tbody class="sortable ui-sortable">
                            {foreach $blocks as $block}
                                {$mtype = $block.module}
                                {$type = $block.module_name}
                                {foreach $block.widgets as $item}
                                    <tr data-original-title="">
                                        <td class="t-a_c">
                                            <span class="frame_label">
                                                <span class="niceRadio b_n selwid" data-title="{$item.title}" data-mname="{$mtype}" data-method="{$item.method}">
                                                    <input type="radio" name="one_column" />
                                                </span>
                                            </span>
                                        </td>
                                        <td><p>{$item.title}</p></td>
                                        <td><p>{$item.description}</p></td>
                                        <td><p>{$type}</p></td>
                                    </tr>
                                {/foreach}
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                {form_csrf()}
            </form>
        </div>
    </div>
    <div class="tab-pane"></div>
</div>
</section>


