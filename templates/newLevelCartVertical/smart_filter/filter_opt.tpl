<script type="text/javascript">
    totalProducts = parseInt('{$totalProducts}');
    function createObjSlider(minCost, maxCost, defMin, defMax, curMin, curMax, lS, rS) {literal}{
        this.minCost = minCost;
        this.maxCost = maxCost;
        this.defMin = defMin;
        this.defMax = defMax;
        this.curMin = curMin;
        this.curMax = curMax;
        this.lS = lS;
        this.rS = rS;
    }{/literal};
    sliders = new Object();
    sliders.slider1 = new createObjSlider('.minCost', '.maxCost', {$minPrice}, {$maxPrice}, {$curMin}, {$curMax}, 'lp', 'rp');
</script>