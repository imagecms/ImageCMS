<section class="mini-layout">
    
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Создания баннера</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/banners" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#image_upload_form" data-submit><i class="icon-ok icon-white"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#image_upload_form" data-action="tomain"><i class="icon-check"></i>{lang('a_footer_save_exit')}</button>

            </div>
        </div>                            
    </div>
    <form method="post" action="/admin/components/init_window/banners/create" enctype="multipart/form-data" id="image_upload_form">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
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
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="span9">
                                    <div class="control-group">
                                        <label class="control-label" for="Name">{lang('a_name')} {$translatable}:</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="Name" value="" />
                                        </div>
                                        <div class="controls">
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="active" value="1" >
                                                </span>
                                                {lang('a_active')}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="Text">{lang('a_s_banner_text_create_b')} {$translatable}:</label>
                                    <div class="controls">
                                        <textarea name="description" id="Text" class="elRTE" ></textarea> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Url"> {lang('a_url')} {$translatable}:</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="Url" value=""/>
                                    </div>
                                </div>




                                <div class="control-group">
                                    <label class="control-label" for="data">Вибраные обекти:</label>
                                    <div class="controls">
                                        <select id="data" name="data[]" multiple="multiple" style="height:500px; max-width: 500px !important" >


                                        </select> 
                                        <span class="help-block">Для удаления двойной клик мыши</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="banner_type">Отображать в категориях (выберите объекты):</label>
                                    <div class="controls">
                                        <select id="banner_type" name="" onchange="autosearch(this, '/admin/components/init_window/banners/autosearch', '#autodrop', 'autodrop')">
                                            <option value="default">--выберите сущность--</option>
                                            <option value="main">Главная</option>
                                            {if $is_shop}
                                                <option value="product">Продукты</option>                                           
                                                <option value="shop_category">Категории продуктов</option>
                                                <option value="brand">Бренды</option>
                                            {/if}
                                            <option value="category">Категории страниц</option>
                                            <option value="page">Страницы</option>


                                        </select>
                                        <div id="autodrop">
                                        </div>

                                    </div>
                                </div>




                                <div class="control-group">
                                    <label class="control-label">{lang('a_active_to')}:</label>
                                    <div class="controls">
                                        <input class="datepicker" type="text" value="" name="active_to" />
                                    </div>
                                </div>    

                                <div class="control-group">
                                    <label class="control-label" for="Img">
                                        {lang('a_image')}:
                                    </label>
                                    <div class="controls">
                                        <div class="group_icon pull-right">            
                                            <button class="btn btn-small" onclick="elFinderPopup('image', 'Img');
                                                return false;"><i class="icon-picture"></i>  {lang('a_select_image')}</button>
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