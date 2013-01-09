<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title"><?php echo lang ('a_cre_product_i9'); ?></span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <!-- $_SESSION['ref_url'] is session variable to save filter results to go back to it -->
                <a href="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>search/index<?php echo $_SESSION['ref_url']; ?>" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u"><?php echo lang ('a_back'); ?></span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#image_upload_form"><i class="icon-ok"></i><?php echo lang ('a_footer_save'); ?></button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#image_upload_form" data-action="close"><i class="icon-check"></i><?php echo lang ('a_footer_save_exit'); ?></button>
            </div>
        </div>                            
    </div>
    <form  action="<?php if(isset($ADMIN_URL)){ echo $ADMIN_URL; } ?>products/create" method="post" enctype="multipart/form-data"  id="image_upload_form">
        <div class="content_big_td">
            <div class="clearfix">
                <div class="btn-group myTab m-t_10 pull-left" data-toggle="buttons-radio">
                    <a href="#parameters" class="btn btn-small active"><?php echo lang ('a_product'); ?></a>
                    <!--<a href="#parameters_article" class="btn btn-small"><?php echo lang ('a_properties'); ?></a>-->
                    <!--<a href="#additionalPics" class="btn btn-small"><?php echo lang ('a_images'); ?></a>
                    <a href="#kits" class="btn btn-small"><?php echo lang ('a_item_kits'); ?></a>-->
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="parameters">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <?php echo lang ('a_info'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="form-horizontal">
                                            <div data-frame>
                                                <div class="control-group">
                                                    <label class="control-label" for="Name"><?php echo $translatable?> <?php echo lang ('a_product_name'); ?>:</label>
                                                    <div class="controls">
                                                        <input type="text" id="Name" name="Name" value="" class="required">
                                                    </div>
                                                </div>
                                                <table class="table table-bordered t-l_a">
                                                    <thead>
                                                        <tr>
                                                            <th width="17px"></th>
                                                            <th><?php echo $translatable_w?> <?php echo lang ('a_variant_name'); ?></th>
                                                            <th><?php echo ShopCore::encode($model->getLabel('Price'))?> <span class="required">*</span></th>
                                                            <?php if(count($currencies)>0): ?>
                                                                <th><?php echo lang ('a_currency'); ?></th>
                                                            <?php endif; ?>
                                                            <th><?php echo ShopCore::encode($model->getLabel('Number'))?></th>
                                                            <th><?php echo ShopCore::encode($model->getLabel('Stock'))?></th>
                                                            <th><?php echo ShopCore::encode($model->getLabel('ERP'))?></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th> 
                                                        </tr>
                                                        <tr class="head_body">
                                                        </tr>
                                                    </thead>
                                                    <tbody class="sortable" id="variantHolder">
                                                        <tr id="ProductVariantRow_0">
                                                            <td><img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/drag_arrow.png" class="drager" /></td>
                                                            <td>
                                                                <input type="hidden" name="variants[RandomId][]"  class="random_id" value="45456465"/>                                                                  
                                                                <input type="text" name="variants[Name][]" value=""/>
                                                            </td>
                                                            <td><input type="text" name="variants[PriceInMain][]" value="" class="required"/></td>
                                                                <?php if(count($currencies)>0): ?>
                                                                <td>
                                                                    <select name="variants[currency][]">
                                                                        <?php if(is_true_array($currencies)){ foreach ($currencies as $c){ ?>
                                                                            <option value="<?php echo $c->getId()?>"><?php echo $c->getCode()?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                                </td>
                                                            <?php endif; ?>
                                                            <td><input type="text" name="variants[Number][]" value="" class="textbox_short" /></td>
                                                            <td><input type="text" name="variants[Stock][]" value="" class="textbox_short" /></td>
                                                            <td><input type="text" name="variants[ERP][]" value="" class="textbox_short" /></td>
                                                            <td class="variantImage">

                                                                <button class="btn btn-small delete_image" type="button" data-title="<?php echo lang ('a_delete'); ?>">
                                                                    <i class="icon-remove"></i>
                                                                </button>
                                                                <div class="control-group">
                                                                    <label class="control-label" style="display: none;">
                                                                        <span class="btn btn-small p_r" data-url="file" >
                                                                            <i class="icon-camera"></i>
                                                                            <input type="file" name="variants[mainPhoto][45456465]" title="<?php echo lang ('a_general_image'); ?>"/>
                                                                            <!--<input type="hidden" name="variants[MainImageForDel][]" value="0"/>    -->
                                                                        </span>
                                                                    </label>
                                                                    <div class="controls">
                                                                        <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="variantImage">
                                                                <button class="btn btn-small delete_image" type="button" data-title="<?php echo lang ('a_delete'); ?>">
                                                                    <i class="icon-remove"></i>
                                                                </button>
                                                                <div class="control-group">
                                                                    <label class="control-label" style="display: none;">
                                                                        <span class="btn btn-small p_r" data-url="file">
                                                                            <i class="icon-camera"></i>
                                                                            <input type="file" name="variants[smallPhoto][45456465]" title="<?php echo lang ('a_general_image'); ?>"/>
                                                                            <!--<input type="hidden" name="variants[SmallImageForDel][]" value="0"/>    -->
                                                                        </span>
                                                                    </label>
                                                                    <div class="controls">
                                                                        <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php if($i>0): ?>
                                                                    <button class="btn my_btn_s btn-small" type="button" data-remove data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>"><i class="icon-remove"></i></button>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $i++?>
                                                    </tbody>
                                                </table>
                                                <button class="btn my_btn_s btn-small d_n" type="button" data-remove="example" data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>"><i class="icon-remove"></i></button>
                                                <div class="clearfix">
                                                    <!--<button type="button" class="pull-right btn btn-small btn-success" data-rel="add_new_clone" href=""><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_add_variant'); ?></button>-->
                                                    <button type="button" class="pull-right btn btn-small btn-success" id="addVariant"><i class="icon-plus-sign icon-white"></i><?php echo lang ('a_add_variant'); ?></button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <span class="frame_label no_connection">
                                                        <span class="niceCheck" style="background-position: -46px 0px; ">
                                                            <input type="checkbox" name="Active" value="1" checked="checked">
                                                        </span>
                                                        <?php echo lang ('a_active'); ?>
                                                    </span>
                                                    <span class="frame_label no_connection m-l_15">
                                                        <span class="niceCheck" style="background-position: -46px 0px; ">
                                                            <input type="checkbox" name="Hit" value="1">
                                                        </span>
                                                        <?php echo lang ('a_hit'); ?>
                                                    </span>
                                                    <span class="frame_label no_connection m-l_15">
                                                        <span class="niceCheck" style="background-position: -46px 0px; ">
                                                            <input type="checkbox" name="Hot" value="1">
                                                        </span>
                                                        <?php echo lang ('a_hot'); ?>
                                                    </span>
                                                    <span class="frame_label no_connection m-l_15">
                                                        <span class="niceCheck" style="background-position: -46px 0px; ">
                                                            <input type="checkbox"  name="Action"  value="1" >
                                                        </span>
                                                        <?php echo lang ('a_action'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputProductType">Тип Продукта:</label>
                                                        <div class="controls">
                                                            <select id="inputParent" name="inputProductType">
                                                                <option value=""><?php echo lang ('a_not_set'); ?></option>
                                                                <?php $result = SBrandsQuery::create()->find(); 
 if(is_true_array($result)){ foreach ($result as $brand){ ?>
                                                                    <option value="<?php echo $brand->getId()?>"><?php echo ShopCore::encode($brand->getName())?></option>
                                                                <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="inputParent"><?php echo lang ('a_brand_i0'); ?>:</label>
                                                        <div class="controls">
                                                            <select id="inputParent" name="BrandId">
                                                                <option value=""><?php echo lang ('a_not_set'); ?></option>
                                                                <?php $result = SBrandsQuery::create()->find(); 
 if(is_true_array($result)){ foreach ($result as $brand){ ?>
                                                                    <option value="<?php echo $brand->getId()?>"><?php echo ShopCore::encode($brand->getName())?></option>
                                                                <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="comment"><?php echo lang ('category'); ?>:</label>
                                                        <div class="controls">
                                                            <select name="CategoryId" id="comment">
                                                                <?php if(is_true_array($categories)){ foreach ($categories as $category){ ?>                    
                                                                    <option <?php if($category->getLevel() == 0): ?>style="font-weight: bold;"<?php endif; ?> value="<?php echo $category->getId()?>"><?php echo str_repeat ('-',$category->getLevel()); ?><?php echo ShopCore::encode($category->getName())?></option>   
                                                                <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="iddCategory"><?php echo lang (a_i9); ?>:</label>
                                                        <div class="controls">
                                                            <select name="Categories[]" multiple="multiple" id="iddCategory">
                                                                <?php if(is_true_array($categories)){ foreach ($categories as $category){ ?>
                                                                    <option <?php if($category->getLevel() == 0): ?>style="font-weight: bold;"<?php endif; ?> value="<?php echo $category->getId()?>"><?php echo str_repeat ('-',$category->getLevel()); ?> <?php echo ShopCore::encode($category->getName())?></option>
                                                                <?php }} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span7" id="productsPhoto">
                                                    <div class="row">
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="inputImg"><?php echo lang ('a_general_image'); ?>:
                                                                <span class="btn btn-small p_r" data-url="file">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;<?php echo lang ('a_select_file'); ?>
                                                                    <input type="file" class="btn-small btn" id="inputImg" name="mainPhoto">
                                                                </span>
                                                                <span class="frame_label no_connection active d_b m-t_10">
                                                                    <button class="btn btn-small deleteMainImages" type="button" data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>">
                                                                        <i class="icon-remove"></i>
                                                                    </button>
                                                                </span>
                                                                <span class="frame_label no_connection active d_b m-t_10">
                                                                    <span class="niceCheck" style="background-position: -46px -17px; ">
                                                                        <input type="checkbox" checked="checked" value="1" name="autoCreateSmallImage" />
                                                                    </span>
                                                                    <?php echo lang ('a_small_image_create'); ?>
                                                                </span>
                                                            </label>
                                                            <div class="controls">
                                                                <?php if(file_exists("uploads/shop/". $model->getId() ."_main.jpg")): ?>
                                                                    <img src="/uploads/shop/<?php echo $model->getMainImage()?>?<?php echo rand (1,9999); ?>" class="img-polaroid" style="width: 100px;">
                                                                <?php else:?>
                                                                    <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                <?php endif; ?>    
                                                            </div>
                                                        </div>
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="inputSImg"><?php echo lang ('a_small_image'); ?>:
                                                                <span class="btn btn-small p_r" data-url="file">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;Выбрать файл
                                                                    <input type="file" class="btn-small btn" id="inputSImg" name="smallPhoto">
                                                                </span>
                                                                <span class="frame_label no_connection active d_b m-t_10">
                                                                    <button class="btn btn-small deleteMainImages" type="button">
                                                                        <i class="icon-remove"></i>
                                                                    </button>                                                     
                                                                </span>
                                                            </label>
                                                            <div class="controls">
                                                                <?php if(file_exists("uploads/shop/". $model->getId() ."_small.jpg")): ?>
                                                                    <img src="/uploads/shop/<?php echo $model->getId()?>_small.jpg?<?php echo rand (1,9999); ?>" class="img-polaroid" style="width: 100px;">
                                                                <?php else:?>
                                                                    <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="inputMMod"><?php echo lang ('a_main_mod_image'); ?>:
                                                                <span class="btn btn-small p_r" data-url="file">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;<?php echo lang ('a_select_file'); ?>
                                                                    <input type="file" class="btn-small btn" id="inputMMod" name="mainModPhoto">
                                                                </span>
                                                                <span class="frame_label no_connection active d_b m-t_10">
                                                                    <button class="btn btn-small deleteMainImages" data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>" type="button">
                                                                        <i class="icon-remove"></i>
                                                                    </button>
                                                                </span>
                                                            </label>
                                                            <div class="controls">
                                                                <?php if(file_exists("uploads/shop/". $model->getId() ."_mainMod.jpg")): ?>
                                                                    <img src="/uploads/shop/<?php echo $model->getId()?>_mainMod.jpg?<?php echo rand (1,9999); ?>" class="img-polaroid" style="width: 100px;">
                                                                <?php else:?>
                                                                    <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="control-group span6">
                                                            <label class="control-label" for="inputSMod"><?php echo lang ('a_small_mod_image'); ?>:
                                                                <span class="btn btn-small p_r" data-url="file">
                                                                    <i class="icon-camera"></i>&nbsp;&nbsp;Выбрать файл
                                                                    <input type="file" class="btn-small btn" id="inputSMod" name="smallModPhoto">
                                                                </span>
                                                                <span class="frame_label no_connection active d_b m-t_10">
                                                                    <button class="btn btn-small deleteMainImages" type="button">
                                                                        <i class="icon-remove"></i>
                                                                    </button>      
                                                                </span>
                                                            </label>
                                                            <div class="controls">
                                                                <?php if(file_exists("uploads/shop/". $model->getId() ."_smallMod.jpg")): ?>
                                                                    <img src="/uploads/shop/<?php echo $model->getId()?>_smallMod.jpg?<?php echo rand (1,9999); ?>" class="img-polaroid" style="width: 100px;">
                                                                <?php else:?>
                                                                    <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="ShortDescriptions"><?php echo $translatable?> <?php echo lang ('a_i6'); ?>:</label>
                                                <div class="controls">
                                                    <textarea class="elRTE" id="ShortDescriptions" name="ShortDescription"><?php echo ShopCore::encode($model->getShortDescription())?></textarea>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="FullDescriptions"><?php echo $translatable?> <?php echo lang ('a_i7'); ?>:</label>
                                                <div class="controls">
                                                    <textarea class="elRTE" id="FullDescriptions" name="FullDescription"><?php echo ShopCore::encode($model->getFullDescription())?></textarea>
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
                                    <?php echo lang ('sett'); ?>
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
                                                    <label class="control-label" for="pName"><?php echo lang ('a_warehouses'); ?>:
                                                        <button type="button" data-clone="wares" class="btn btn-small"><i class="icon-plus"></i></button><br/>
                                                    </label>
                                                    <div class="controls">
                                                        <div id="warehouses_container">
                                                            <div>
                                                                <?php if(is_true_array($model->getSWarehouseDatas())){ foreach ($model->getSWarehouseDatas() as $w_data){ ?>
                                                                    <div id="warehouse_line">
                                                                        <select name="warehouses[]" class="input-medium">
                                                                            <option value="">---</option>
                                                                            <?php if(is_true_array($warehouses)){ foreach ($warehouses as $w){ ?>
                                                                                <option <?php if($w->getId() == $w_data->getWarehouseId()): ?>selected<?php endif; ?> value="<?php echo $w->getId()?>"><?php echo encode($w->getName())?></option>
                                                                            <?php }} ?>
                                                                        </select>
                                                                        <input type="text" name="warehouses_c[]"  value=""   class="input-medium"/>
                                                                        <a data-del="wares" class="btn btn-small"><i class="icon-trash"></i></a>
                                                                    </div>
                                                                <?php }} ?>
                                                            </div>
                                                            <div class="warehouses_container">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="comments"><?php echo lang ('comm_alow'); ?>:</label>
                                                    <div class="controls">
                                                        <select id="comments" class="input-mini">
                                                            <option <?php if($model->getEnableComments()): ?> selected <?php endif; ?> value="1"><?php echo lang ('a_yes'); ?></option>
                                                            <option <?php if(!$model->getEnableComments()): ?> selected <?php endif; ?>value="0"><?php echo lang ('a_no'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="dCreate"><?php echo lang ('a_date_create'); ?>:</label>
                                                    <div class="controls">
                                                        <div class="o_h">
                                                            <input type="text" id="dCreate" name="Created" value="<?php echo date('Y-m-d', time())?>" class="datepicker input-medium"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="oldP"><?php echo lang ('a_old_price'); ?></label>
                                                    <div class="controls">
                                                        <div class="o_h">
                                                            <input type="text" id="oldP" value=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="RelatedProducts"><?php echo lang ('a_i2'); ?>:</label>
                                                    <div class="controls">
                                                        <div class="o_h">
                                                            <input type="text" id="RelatedProducts"/>
                                                            <div id="relatedProductsNames" style="margin-top: 10px;">
                                                                <?php if(is_true_array($model->getRelatedProductsModels())){ foreach ($model->getRelatedProductsModels() as $shopKitProduct){ ?>
                                                                    <div id="tpm_row<?php echo $shopKitProduct->getId()?>">
                                                                        <span style="width: 70%;margin-left: 1%;" class="pull-left">
                                                                            <input type="text" value=""/>
                                                                            <input type="hidden" name="RelatedProducts[]" value="">
                                                                        </span>
                                                                        <span style="width: 8%;margin-left: 1%;" class="pull-left">
                                                                            <button class="btn btn-small del_tmp_row" data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>" data-kid="<?php echo $shopKitProduct->getId()?>"><i class="icon-trash"></i></button>
                                                                        </span>
                                                                    </div>
                                                                <?php }} ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="templateGH"><?php echo lang ('main_tpl'); ?>:</label>
                                                    <div class="controls">
                                                        <div class="o_h" >
                                                            <input type="text" id="templateGH" name="tpl" value="<?php echo ShopCore::encode($model->tpl)?>"/>
                                                        </div>
                                                        <p class="help-block"><?php echo lang ('a_pattern_product'); ?></p>
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
                                    <?php echo lang ('a_meta_data'); ?>
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
                                                    <label class="control-label" for="Url">URL:</label>
                                                    <div class="controls">
                                                        <input type="text" id="Url" value=""/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="Mtag"><?php echo $translatable?> <?php echo lang ('a_meta_title'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="MetaTitle" id="Mtag" value=""/>
                                                    </div>
                                                </div>
                                                <!--<div class="control-group">
                                                    <label class="control-label" for="mDesc"><?php echo $translatable?> <?php echo lang ('a_meta_description'); ?>:</label>
                                                    <div class="controls">
                                                        <input type="text" name="MetaDescription" id="mDesc" value=""/>
                                                    </div>
                                                </div>-->
                                                <div class="control-group">
                                                    <label class="control-label" for="mKey"><?php echo $translatable?> <?php echo lang ('a_meta_keywords'); ?>:</label>
                                                    <div class="controls">
                                                        <input type="text" name="MetaKeywords" id="mKey" value=""/>
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
    </form>
</section>
<div style="display:none;">
    <div class="warehouse_line">
        <select name="warehouses[]" class="input-medium">
            <option value="">---</option>
            <?php if(is_true_array($warehouses)){ foreach ($warehouses as $w){ ?>
                <option value="<?php echo $w->getId()?>"><?php echo encode($w->getName())?></option>
            <?php }} ?>
        </select>
        <input type="text" name="warehouses_c[]"  value="" class="textbox_short input-medium"/>
        <a data-del="wares" class="btn btn-small"><i class="icon-trash"></i></a>
    </div>
</div>
<!-- ---------------------------------------------------Блок для додавання варыантів-------------------------------------- -->
<div style="display: none;" class="variantRowSample">
    <table>
        <tbody>
            <tr id="ProductVariantRow_">
                <td><img src="<?php if(isset($SHOP_THEME)){ echo $SHOP_THEME; } ?>images/drag_arrow.png" class="drager" /></td>
                <td>
                    <input type="hidden" name="variants[RandomId][]"  class="random_id" value=""/>
                    <input type="hidden" name="variants[CurrentId][]" value="" />
                    <input type="text" name="variants[Name][]" value=""/>
                </td>
                <td><input type="text" name="variants[PriceInMain][]" value=""/></td>
                    <?php if(count($currencies)>0): ?>
                    <td>
                        <select name="variants[currency][]">
                            <?php if(is_true_array($currencies)){ foreach ($currencies as $c){ ?>
                                <option value="<?php echo $c->getId()?>"><?php echo $c->getCode()?></option>
                            <?php }} ?>
                        </select>
                    </td>
                <?php endif; ?>
                <td><input type="text" name="variants[Number][]" value="" class="textbox_short" /></td>
                <td><input type="text" name="variants[Stock][]" value="" class="textbox_short" /></td>
                <td class="variantImage">
                    <button class="btn btn-small delete_image" type="button" data-title="<?php echo lang ('a_delete'); ?>">
                        <i class="icon-remove"></i>
                    </button>
                    <div class="control-group">
                        <label class="control-label" style="display: none;">
                            <span class="btn btn-small p_r" data-url="file" >
                                <i class="icon-camera"></i>
                                <input type="file" name="variants[mainPhoto][]" title="<?php echo lang ('a_general_image'); ?>"/>
                                <input type="hidden" name="variants[MainImageForDel][]" value="0"/>    
                            </span>
                        </label>
                        <div class="controls">
                            <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                        </div>
                    </div>
                </td>
                <td class="variantImage">
                    <button class="btn btn-small delete_image" type="button" data-title="<?php echo lang ('a_delete'); ?>">
                        <i class="icon-remove"></i>
                    </button>
                    <div class="control-group">
                        <label class="control-label" style="display: none;">
                            <span class="btn btn-small p_r" data-url="file">
                                <i class="icon-camera"></i>
                                <input type="file" name="variants[smallPhoto][]" title="<?php echo lang ('a_general_image'); ?>"/>
                                <input type="hidden" name="variants[SmallImageForDel][]" value="0"/>    
                            </span>
                        </label>
                        <div class="controls">
                            <img src="<?php if(isset($THEME)){ echo $THEME; } ?>/images/select-picture.png" class="img-polaroid " style="width: 100px; ">
                        </div>
                    </div>
                </td>
                <td>
                    <button class="btn my_btn_s btn-small" type="button" data-remove data-rel="tooltip" data-title="<?php echo lang ('a_delete'); ?>"><i class="icon-remove"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- ---------------------------------------------------Блок для додавання варыантів-------------------------------------- -->                                                    <?php $mabilis_ttl=1357819575; $mabilis_last_modified=1357731408; ///var/www/sportek.loc/application/modules/shop/admin/templates/products/create.tpl ?>