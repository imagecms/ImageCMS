{if count($products) > 0}
    <div class="horizontal-carousel">
        <section class="special-proposition">
            <div class="frame-title">
                <div class="title">
                    <span class="text-el text-proposition-h">{$title}</span>
                </div>
            </div>
            <div class="big-container">
                <div class="items-carousel carousel-js-css">
                    {/*frame-scroll-pane || carousel-js-css*/}
                    <div class="content-carousel container">
                        <ul class="items items-catalog items-h-carousel">
                            {$CI->load->module('new_level')->OPI($products, array('opi_widget'=>true))}
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
        </section>
    </div>
{/if}