<div class="modal hide fade modal_edit_menu_item">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Edit menu item','admin_menu')}</h3>
    </div>
    <div class="modal-body" style="text-align: center; margin-left: 60px;">

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Identifier','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="identifier">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Title','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="text">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Link','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="link">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('HTLM class','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="class">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('HTML id','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="id">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Icon class','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="icon">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Callback method name','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="callback">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Enable pjax','admin_menu')}:</label>

            <div class="controls">
                <select data-id="pjax">
                    <option value="yes">{lang('Yes', 'admin_menu')}</option>
                    <option value="no">{lang('No', 'admin_menu')}</option>
                </select>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" onclick="AdminMenu.updateItemData(this)">{lang('Save','admin')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin_menu')}</a>
    </div>
</div>


<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Tariffs menus', 'admin_menu')}</span>             
            </span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'admin')}</span>
                </a>

                <button type="button"
                        class="btn btn-small btn-success"
                        onclick="AdminMenu.saveTariffs(this)">
                    <i class="icon-plus-sign icon-white"></i>{lang('Save', 'saas')}
                </button>

                <button type="button"
                        class="btn btn-small btn-danger"
                        onclick="AdminMenu.uploadTariffs(this)">
                    <i class="icon-upload icon-white"></i>
                    {lang('Upload menus to server', 'admin')}
                </button>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <div id="workPlace" class="table-admin-menu">
                {if $menus['tariffs']}
                    <hr>
                    <div class="menuSelect">
                        <form method="GET">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label" for="Text">{lang('Tariff menu type','admin_menu')}:</label>
                                        <div class="controls">
                                            <select name="type" onchange="$(this).closest('form').submit();" style="width:300px">
                                                <option>--{echo lang('Select tariff menu type', 'admin_menu')}--</option>
                                                <option {if $_GET['type']=='billing'}selected="selected"{/if} value="billing">{echo lang('Billing menus', 'admin_menu')}</option>
                                                <option {if $_GET['type']=='store'}selected="selected"{/if} value="store">{echo lang('Store menus', 'admin_menu')}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="Text">{lang('Menu','admin_menu')}:</label>
                                        <div class="controls">
                                            <select multiple="multiple" id="menu_name" class="chosen" name="tariff_id[]" onchange="$(this).closest('form').submit();" style="width:300px">
                                                <option>--{echo lang('Select tariff menu', 'admin_menu')}--</option>
                                                {foreach $menus['tariffs'] as $tariff}
                                                    <option {if in_array($tariff->id, $_GET['tariff_id'])}selected="selected"{/if} value="{echo $tariff->id}">
                                                        {echo $tariff->i18n->name} ({echo $tariff->saasCountry->i18n->name})
                                                    </option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                {/if}
                <hr>
                <div class="full sortableBaseMenu">
                    <h4>{lang('Origin menu', 'admin_menu')}</h4>
                    {echo $menus['full']}
                </div>

                {foreach $menus['tariffs'] as $tariff}
                    <div class="tariff sortableMenu" tariff_id="{echo $tariff->id}" style="{if !in_array($tariff->id, $_GET['tariff_id'])}display: none{/if}">
                        <hr>
                        <h4>{echo $tariff->i18n->name} ({echo $tariff->saasCountry->i18n->name})</h4>
                        {echo $tariff->menu}
                    </div>
                {/foreach}
            </div>

        </div>
    </div>
</section>
