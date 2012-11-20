<section class="mini-layout">               
                    <div class="frame_title clearfix">
                        <div class="w-s_n-w pull-left">
                            <span class="help-inline"></span>
                            <span class="title w-s_n">{lang('amt_create_department')}</span>
                        </div>

                        <div class="pull-right">
                            <span class="help-inline"></span>
                            <div class="d-i_b">
                                <a href="/admin/components/init_window/user_support/departments" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#save_form"><i class="icon-ok"></i> {lang('a_save')}</button>
                                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save_form"><i class="icon-check"></i> {lang('a_save_and_exit')}</button>
                            </div>
                        </div>                            
                    </div>             
    <div id="content_big_td" >                
	
   <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">
                {lang('a_info')}
            </th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd">
                <div class="span12">
                    <form action="/admin/components/cp/user_support/create_department" method="post" id="save_form" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">{lang('amt_tname')}:</label>
                        	<div class="controls">
                                    <input type="text" name="name" value="" class="required" /> 
                        	</div>
                        </div>
                        {form_csrf()}
                    </form>
                </div>
            </div>

    	</td>
	</tr>
	</tbody>
    </table>    
        
    </div>
</section>
