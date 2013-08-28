<!-- ---------------------------------------------------Delete иlock---------------------------------------------------- -->  

<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang("Removing subscribers")}</h3>
    </div>
    <div class="modal-body">
        <p>{lang("Delete all checked?")}</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('{$BASE_URL}admin/components/cp/mailer/deleteUsers')" >{lang("Delete")}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel")}</a>
    </div>
</div>


<div id="delete_dialog" title="{lang("Removing brand")}" style="display: none">
    {lang("Remove brands?")}
</div>
<!-- ---------------------------------------------------Delete block---------------------------------------------------- -->
<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang("Subscription and Notification letters")}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">

                    <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back")}</span></a>
                    <button type="button" class="btn btn-small formSubmit" data-form="#send" ><i class="icon-list-alt"></i>{lang("Send a letter")}</button>
                    <button type="button" class="btn btn-small btn-danger disabled action_on" onclick="delete_function.deleteFunction()" id="del_sel_brand"><i class="icon-trash icon-white"></i>{lang("Delete")}</button>
                </div>
            </div>                            
        </div>
        <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
            <a href="#mail" class="btn btn-small active">{lang("Message parameters")}</a>
            <a href="#user" class="btn btn-small">{lang("Subscribers")}</a>
        </div>        
        <div class="tab-content">
            <!-----------------------------------------------------SETTINGS MAIL-------------------------------------------------------------->
            <div class="tab-pane active" id="mail">
                <table class="table table-striped table-bordered table-hover table-condensed">
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
                                    <div class="form-horizontal">
                                        <div class="row-fluid">
                                            <form id="send" method="post" action="{$BASE_URL}admin/components/cp/mailer/send_email">


                                                <div class="control-group">
                                                    <label class="control-label" for="subject">{lang("Theme")}</label>
                                                    <div class="controls">
                                                        <input type="text" name="subject" id="subject" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="name">{lang("Your name")}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name" id="name" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">{lang("Your e-mail")}</label>
                                                    <div class="controls">
                                                        <input type="text" name="email" id="email" value="{$admin_mail}"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="message">{lang("Message")}</label>
                                                    <div class="controls">
                                                        <textarea name="message" id="message" class="elRTE">
                                                            {lang("Hello")}.






--------------------------------
                                                            {lang("best regards, administration")} {$site_settings.site_title}

                                                            {site_url()}

                                                        </textarea> 
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="mailtype">{lang("Formatting")}</label>
                                                    <div class="controls">
                                                        <select name="mailtype" id="mailtype">
                                                            <option value="html" selected="selected">{lang("HTML")}</option>
                                                            <option value="text">{lang("Plain Text")}</option>
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
                                <th class="span1">{lang("ID")}</th>
                                <th class="span3">{lang("E-mail")}</th>
                                <th class="span3">{lang("Date")}</th>
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
                        {lang("Subscribers list is empty")}
                    </div>
                {/if}
            </div>

    </section>
</div>
