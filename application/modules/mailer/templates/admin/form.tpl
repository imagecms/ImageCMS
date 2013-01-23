<!-- ---------------------------------------------------Delete иlock---------------------------------------------------- -->  

<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('a_base_mailer_del_user_1')}</h3>
    </div>
    <div class="modal-body">
        <p>{lang('a_base_mailer_del_user_2')}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/components/cp/mailer/deleteUsers')" >{lang('a_delete')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
    </div>
</div>


<div id="delete_dialog" title="{lang('a_s_brand_del_1')}" style="display: none">
    {lang('a_s_brand_del_3')}
</div>
<!-- ---------------------------------------------------Delete block---------------------------------------------------- -->
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_sub_notif_later')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                    <button type="button" class="btn btn-small formSubmit" data-form="#send" ><i class="icon-list-alt"></i>{lang('a_mailer_send_mail')}</button>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_brand"><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                </div>
            </div>                            
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#mail" class="btn btn-small active">{lang('a_settings_mail')}</a>
            <a href="#user" class="btn btn-small">{lang('a_subscri_mail')}</a>
        </div>        
        <div class="tab-content">
            <!-----------------------------------------------------SETTINGS MAIL-------------------------------------------------------------->
            <div class="tab-pane active" id="mail">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th colspan="6">
                                {lang('a_param')}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">
                                <div class="inside_padd">
                                    <div class="form-horizontal">
                                        <div class="row-fluid">
                                            <form id="send" method="post" action="{$BASE_URL}admin/components/cp/mailer/send_email">


                                                <div class="control-group">
                                                    <label class="control-label" for="subject">{lang('amt_theme')}</label>
                                                    <div class="controls">
                                                        <input type="text" name="subject" id="subject" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="name">{lang('amt_your_name')}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" id="name" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">{lang('amt_your_email')}</label>
                                                    <div class="controls">
                                                        <input type="text" name="email" id="email" value="{$admin_mail}"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="message">{lang('amt_message')}</label>
                                                    <div class="controls">
                                                        <textarea name="message" id="message" class="elRTE">
                                                            {lang('amt_hello')}.






--------------------------------
                                                            {lang('amt_best_regards')} {$site_settings.site_title}

                                                            {site_url()}

                                                        </textarea> 
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="mailtype">{lang('amt_format')}</label>
                                                    <div class="controls">
                                                        <select name="mailtype" id="mailtype">
                                                            <option value="html" selected="selected">{lang('amt_html')}</option>
                                                            <option value="text">{lang('amt_plain_text')}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> 
            </div>

            <!-----------------------------------------------------USER-------------------------------------------------------------->
            <div class="tab-pane" id="user">
                {if count($all) > 0}
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="t-a_c span1">
                                    <span class="frame_label">
                                        <span class="niceCheck b_n">
                                            <input type="checkbox"/>
                                        </span>
                                    </span>
                                </th>
                                <th class="span1">{lang('amt_id')}</th>
                                <th class="span3">{lang('a_email')}</th>
                                <th class="span3">{lang('a_date')}</th>
                            </tr>                        
                        </thead>
                        <tbody class="sortable">
                            {foreach $all as $u}
                                <tr>
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox"  value="{echo $u['id']}" name="ids"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td><p>{echo $u['id']}</p></td>
                                    <td>{echo $u['email']}</td>                            
                                    <td>{echo date("d-m-Y H:i:s",$u['date'])}</td>

                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                {else:}
                    <div class="alert alert-info" style="margin-top: 19px;">
                        {lang('a_mailer_user_empty')}
                    </div>
                {/if}
            </div>

    </section>
</div>
