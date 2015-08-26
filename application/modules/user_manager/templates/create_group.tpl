<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Creating a group', 'user_manager')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/cp/user_manager#group" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Go back', 'user_manager')}</span></a>
                    <button type="button" class="btn btn-small btn-success action_on formSubmit" data-form="#create" data-action="close" data-submit><i class="icon-plus-sign icon-white"></i>{lang('Create', 'user_manager')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-form="#create" data-action="exit"><i class="icon-check"></i>{lang('Create and exit', 'user_manager')}</button>
                </div>
            </div>                            
        </div>


        <!----------------------------------------------------- CREATE GROUP-------------------------------------------------------------->
        <div class="tab-pane">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">
                            {lang('Group details', 'user_manager')}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <form id="create" method="post" active="{$BASE_URL}admin/components/cp/user_manager/create">
                                        <div class="control-group">
                                            <label class="control-label" for="alt_name">{lang('Name', 'user_manager')}</label>
                                            <div class="controls">
                                                <input type="text" name="alt_name" id="alt_name" required/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="name">{lang('Identifier', 'user_manager')}</label>
                                            <div class="controls">
                                                <input type="text" name="name" id="name" required/> 
                                                <span class="help-block">{lang('Only Latin characters', 'user_manager')}</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="desc">{lang('Description', 'user_manager')}</label>
                                            <div class="controls">
                                                <textarea id="desc" name="desc" ></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </section>
</div>