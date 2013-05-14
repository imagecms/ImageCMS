$(document).ready(function() {
    $(document).on('cart_changed cart_rm', function() {
        $('#topCartCountModule').html(' ('+Shop.Cart.totalCount+')');
    })

    $(document).on('wish_list_add wish_list_rm', function() { 
        change_cnt_active_wish(Shop.WishList.items.length);
    })

    $(document).on('compare_list_add compare_list_rm', function() {       
        change_cnt_active_comp(Shop.CompareList.items.length);
    })
})

function change_cnt_active_comp(cnt){
    $('#compareCountModule').html('('+cnt+')');
    if(cnt > 0){
        $('#compareListDataModule span:first').removeClass('d_n');
        $('#compareListDataModule span:first').next().addClass('d_n');
    } else {
        $('#compareListDataModule span:first').addClass('d_n');
        $('#compareListDataModule span:first').next().removeClass('d_n'); 
    }
    

}
function change_cnt_active_wish(cnt){
    $('#wishListCountModule').html('('+cnt+')');
    if(cnt > 0){
        $('#wishListDataModule span:first').removeClass('d_n');
        $('#wishListDataModule span:first').next().addClass('d_n');
    } else {
        $('#wishListDataModule span:first').addClass('d_n');
        $('#wishListDataModule span:first').next().removeClass('d_n');        
    }

}





