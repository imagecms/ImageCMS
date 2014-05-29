ALTER TABLE  `shop_category` ADD  `created` INT( 11 ) NULL, ADD  `updated` INT( 11 ) NULL;
ALTER TABLE  `category` ADD  `created` INT( 11 ) NULL, ADD  `updated` INT( 11 ) NULL;
ALTER TABLE  `shop_brands` ADD  `created` INT( 11 ) NULL, ADD  `updated` INT( 11 ) NULL;

UPDATE `shop_category` SET `created`=1401265119, `updated`=1401265119 WHERE 1;
UPDATE `category` SET `created`=1401265119, `updated`=1401265119 WHERE 1;
UPDATE `shop_brands` SET `created`=1401265119, `updated`=1401265119 WHERE 1;