{# Useful methods:
 # @method   ShopCore::app()->SWishList->totalItems()
 # @method   ShopCore::app()->SWishList->totalPrice()
 # @method   SStringHelper::Pluralize(ShopCore::app()->SWishList->totalItems(), array('товар','товара','товаров'))
 # @var      $CS
}

<a href="{shop_url('wish_list')}">Список желаний</a> ({echo ShopCore::app()->SWishList->totalItems()})