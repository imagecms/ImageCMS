<section class="mini-layout">

    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Banner creating', 'banners')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/banners" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'banners')}</span></a>
                <button onclick="selects()" type="button" class="btn btn-small btn-primary formSubmit" data-form="#image_upload_form" data-submit><i class="icon-ok icon-white"></i>{lang('Save', 'banners')}</button>
            </div>
        </div>                            
    </div>
    <form method="post" action="/admin/components/init_window/banners/create" enctype="multipart/form-data" id="image_upload_form">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Options', 'banners')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="span9">
                                    <div class="control-group">
                                        <label class="control-label" for="Name">{lang('Name', 'banners')} {$translatable}:</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="Name" value="" />
                                        </div>
                                        <div class="controls">
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="active" value="1" >
                                                </span>
                                                {lang('Active', 'banners')}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Text">{lang('Text banner', 'banners')} {$translatable}:</label>
                                    <div class="controls">
                                        <textarea name="description" id="Text" class="elRTE" ></textarea> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Url"> {lang('URL', 'banners')} {$translatable}:</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="Url" value=""/>
                                    </div>
                                </div>




                                <div class="control-group">
                                    <label class="control-label" for="data">{lang('Selected items', 'banners')}:</label>
                                    <div class="controls">
                                        <select id="data" name="data[]" multiple="multiple" style="height:500px; max-width: 500px !important" >


                                        </select> 
                                        <span class="help-block">{lang('Double click to deleting', 'banners')}</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="banner_type">{lang('Show in categories (select items)', 'banners')}:</label>
                                    <div class="controls">
                                        <select id="banner_type" name="" onchange="autosearch(this, '/admin/components/init_window/banners/autosearch', '#autodrop', 'autodrop')">
                                            <option value="default">--{lang('select essence', 'banners')}--</option>
                                            <option value="main">{lang('Main', 'banners')}</option>
                                            {if $is_shop}
                                                <option value="product">{lang('Product', 'banners')}</option>                                           
                                                <option value="shop_category">{lang('Product category', 'banners')}</option>
                                                <option value="brand">{lang('Brand', 'banners')}</option>
                                            {/if}
                                            <option value="category">{lang('Pages categories', 'banners')}</option>
                                            <option value="page">{lang('Pages', 'banners')}</option>


                                        </select>
                                        <div id="autodrop" ">
                                        </div>

                                    </div>
                                </div>




                                <div class="control-group">
                                    <label class="control-label">{lang('Active until', 'banners')}:</label>
                                    <div class="controls">
                                        <input class="datepicker" type="text" value="" name="active_to" />
                                    </div>
                                </div>    

                                <div class="control-group">
                                    <label class="control-label" for="Img">
                                        {lang('Image', 'banners')}:
                                    </label>
                                    <div class="controls">
                                        <div class="group_icon pull-right">            
                                            <button type="button" class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                        return false;">
                                                <i class="icon-picture"></i>
                                                {lang('Choose an image ', 'banners')}
                                            </button>
                                        </div>
                                        <div class="o_h">		            
                                            <input type="text" name="photo" id="Img" value="">					
                                        </div>
                                        <div id="Img-preview" style="width: 400px;" >



                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </td>
                </tr>
            </tbody>
        </table>                               
    </form>
    <div id="elFinder"></div>
</section>