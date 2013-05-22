<div class="content_head">
    {widget('path')}
    <div class="crumbs">
        <h1>Подбор по параметрам</h1>
    </div>       
</div>
        <hr class="head_cle_foot"/>
        <form method="get" action="">
            <div class="main_frame_inside filter">
                <div class="title">Цена</div>
                <div class="range_price">
                    <label class="f_l">
                        <span class="f_l">от</span>
                        <span class="frame_input">
                            <input name="lp" type="text"/>
                        </span>
                    </label>
                    <label class="f_l">
                        <span class="f_l">до</span>
                        <span class="frame_input">
                            <input name="rp" type="text" />
                        </span>
                    </label>
                    <div class="f_l subm_filter">
                        <input type="submit" value="Подобрать"/>
                    </div>
                </div>
        </form>
        <form method="get" action="">
                <div class="check_frame">
                    <div class="title">Производитель</div>
                    {foreach $brands as $brand}
                        <div class="frame_label">
                            <span class="f-s_0">
                                <span class="niceCheck b_n">
                                <input name="brand[]" type="checkbox" value="{echo $brand->id}" /></span>
                                <span class="neigh_r-o_c-k">{echo $brand->name}</span>
                            </span>
                        </div>
                    {/foreach}
                </div>
                <div class="f_l subm_filter">
                    <input type="submit" value="Подобрать"/>
                </div>
                <!--                поставити
                                <hr class="head_cle_foot"/>
                                якщо є ще один блок - <div class="check_frame">-->
            </div>
            <div class="main_f_i_f-r"></div>
        </form>