{if count($products) > 0}
    <div class="vertical-carousel carousel-category-popular">
        <section class="special-proposition">
            <div class="frame-title">
                <div class="title">
                    <span class="text-el text-proposition-v">{$title}</span>
                </div>
            </div>
            <div class="big-container">
                <div class="carousel_js products-carousel">
                    <div class="content-carousel container">
                        <ul class="items items-default items-v-carousel">
                            {$CI->load->module('new_level')->OPI($products, array('widget'=>true, 'vertical' => true, 'defaultItem'=>true))}
                        </ul>
                    </div>
                    <div class="group-button-carousel">
                        <button type="button" class="prev arrow">
                            <span class="icon_arrow_p icon_arrow_p_t"></span>
                        </button>
                        <button type="button" class="next arrow">
                            <span class="icon_arrow_n icon_arrow_n_b"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
{/if}