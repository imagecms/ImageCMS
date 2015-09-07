<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title"><i class="fa fa-map-signs"></i> MOD ADVICE</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>    

                    {if $countOldImages}
                        <button class="btn btn-small btn-primary" onclick="senToDel()" type="button" style="background-color: #F76D6D">
                            <i class="icon-ok icon-white"></i>{lang('Delete unused pictures', 'mod_advice')} {$countOldImages}
                        </button>
                    {else:}
                        <button class="btn btn-small btn-primary"  type="button" style="background-color: #0b9213">
                            <i class="icon-ok icon-white"></i>{lang('Nothing to delete', 'mod_advice')} 
                        </button>
                    {/if}

                    {/*<button class="btn btn-small btn-primary formSubmit" data-form="#tokenForm" type="button" >
                        <i class="icon-ok icon-white"></i>{lang('Save changes', 'mod_advice')}
                    </button>*/}
                </div>
            </div>
        </div>

        {/*      <div class="tab-pane">
            <form id="tokenForm" action="{echo site_url($CI->uri->uri_string() . '/save')}" method="post">
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th colspan="6">
        {lang('Data','admin')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd span9">
                                    <div class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label" for="groupId">{lang('Group Id','mod_advice')}:  <span class="must">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="groupId" {if $groupId}value="{$groupId}"{/if} placeholder="Group Id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>*/}
    </section>
</div>
