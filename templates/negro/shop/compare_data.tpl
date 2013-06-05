{$count = count($CI->session->userdata('shopForCompare'))}
<div id="compareBlock">
    <div class="compare-list-btn tiny-compare-list">
        <button onclick="location='{shop_url('compare')}'">
            <span class="icon_compare_list"></span>
            <span class="text-compare-list">
                <span class="text-el">Список сравнений (</span>
                <span class="empty">
                    <span class="text-el compareListCount"></span>
                </span>
                <span class="no-empty">
                    <span class="text-el compareListCount"></span>
                </span>
                <span class="text-el">)</span>
            </span>
        </button>
    </div>
</div>