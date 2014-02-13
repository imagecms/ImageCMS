

<div class="inside_padd">
    <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
        <thead>
        <th class="span1">{lang('Settings', 'template_manager')}</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form method="post">
                        {foreach $templates as $tpl}
                            <div class="row-fluid">
                                <div class="control-group span1">
                                    <div class="controls"> 
                                        <input type="radio" name="template_name" value="">
                                    </div>
                                </div>        
                                <div class="control-group span5">
                                    <div class="controls"> 
                                        <img id="logo" src="{echo $tpl->mainImage}" />
                                    </div>
                                </div>        
                                <div class="control-group span6">
                                    <div class="controls"> 
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                        <p><b>sdfs:</b> fsdfsdfsd</p>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        {/foreach}

                        <button type="submit" class="pull-right btn btn-small btn-primary"><i class="icon-ok icon-white"></i>{lang('Save', 'template_manager')}</button>
                            {form_csrf()}
                    </form>

                </td>
            </tr>
        </tbody>
    </table>

</div>





