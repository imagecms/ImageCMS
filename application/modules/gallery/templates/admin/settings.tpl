<div class="top-navigation">
        <div style="float:left;">
            <ul>
            <li>
                <p>{lang('amt_settings')}</p>
            </li>
            </ul>
        </div>

        <div align="right" style="padding:5px;">
            <input type="button" class="button_silver_130" value="{lang('amt_cancel')}" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery/'); return false;"/>
        </div>
</div>
<div style="clear:both;"></div>

<form method="post" action="{site_url('admin/components/cp/gallery/settings/update')}" id="gallery_settings_form" style="width:100%;">
   		<div class="form_text"></div>
		<div class="form_input">
            <b>{lang('amt_albums_and_categories')}</b>
        </div>
		<div class="form_overflow"></div> 

        <div class="form_text">{lang('amt_to_sort')}:</div>
        <div class="form_input">
            <select name="order_by">
                <option value="date" {if $settings.order_by == "date"} selected="selected" {/if}>{lang('amt_by_date')}</option>    
                <option value="name" {if $settings.order_by == "name"} selected="selected" {/if}>{lang('amt_by_abc')}</option>    
                <option value="position" {if $settings.order_by == "position"} selected="selected" {/if}>{lang('amt_by_position')}</option> 
            </select>

            <select name="sort_order">
                <option value="desc" {if $settings.sort_order == "desc"} selected="selected" {/if}>{lang('amt_by_desc')}</option> 
                <option value="asc" {if $settings.sort_order == "asc"} selected="selected" {/if}>{lang('amt_by_asc')}</option>    
            </select>
        </div>
        <div class="form_overflow"></div> 

   		<div class="form_text"></div>
		<div class="form_input">
            <b>{lang('amt_images')}</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_max_file_size')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_file_size}" name="max_file_size" /> {lang('amt_in_mb')}
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_max_width')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_width}" name="max_width" /> px
        </div>
		<div class="form_overflow"></div> 


   		<div class="form_text">{lang('amt_max_height')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.max_height}" name="max_height" /> px
        </div>
		<div class="form_overflow"></div> 


   		<div class="form_text">{lang('amt_quality')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.quality}" name="quality" /> %
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_save_ratio')}</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio == TRUE}checked="checked"{/if}   name="maintain_ratio" /> {lang('amt_yes')}</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio == FALSE}checked="checked"{/if} name="maintain_ratio" /> {lang('amt_no')}</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">{lang('amt_cut_borders')}</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop == TRUE}checked="checked"{/if}   name="crop" /> {lang('amt_yes')}</label>
           	<label><input type="radio" value="0" {if $settings.crop == FALSE}checked="checked"{/if} name="crop" /> {lang('amt_no')}</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>{lang('amt_image_preview')}</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_width')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.prev_img_width}" name="prev_img_width" /> {lang('amt_px')}
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_width')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.prev_img_height}" name="prev_img_height" /> {lang('amt_px')}
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_save_ratio')}</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio_prev == TRUE}checked="checked"{/if}   name="maintain_ratio_prev" /> {lang('amt_yes')}</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio_prev == FALSE}checked="checked"{/if} name="maintain_ratio_prev" /> {lang('amt_no')}</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">{lang('amt_cut_borders')}</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop_prev == TRUE}checked="checked"{/if}   name="crop_prev" /> {lang('amt_yes')}</label>
           	<label><input type="radio" value="0" {if $settings.crop_prev == FALSE}checked="checked"{/if} name="crop_prev" /> {lang('amt_no')}</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>{lang('amt_image_icons')}</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_width')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.thumb_width}" name="thumb_width" /> {lang('amt_px')}
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_height')}</div>
		<div class="form_input">
            <input type="text" class="textbox_long" value="{$settings.thumb_height}" name="thumb_height" /> {lang('amt_px')}
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_save_ratio')}</div>
		<div class="form_input">
            <label><input type="radio" value="1" {if $settings.maintain_ratio_icon == TRUE}checked="checked"{/if} name="maintain_ratio_icon" /> {lang('amt_yes')}</label>
            <label><input type="radio" value="0" {if $settings.maintain_ratio_icon == FALSE}checked="checked"{/if} name="maintain_ratio_icon" /> {lang('amt_no')}</label>
        </div>
		<div class="form_overflow"></div> 

		<div class="form_text">{lang('amt_cut_borders')}</div>
		<div class="form_input">
           	<label><input type="radio" value="1" {if $settings.crop_icon == TRUE}checked="checked"{/if}   name="crop_icon" /> {lang('amt_yes')}</label>
           	<label><input type="radio" value="0" {if $settings.crop_icon == FALSE}checked="checked"{/if} name="crop_icon" /> {lang('amt_no')}</label>
       	</div>
		<div class="form_overflow"></div>	 


   		<div class="form_text"></div>
		<div class="form_input">
            <b>{lang('amt_water_mark')}</b>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_hor_align')}</div>
		<div class="form_input">
            <select name="wm_hor_alignment">
                <option {if $settings.wm_hor_alignment == 'left'}selected="selected"{/if} value="left">{lang('amt_left')}</option>
                <option {if $settings.wm_hor_alignment == 'center'}selected="selected"{/if} value="center">{lang('amt_center')}</option>
                <option {if $settings.wm_hor_alignment == 'right'}selected="selected"{/if} value="right">{lang('amt_right')}</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

   		<div class="form_text">{lang('amt_ver_align')}</div>
		<div class="form_input">
            <select name="wm_vrt_alignment">
                <option {if $settings.wm_vrt_alignment == 'top'}selected="selected"{/if} value="top">{lang('amt_top')}</option>
                <option {if $settings.wm_vrt_alignment == 'middle'}selected="selected"{/if} value="middle">{lang('amt_in_the_middle')}</option>
                <option {if $settings.wm_vrt_alignment == 'bottom'}selected="selected"{/if} value="bottom">{lang('amt_bottom')}</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

  		<div class="form_text">{lang('amt_type')}</div>
		<div class="form_input">
            <select name="watermark_type" onchange="show_watermark_block();" id="watermark_type">
                <option value="text"  {if $settings.watermark_type == 'text'}selected="selected"{/if}  >{lang('amt_text')}</option>
                <option value="overlay" {if $settings.watermark_type == 'overlay'}selected="selected"{/if} >{lang('amt_image')}</option>
            </select>
        </div>
		<div class="form_overflow"></div> 

        <!-- Image settings -->
        <div id="image_settings"  {if $settings.watermark_type == 'text'}style="display:none;"{/if} >
            <div class="form_text">{lang('amt_path_to_image')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_image}" name="watermark_image"/>
                <br/><span class="lite">{lang('amt_should_be_on_server')}: ./uploads/images/logo.png</span>            
            </div>
            <div class="form_overflow"></div> 
         
            <div class="form_text">{lang('amt_transparency')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_image_opacity}" name="watermark_image_opacity" /> %
                <br/><span class="lite">{lang('amt_select_value')}</span> 
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">{lang('amt_offset')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_padding}" name="watermark_padding" /> {lang('amt_px')}
            </div>
            <div class="form_overflow"></div> 
        </div>
        <!-- / image settings -->
        
        <div id="text_settings" {if $settings.watermark_type == 'overlay'}style="display:none;"{/if}>
            <div class="form_text">{lang('amt_text')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_text}" name="watermark_text" />
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">{lang('amt_font_size')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_font_size}" name="watermark_font_size" />
            </div>
            <div class="form_overflow"></div>
            
            <div class="form_text">{lang('amt_font_color')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_color}" name="watermark_color" />
            </div>
            <div class="form_overflow"></div>   

            <div class="form_text">{lang('amt_offset')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_padding}" name="watermark_padding" /> {lang('amt_px')}
            </div>
            <div class="form_overflow"></div> 

            <div class="form_text">{lang('amt_path_to_font')}</div>
            <div class="form_input">
                <input type="text" class="textbox_long" value="{$settings.watermark_font_path}" name="watermark_font_path" />
            </div>
            <div class="form_overflow"></div>
        </div>
               
   		<div class="form_text"></div>
		<div class="form_input">
            <input type="submit" name="button"  class="button_130" value="{lang('amt_save')}" onclick="ajax_me('gallery_settings_form');" /> 
            <a href="#" onclick="ajax_div('page', base_url + 'admin/components/cp/gallery'); return false;" style="padding:5px;">{lang('amt_cancel')}</a> 
        </div>
		<div class="form_overflow"></div> 
{form_csrf()}</form>

{literal}
    <script type="text/javascript">
        function show_watermark_block()
        {
            var type = $('watermark_type').value;

            if (type == 'text')
            {
                $('text_settings').setStyle('display', 'block');
                $('image_settings').setStyle('display', 'none');
            }else{
                $('text_settings').setStyle('display', 'none');
                $('image_settings').setStyle('display', 'block');
            }
        }
    </script>
{/literal}
