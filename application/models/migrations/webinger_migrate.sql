ALTER TABLE `shop_product_variants` ADD `not_available` TINYINT(1) AFTER `price_in_main` 
ALTER TABLE `shop_product_properties` ADD `tip` TINYINT(1) AFTER `main_property` 
ALTER TABLE `shop_product_properties_i18n` ADD `description` TEXT AFTER `data` 
