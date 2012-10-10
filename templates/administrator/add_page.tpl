<section class="mini-layout">
                
                    <div class="frame_title clearfix">
                        <div class="pull-left w-s_n">
                            <span class="help-inline"></span>
                            <span class="title w-s_n">Создание новой страницы</span>
                        </div>
                        <div class="pull-right">
                            <span class="help-inline"></span>
                            <div class="d-i_b">
                                <a href="/admin/pages/GetPagesByCategory" class="pjax t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">Вернуться</span></a>
                                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form" data-action="edit" ><i class="icon-ok"></i>Сохранить</button>
                                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form" data-action="close"><i class="icon-check"></i>Сохранить и выйти</button>
                            </div>
                        </div>                            
                    </div>  

					<div class="clearfix">
                            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                                <a href="#content_article" class="btn btn-small active">Содержание</a>
                                <a href="#parameters_article" class="btn btn-small ">Параметры</a>
                                <a href="#addfields_article" class="btn btn-small">Дополнительные поля</a>
                                <a href="#setings_article" class="btn btn-small">Настройки</a>
                            </div>
                        </div>             
<form method="post" action="{$BASE_URL}admin/pages/add" id="add_page_form" class="form-horizontal">
<div id="content_big_td" class="tab-content">                

<div class="tab-pane active" id="content_article">

<table class="table table-striped table-bordered table-hover table-condensed">

                                    <thead>
                                        <tr>
                                            <th colspan="6">
                                                Содержание
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td colspan="6">

<div class="inside_padd">
<div class="span9">

        <div class="control-group">
        <label class="control-label">
            {lang('a_category')}:
        </label>
        	<div class="controls">
            	<select name="category" id="category_selectbox">
                <option value="0" selected="selected">{lang('a_no')}</option>
                { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['sel_cat'])); }
                </select> 
                <img  src="{$THEME}/images/plus2.png" style="padding-left:5px;padding-top:2px;cursor:pointer;float:left;" title="{lang('a_create_cat')}" />
        	</div>
        </div>


        <div class="control-group">
        <label class="control-label">
		{lang('a_title')}:
        </label>
        	<div class="controls">
			<input type="text" name="page_title" value="" id="page_title_u" class="textbox_long required" />
        	</div>
        </div>

		<div class="control-group">
        <label class="control-label">
		{lang('a_prev_cont')}:
        </label>
        	<div class="controls">
			<textarea id="prev_text" class="mceEditor required" name="prev_text" rows="10" cols="180" ></textarea>
        	</div>
        </div>
 
		<div class="control-group">
        <label class="control-label">
		{lang('a_full_cont')}:
        </label>
        	<div class="controls">
			<textarea id="full_text" class="mceEditor" name="full_text" rows="10" cols="180" ></textarea>
        	</div>
        </div>

		</div>
		</div>
		</td>
		</tr>
		</tbody>
		</table>
    </div>
    
    <div class="tab-pane" id="parameters_article">
    
    
    
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
                <div class="span9">

                        <div class="control-group">
                            <label class="control-label">
                    		{lang('a_url')}:
                            </label>
                        	<div class="controls">
                			<input type="text" name="page_url" value="" id="page_url" class="textbox_long" /> 
                			 	<img onclick="translite_title('#page_title_u', '#page_url');" align="absmiddle" style="cursor:pointer" src="{$THEME}/images/translit.png" width="16" height="16" title="{lang('a_trans_title')}." /> 
        						<div class="lite">({lang('a_just_lat')})</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_tags')}:
                            </label>
                        	<div class="controls">
                        	<input type="text" name="search_tags" value="" id="tags" class="textbox_long" />
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_meta_title')}:
                            </label>
                        	<div class="controls">
                        	<input type="text" name="meta_title" value=""  class="textbox_long" />
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_meta_description')}:
                            </label>
                        	<div class="controls">
                        	<textarea name="page_description" class="textarea" id="page_description" rows="8" cols="28"></textarea>
							<img onclick="create_description('#prev_text', '#page_description' );" src="{$THEME}/images/arrow-down.png" title="{lang('a_gen_desc')}" style="cursor:pointer" width="16" height="16" />
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_meta_keywords')}:
                            </label>
                        	<div class="controls">
                        	<textarea name="page_keywords" id="page_keywords" rows="8" class="textarea" cols="28"></textarea>
							<img src="{$THEME}/images/arrow-down.png" style="cursor:pointer" title="{lang('a_gen_key_words')}" onclick="retrive_keywords('#prev_text', '#keywords_list' );" />
				
							<div style="max-width:600px" id="keywords_list">
				
							</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_main_tpl')}:
                            </label>
                        	<div class="controls">
                        	<input type="text" name="main_tpl" value="" class="textbox_long" /> .tpl
							<div class="lite">{lang('a_by_default')}  main.tpl</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                            {lang('a_page_tpl')}:
                            </label>
                        	<div class="controls">
                        	<input type="text" name="full_tpl" value="" class="textbox_long" /> .tpl
							<div class="lite">{lang('a_by_default')}  page_full.tpl</div>
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
                             {lang('a_comm_alow')}
                            </label>
                        	<div class="controls">
							<input name="comments_status"  value="1" checked="checked" type="checkbox" id="comments_status" />                        	
                        	</div>
                        </div>

                </div>
            </div>

    	</td>
	</tr>
	</tbody>
</table>

	
	</div>

	<div class="tab-pane" id="addfields_article">
		{($hook = get_hook('admin_tpl_add_page')) ? eval($hook) : NULL;}
	</div>

<div class="tab-pane" id="setings_article">

<table class="table table-striped table-bordered table-hover table-condensed">

    <thead>
        <tr>
            <th colspan="6">
			{lang('a_sett')}
            </th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">

            <div class="inside_padd">
                <div class="span9">

                        <div class="control-group">
                            <label class="control-label">
                    		{lang('a_pub_stat')}:
                            </label>
                        	<div class="controls">
                			 <select name="post_status" id="post_status">
								<option selected="selected" value="publish">{lang('a_published')}</option>
								<option value="pending">{lang('a_wait_approve')}</option>
								<option value="draft">{lang('a_not_publ')}</option>
							</select>
                        	</div>
                        </div>
                        
                        <hr />
                        
                        <div class="control-group">
                            <label class="control-label">
                        	{lang('a_date_and_time_cr')}:    
                            </label>
                        	<div class="controls">
           					<input id="create_date" name="create_date" tabindex="7" value="{$cur_date}" type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small"  />
           					<i class="icon-calendar"></i>
							<input id="create_time" name="create_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />			             	
                        	</div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">
           					{lang('a_date_and_time_p')}:                 
                            </label>
                        	<div class="controls">
            				<input id="publish_date" name="publish_date" tabindex="7" value="{$cur_date}" type="text" data-placement="top" data-original-title="выберите дату" data-rel="tooltip" class="datepicker input-small" />
            				<i class="icon-calendar"></i>
							<input id="publish_time" name="publish_time" tabindex="8" type="text" value="{$cur_time}" class="input-small" />            	
                        	</div>
                        </div>

						<div class="control-group">
                            <label class="control-label">
               				{lang('a_access')}:             
                            </label>
                        	<div class="controls">
                			<select multiple="multiple" name="roles[]">
								<option value="0">{lang('a_all')}</option>
								{foreach $roles as $role}
								  <option value ="{$role.id}">{$role.alt_name}</option>
								{/foreach}
							</select>        	
            	           	</div>
                        </div>
                        
                        
                        {($hook = get_hook('admin_tpl_add_page_side_bar')) ? eval($hook) : NULL;}
                        
                </div>
            </div>

    	</td>
	</tr>
	</tbody>
</table>

		</div>
	</div>

{form_csrf()}
</form>


</section>
