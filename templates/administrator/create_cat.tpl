<div class="container">       
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_create_cat')}</span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">                        
                    <a href="/admin/categories/cat_list" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                    <button type="button" class="btn btn-small action_on btn-success  formSubmit" data-action="edit" data-form="#save"><i class="icon-ok icon-white"></i>{lang('a_create_cat')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#save"><i class="icon-check"></i>{lang('a_cre_exit_form')}</button>                   
                </div>
            </div>                            
        </div>
        <div class="content_big_td">
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#parameters" class="btn btn-small active">{lang('param')}</a>
                    <a href="#metatag" class="btn btn-small">{lang('a_meta_tags')}</a>
                </div>                    
            </div>
            <form method="post" id="save" action="{$BASE_URL}admin/categories/create/new" >
                <div class="tab-content">
                    <div class="tab-pane active" id="parameters">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('param')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">

                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="name">{lang('a_name')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name">
                                                        </div>
                                                    </div>      

                                                    <div class="control-group">
                                                        <label class="control-label" for="url">{lang('a_url')}:</label>

                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <div class="">                                                                           
                                                                    <button onclick="transhelp-block_title('#name', '#url');" type="button" class="btn btn-small" id="translateCategoryTitle"><i class="icon-refresh"></i>&nbsp;&nbsp;{lang('a_auto_fit_by_url')}</button>
                                                                </div>
                                                            </div>


                                                            <div class="o_h">
                                                                <input type="text" name="url" id="url">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="parent_id">{lang('a_parent')}:</label>
                                                        <div class="controls">
                                                            <select id="parent_id" name="parent_id">
                                                                <option value="0" selected="selected">{lang('a_no')}</option>
                                                                { $this->view("cats_select.tpl", $this->template_vars); }
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="category_field_group">{lang('a_fields_group')}:</label>
                                                        <div class="controls">
                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="category_field_group" id="category_field_group">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $category_field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>

                                                            <p class="help-block">{lang('a_sel_gr_fld_f_subcats')}.</p>
                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="category_apply_for_subcats" /> 
                                                                    </span>
                                                                    <span class="help-block">{lang('a_apply_for_subcats')}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="field_group">{lang('a_pages_fields_group')}:</label>
                                                        <div class="controls">
                                                            {$f_groups = $this->CI->load->module('cfcm/cfcm_forms')->prepare_groups_select()}
                                                            <select name="field_group" id="field_group">
                                                                <option value="-1">{lang('a_no')}</option>
                                                                {foreach $f_groups as $k => $v}
                                                                    <option value="{$k}" {if $k == $field_group} selected="selected" {/if}>{$v}</option>
                                                                {/foreach}
                                                            </select>
                                                            <span class="help-block">{lang('a_select_fields_group')}.</span>
                                                            <div class="group_icon help-block">
                                                                <span class="frame_label no_connection">
                                                                    <span class="niceCheck b_n">
                                                                        <input type="checkbox" value="1" name="apply_for_subcats" /> 
                                                                    </span>
                                                                    <span class="help-block">{lang('a_apply_for_subcats')}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                     <!--                                
													<div class="control-group">
                                                        <label class="control-label" for="inputImg">{lang('a_image')}:</label>
                                                        <div class="controls">
                                                            <div>
                                                                <span class="f_l span8">
                                                                    <input type="text" disabled="disabled" name="image" id="cat_image" value="{$image}" />
                                                                </span>
                                                                <span class="btn btn-small p_r">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;{lang('a_select_image')}
                                                                    <input type="file" class="btn-small btn" id="inputImg" onclick="tinyBrowserPopUp('image', 'cat_image');"/>
                                                                </span>
                                                            </div>
                                                            <p class="help-block span8">
                                                                <img src="img/temp/50X50.png" class="img-polaroid pull-right m-l_15">                                                                
                                                            </p>
                                                        </div>
                                                    </div>
                           -->                          
                                                    <div class="control-group">
							                            <label class="control-label" for="field_fdggggg">
							                            {lang('a_image')}:                            
							                            </label>
							                        	<div class="controls">
											    		<div class="group_icon pull-right">
														<button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                            </div>
                                                            <div class="o_h">
									                		    <input type="text" name="image" id="Img">				    
																</div>
											    		</div>
							                        </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="position">{lang('a_position')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="position" value="0"  id="position" />
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="short_desc">{lang('a_desc')}:</label>
                                                        <div class="controls">
                                                            <textarea name="short_desc" id="short_desc" class="elRTE"></textarea>
                                                        </div>
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_page_view')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="order_by">{lang('a_sort')}:</label>
                                                        <div class="controls">
                                                            <div class="pull-left span6">
                                                                <select name="order_by" id="order_by">
                                                                    <option value="publish_date" selected="selected">{lang('a_by_date')}</option>    
                                                                    <option value="title">{lang('a_by_abc')}</option>    
                                                                    <option value="position">{lang('a_by_pos')}</option>    
                                                                </select>
                                                            </div>
                                                            <div class="pull-left span6">
                                                                <select name="sort_order">
                                                                    <option value="desc" selected="selected">{lang('a_desc_order')}</option> 
                                                                    <option value="asc">{lang('a_asc_order')}</option>    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="per_page">{lang('a_records_count')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="per_page" value="15" id="per_page"/> 
                                                            <div class="frame_label no_connection m-t_10">
                                                                <span class="niceCheck b_n">
                                                                    <input type="checkbox" name="comments_default" value="1" />
                                                                </span>
                                                                <span class="help-block">{lang('a_comm_by_def')}</sapn>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="fetch_pages">{lang('a_disp_pages_f_other_cats')}:</label>
                                                        <div class="controls">

                                                            <div class="o_h">
                                                                <select name="fetch_pages[]"  multiple="multiple" size="5" id="fetch_pages">
                                                                    {foreach $include_cats as $c}
                                                                        <option value="{$c.id}"> {for $i=0; $i < $c.level;$i++}-{/for} {$c.name}</option>
                                                                    {/foreach}
                                                                </select>

                                                            </div>
                                                        </div></div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="main_tpl">{lang('a_main_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="main_tpl" value=""  id="main_tpl" />                                                                              </div>
                                                            <span class="help-block">{lang('a_main_tpl_by_def')}  main.tpl</span>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="tpl">{lang('a_cat_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="tpl" value="" id="tpl" /> 

                                                            </div>
                                                            <span class="help-block">{lang('a_main_cat_tpl_by_def')}  category.tpl</sapn>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="page_tp">{lang('a_pages_tpl')}:</label>
                                                        <div class="controls">
                                                            <div class="group_icon pull-right">
                                                                <span class="help-inline">.tpl</span>
                                                            </div>
                                                            <div class="o_h">
                                                                <input type="text" name="page_tpl" value="" id="page_tp" />                                                           
                                                            </div>
                                                            <span class="help-block">{lang('a_pages_view_tpl_by_def')} page_full.tpl</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="metatag">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        {lang('a_meta_tags')}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div class="inside_padd span12">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="title">{lang('a_meta_title')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="title" value="" id="title" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="descriptions">{lang('a_meta_description')}:</label>
                                                        <div class="controls">
                                                            <textarea id="descriptions"  name="description" rows="10" cols="180" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="keywordss">{lang('a_meta_keywords')}:</label>
                                                        <div class="controls">
                                                            <textarea id="keywordss" name="keywords" rows="10" cols="180" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>   
                    {($hook = get_hook('admin_tpl_create_category')) ? eval($hook) : NULL;}
                    {form_csrf()}
            </form>
            <div class="tab-pane">

            </div>
        </div>
</div>
</section>
</div>
<div id="elFinder"></div>