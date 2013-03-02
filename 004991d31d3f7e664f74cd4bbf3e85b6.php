<?php #
/**
* @file - template for displaying shop category page
* Variables
*   $category: (object) instance of SCategory
*       $category->getDescription(): method which returns category description
*       $category->getName(): method which returns category name according to currenct locale
*   $products: PropelObjectCollection of (object)s instance of SProducts
*       $product->firstVariant: variable which contains the first variant of product
*       $product->firstVariant->toCurrency(): method which returns price according to current currencya and format
*   $totalProducts: integer contains products count
*   $pagination: string variable contains html code for displaying pagination
*   $pageNumber: integer variable contains the current page number
*   $banners: array of (object)s of SBanners which have to be displayed in current page
*/
#?>

<?php $Comments = $CI->load->module('comments')->init($products)?>
<article>
    <!-- Show Banners in circle -->
    <div class="mainFrameBaner">
        <section class="container">
            <?php $banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$category->id)?>
            <?php if(count($banners)): ?>
                <div class="frame_baner">
                    <ul class="cycle">
                        <?php if(is_true_array($banners)){ foreach ($banners as $banner){ ?>
                            <li>
                                <a href="<?php echo $banner['url']?>">
                                    <img src="/uploads/shop/banners/<?php echo $banner['image']?>" />
                                </a>
                            </li>
                        <?php }} ?>
                    </ul>
                    <div class="pager"></div>
                    <button class="next" type="button"></button>
                    <button class="prev" type="button"></button>
                </div>
            <?php endif; ?>
        </section>
    </div>
    <!-- Show banners in circle -->

    <!-- Block for bread crumbs with a call of shop_helper function to create it according to category model -->
    <?php echo widget ('path'); ?>

    <!-- main category page content -->
    <div class="row">
        <!-- here filter tpl is including -->
        <?php $this->include_tpl('filter', '/home/imagecms/data/www/test2.imagecms.net/templates/new_shop_template/shop/default'); ?>

        <!-- catalog container -->
        <div class="span9 right">

            <!-- category title and products count output -->
            <h1 class="d_i"><?php echo ShopCore::encode($category->getName())?></h1><span class="c_97"><?php echo lang ('s_found'); ?> <?php echo $totalProducts?> <?php echo SStringHelper::Pluralize($totalProducts, array(lang('s_product_o'), lang('s_product_t'), lang('s_product_tr')))?></span>
            <div class="clearfix t-a_c frame_func_catalog">

                <!-- sort block -->
                <div class="f_l">
                    <span class="v-a_m"><?php echo lang ('s_order_by'); ?>:</span>
                    <div class="lineForm w_170 sort">
                        <select class="sort" id="sort" name="order">
                            <option value="" <?php if(!ShopCore::$_GET['order']): ?>selected="selected"<?php endif; ?>>-<?php echo lang ('s_no'); ?>-</option>
                            <option value="rating" <?php if(ShopCore::$_GET['order']=='rating'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_po'); ?> <?php echo lang ('s_rating'); ?></option>
                            <option value="price" <?php if(ShopCore::$_GET['order']=='price'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_dewevye'); ?></option>
                            <option value="price_desc" <?php if(ShopCore::$_GET['order']=='price_desc'): ?>selected="selected"<?php endif; ?> ><?php echo lang ('s_dor'); ?></option>
                            <option value="hit" <?php if(ShopCore::$_GET['order']=='hit'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_popular'); ?></option>
                            <option value="hot" <?php if(ShopCore::$_GET['order']=='hot'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_new'); ?></option>
                            <option value="action" <?php if(ShopCore::$_GET['order']=='action'): ?>selected="selected"<?php endif; ?>><?php echo lang ('s_action'); ?></option>
                        </select>
                    </div>
                </div>

                <!-- products on page count -->
                <div class="f_r">
                    <span class="v-a_m"><?php echo lang ('s_products_per_page'); ?>:</span>
                    <div class="lineForm w_70 sort">
                        <select class="sort" id="sort2" name="user_per_page">
                            <option value="12" <?php if(ShopCore::$_GET['user_per_page']=='12'): ?>selected="selected"<?php endif; ?> >12</option>
                            <option value="24" <?php if(ShopCore::$_GET['user_per_page']=='24'): ?>selected="selected"<?php endif; ?> >24</option>
                            <option value="36" <?php if(ShopCore::$_GET['user_per_page']=='36'): ?>selected="selected"<?php endif; ?> >36</option>
                            <option value="48" <?php if(ShopCore::$_GET['user_per_page']=='48'): ?>selected="selected"<?php endif; ?> >48</option>
                        </select>
                    </div>
                </div>

                <!-- selecting product list type -->
                <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                    <button type="button" class="btn active"><span class="icon-cat_pic"></span><span class="text-el"><?php echo lang ('s_in_images'); ?></span></button>
                    <button type="button" class="btn"><span class="icon-cat_list"></span><span class="text-el"><?php echo lang ('s_in_list'); ?></span></button>
                </div>
            </div>

            <!-- displaying category description if page number is 1 -->
            <?php if($page_number == 1 && $category->getDescription() != '' && $category->getDescription() != ' ' && $category->getDescription() != null): ?>
                <div class="grey-b_r-bord">
                    <p><span style="font-weight:bold"><?php echo ShopCore::encode($category->getName())?></span> &mdash; <?php echo ShopCore::encode($category->getDescription())?></p>
                </div>
            <?php endif; ?>

            <!-- rendering product list if products count more than 0 -->
            <?php if(count($products)>0): ?>

                <!-- product list container -->
                <ul class="items items_catalog" data-radio-frame>

                    <!-- starts loop for array with products -->
                    <?php if(is_true_array($products)){ foreach ($products as $product){ ?>

                        <!-- product block -->
                        <!-- check if product is in stock -->
                        <li class="<?php if((int)$product->getallstock() == 0): ?>not-avail <?php else:?>in_cart <?php endif; ?>span3">

                            <!-- product info block -->
                            <div class="description">
                                <div class="frame_response">

                                    <!-- displaying product's rate -->
                                    <?php $CI->load->module('star_rating')->show_star_rating($product)?>

                                    <!-- displaying comments count -->
                                    <a href="<?php echo shop_url ('product/'.$product->url.'#cc'); ?>" class="count_response">
                                        <?php echo $Comments[$product->getId()]?>
                                    </a>
                                </div>

                                <!-- displaying product name -->
                                <a href="<?php echo shop_url ('product/'.$product->getUrl()); ?>"><?php echo ShopCore::encode($product->getName())?></a>

                                <!-- displaying products first variant price and currency symbol -->
                                <div class="price price_f-s_16"><span class="f-w_b"><?php echo $product->firstVariant->toCurrency()?></span> <?php if(isset($CS)){ echo $CS; } ?>&nbsp;&nbsp;<span class="second_cash"></span></div>

                                <!-- displaying buy button according to its availability in stock -->

                                <?php if((int)$product->getallstock() == 0): ?>

                                    <!-- displaying notify button -->
                                    <button data-placement="bottom right"
                                            data-place="noinherit"
                                            data-duration="500"
                                            data-effect-off="fadeOut"
                                            data-effect-on="fadeIn"
                                            data-drop=".drop-report"
                                            data-prodid="<?php echo $product->getId()?>"
                                            type="button"
                                            class="btn btn_not_avail">
                                        <span class="icon-but"></span>
                                        <?php echo lang ('s_message_o_report'); ?>
                                    </button>
                                <?php else:?>

                                    <!-- displaying buy or in cart button -->
                                    <button class="btn btn_buy" type="button"
                                            data-prodid="<?php echo $product->getId()?>"
                                            data-varid="<?php echo $product->firstVariant->getId()?>"
                                            data-price="<?php echo $product->firstVariant->toCurrency()?>"
                                            data-name="<?php echo ShopCore::encode($product->getName())?>"
                                            data-number="<?php echo $product->firstVariant->getnumber()?>"
                                            data-maxcount="<?php echo $product->firstVariant->getstock()?>">
                                        <?php echo lang ('s_buy'); ?>
                                    </button>
                                <?php endif; ?>

                                <div class="d_i-b">

                                    <!-- to compare button -->
                                    <button class="btn btn_small_p toCompare"  
                                            data-prodid="<?php echo $product->getId()?>"  
                                            type="button" 
                                            title="<?php echo lang ('s_add_to_compare'); ?>">
                                        <span class="icon-comprasion_2"></span>
                                    </button>

                                    <!-- to wish list button -->
                                    <button class="btn btn_small_p toWishlist" 
                                            data-prodid="<?php echo $product->getId()?>" 
                                            data-varid="<?php echo $product->firstVariant->getId()?>"  
                                            type="button" 
                                            title="<?php echo lang ('s_add_to_wish_list'); ?>">
                                        <span class="icon-wish_2"></span>
                                    </button>
                                </div>
                            </div>

                            <!-- displaying products small mod image -->
                            <a href="<?php echo shop_url ('product/'.$product->getUrl()); ?>" class="photo">
                                <span class="helper"></span>
                                <figure>
                                    <img src="<?php echo productImageUrl ($product->getSmallImage()); ?>" alt="<?php echo ShopCore::encode($product->getName())?> - <?php echo $product->getId()?>"/>
                                </figure>
                            </a>

                            <!-- creating hot bubble for products image if product is hot -->
                            <?php if($product->getHot()): ?>
                                <span class="top_tovar nowelty"><?php echo lang ('s_shot'); ?></span>
                            <?php endif; ?>

                            <!-- creating hot bubble for products image if product is action -->
                            <?php if($product->getAction()): ?>
                                <span class="top_tovar promotion"><?php echo lang ('s_saction'); ?></span>
                            <?php endif; ?>

                            <!-- creating hot bubble for products image if product is hit -->
                            <?php if($product->getHit()): ?>
                                <span class="top_tovar discount"><?php echo lang ('s_s_hit'); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php }} ?>
                </ul>
            <?php endif; ?>

            <!-- pagination variable from category.php controller -->
            <?php if(isset($pagination)){ echo $pagination; } ?>
        </div>
    </div>

</article>
<?php $mabilis_ttl=1362307161; $mabilis_last_modified=1362162784; ///home/imagecms/data/www/test2.imagecms.net/templates/new_shop_template/shop/default/category.tpl ?>