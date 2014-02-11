{if count($simProduct = getSimilarProduct($model, $settings[productsCount])) > 0}
    <div class="">
        <section class="special-proposition">
            <div class="title-proposition-v">
                <div class="frame-title">
                    <div class="title">{$title}</div>
                </div>
            </div>
            <div class="big-container">
                <div class="items-carousel">
                    {/*frame-scroll-pane || carousel-js-css || ''*/}
                    <div class="content-carousel container">
                        <ul class="items items-catalog items-v-carousel">
                            {$CI->load->module('new_level')->OPI($simProduct, array('opi_widget'=>true))}
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
{/if}