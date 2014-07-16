{if count($products) > 0}
    <div class="horizontal-carousel">
        <section class="special-proposition">
            <div class="title-proposition-h">
                <div class="frame-titltitle-proposition-he">
                    <div class="title-h1">{$title}</div>
                </div>
                <span class="sub-title">Выберите свой собственный стильный магазин шаблонов
            </div>
            <div class="big-container">
                <div class="carousel-js-css items-carousel">
                    {/*frame-scroll-pane || carousel-js-css || ' '*/}
                    <div class="content-carousel container">
                        <ul class="items items-catalog items-h-carousel items-product">
                            {getOPI($products, array('opi_widget'=>true))}
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