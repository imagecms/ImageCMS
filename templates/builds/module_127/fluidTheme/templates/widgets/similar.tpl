{if count($simProduct = getSimilarProduct($model, $settings[productsCount])) > 0}
    <div class="items-products vertical-carousel count-items{count($simProduct)}">
        <div class="title-proposition-v">
            <div class="frame-title">
                <div class="title">{$title}</div>
            </div>
        </div>
        <div class="big-container">
            <div class="items-carousel carousel-js-css">
                {/*frame-scroll-pane || carousel-js-css || ''*/}
                <div class="content-carousel container">
                    <ul class="items items-default items-v-carousel items-product">
                        {$CI->load->module('new_level')->OPI($simProduct, array('opi_widget'=>true, 'opi_vertical' => true, 'opi_defaultItem'=> true, 'opi_limit'=> 4))}
                    </ul>
                </div>
                <div class="group-button-carousel">
                    <button type="button" class="prev arrow">
                        <span class="icon_arrow_p"></span>
                    </button>
                    <button type="button" class="next arrow">
                        <span class="icon_arrow_n"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}