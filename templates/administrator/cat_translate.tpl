<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_cat_translate')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/categories/edit/{$orig_cat.id}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                    <button type="button" class="btn btn-small btn-success  action_on formSubmit" data-action="close" data-form="#save"><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                    <button type="button" class="btn btn-small action_on formSubmit" data-action="exit" data-form="#save"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>

					
                                <div class="dropdown d-i_b">
                                   {foreach $langs as $l}
									{if $lang == $l.id}
									<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                                        {$l.lang_name}
                                     <span class="caret"></span>
                                    </a>
									{/if}
									{/foreach}

                                    <ul class="dropdown-menu">
									{foreach $langs as $l}
									{if $l.id != $lang}
										{if $l.default}
										<li><a href="/admin/categories/edit/{$orig_cat.id}" class="pjax">{$l.lang_name}</a></li>
										{else:}
                                        <li><a href="/admin/categories/translate/{$orig_cat.id}/{$l.id}" class="pjax">{$l.lang_name}</a></li>
                                        {/if}
									{/if}
									{/foreach}
                                    </ul>
                                </div>
                </div>
            </div>                            
        </div>
        <form method="post" active="{$BASE_URL}admin/categories/translate/{$orig_cat.id}/{$lang}" id="save">
            <div class="content_big_td">
                
                <div class="tab-content">
                    <div class="tab-pane active">
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
                                        <div class="inside_padd span9">
                                            <div class="form-horizontal">
                                                <div class="row-fluid">
                                                    <div class="control-group">
                                                        <label class="control-label" for="name">{lang('a_name')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name" value="{$cat.name}"/>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
							                            <label class="control-label" for="Img">
							                            {lang('a_image')}:                            
							                            </label>
							                        	<div class="controls">
											    		<div class="group_icon pull-right">
														<button class="btn btn-small" onclick="elFinderPopup('image', 'Img');return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
                                                            </div>
                                                            <div class="o_h">
									                		    <input type="text" name="image" id="Img" value="{$cat.image}">				    
																</div>
											    		</div>
							                        </div>
                                                    
                                                    <div class="control-group">
                                                        <label class="control-label" for="short_desc">{lang('a_desc')}:</label>
                                                        <div class="controls">
                                                            <textarea class="elRTE" name="short_desc" id="short_desc" >{htmlspecialchars($cat.short_desc)}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="control-group"><label class="control-label" for="title">{lang('a_meta_title')}:</label>
                                                        <div class="controls">
                                                            <input type="text" name="title" value="{$cat.title}" id="title" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="description">{lang('a_meta_description')}:</label>
                                                        <div class="controls">
                                                            <textarea id="description"  name="description"  rows="10" cols="180" >{$cat.description}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group"><label class="control-label" for="keywords">{lang('a_meta_keywords')}:</label>
                                                        <div class="controls">
                                                            <textarea id="keywords" name="keywords" rows="10" cols="180" >{$cat.keywords}</textarea>
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
                </div>
            </div>
            </div>
    </section>
</div>
{form_csrf()}
</form>
<div id="elFinder"></div>