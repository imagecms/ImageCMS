<!-- php vars to js -->
<script type="text/javascript">
    var curr = '{$CS}',
            currNext = '{$NextCS}',
            nextCs = '{$NextCSId != null ? true : false}'
            pricePrecision = parseInt('{echo ShopCore::app()->SSettings->pricePrecision}'),
            checkProdStock = "{echo ShopCore::app()->SSettings->ordersCheckStocks}",
            inCart = '{lang('In cart','newLevel')}',
            toCart = '{lang('s_buy')}',

            pcs = '{lang('Quantity','newLevel')}',
            kits = '{lang('Kits','newLevel')}:',
            captchaText = '{lang('Protection code','newLevel')}',

    {if $comp = $CI->session->userdata('shopForCompare')}
        {$cnt_comp = count($comp)}
    {else:}
        {$cnt_comp = 0}
    {/if}
    var inServerCart = parseInt("{echo ShopCore::app()->SCart->totalItems()}"),
            inServerWish = parseInt("{echo ShopCore::app()->SWishList->totalItems()}"),
            inServerCompare = parseInt("{$cnt_comp}"),
            theme = "{$THEME}";

    plurProd = [{lang("product","newLevel")}, {lang("product","newLevel")}, {lang("products","newLevel")}];
    plurKits = [{lang("set","newLevel")}, {lang("set","newLevel")}, {lang("sets","newLevel")}];
    plurComments = [{lang("comment","newLevel")}, {lang("comment","newLevel")}, {lang("comments","newLevel")}];

    var productPhotoFancybox = true,
            productPhotoCZoom = false;

</script>
{literal}
    <script type="text/javascript">
        forThumbFancybox = "body{background-color:#fff;text-align: center;height:100%;margin:0;}img{height: auto; max-width: 100%; vertical-align: middle; border: 0; width: auto\9;max-height: 100%; -ms-interpolation-mode: bicubic; }.helper{vertical-align: middle;width: 0;height: 100%;padding: 0 !important;border: 0 !important;display: inline-block;}.helper + *{vertical-align: middle;display: inline-block;word-break: break-word;}";
        text = {
            search: function(text) {
                return 'Введите боллее ' + text + ' символов';
            }
        }
    </script>
{/literal}
