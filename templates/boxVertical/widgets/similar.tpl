{if count($simProduct = getSimilarProduct($model, $settings[productsCount])) > 0}
<div class="horizontal-carousel" id="similar_products">
    <section class="special-proposition">
        <div class="title-proposition-h">
            <div class="frame-title">
                <div class="title">{$title}</div>
            </div>
        </div>
        <div class="big-container">
            <div class="items-carousel carousel-js-css">
                {/*frame-scroll-pane || carousel-js-css || ''*/}
                <div class="content-carousel container">
                    <ul class="items items-catalog items-h-carousel">
                        {getOPI($simProduct, array('opi_widget'=>true), 'similar')}
                        {getOPI($simProduct, array('opi_widget'=>true), 'similar')}
                        {getOPI($simProduct, array('opi_widget'=>true), 'similar')}
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