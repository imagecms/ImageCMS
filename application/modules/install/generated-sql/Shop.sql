
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- route
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `route`;

CREATE TABLE `route`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `entity_id` INTEGER(11) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `parent_url` VARCHAR(500) DEFAULT '',
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `route_u_df1472` (`url`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- page_link
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page_link`;

CREATE TABLE `page_link`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `page_id` INTEGER(11),
    `active_from` INTEGER(11),
    `active_to` INTEGER(11),
    `show_on` TINYINT(1),
    `permanent` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- page_link_product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page_link_product`;

CREATE TABLE `page_link_product`
(
    `link_id` INTEGER NOT NULL,
    `product_id` INTEGER NOT NULL,
    PRIMARY KEY (`link_id`,`product_id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_category`;

CREATE TABLE `shop_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `parent_id` INTEGER,
    `route_id` INTEGER,
    `external_id` VARCHAR(255),
    `active` TINYINT(1),
    `image` VARCHAR(255),
    `position` INTEGER,
    `full_path_ids` VARCHAR(250),
    `tpl` VARCHAR(250),
    `order_method` INTEGER,
    `showsitetitle` INTEGER,
    `show_in_menu` TINYINT(1) DEFAULT 1 NOT NULL,
    `created` INTEGER NOT NULL,
    `updated` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `shop_category_i_df1472` (`url`),
    INDEX `shop_category_i_25ffb6` (`active`),
    INDEX `shop_category_i_0bb977` (`parent_id`),
    INDEX `shop_category_i_ba7161` (`position`),
    INDEX `shop_category_fi_c5366e` (`route_id`),
    CONSTRAINT `shop_category_fk_49e723`
        FOREIGN KEY (`parent_id`)
        REFERENCES `shop_category` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `shop_category_fk_c5366e`
        FOREIGN KEY (`route_id`)
        REFERENCES `route` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_category_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_category_i18n`;

CREATE TABLE `shop_category_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `h1` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `meta_desc` VARCHAR(255) NOT NULL,
    `meta_title` VARCHAR(255) NOT NULL,
    `meta_keywords` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_category_i18n_i_d94269` (`name`),
    INDEX `shop_category_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_category_i18n_fk_de3ea2`
        FOREIGN KEY (`id`)
        REFERENCES `shop_category` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_products
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products`;

CREATE TABLE `shop_products`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `route_id` INTEGER,
    `external_id` VARCHAR(255),
    `active` TINYINT(1),
    `hit` TINYINT(1),
    `hot` TINYINT(1),
    `action` TINYINT(1),
    `archive` TINYINT(1) DEFAULT 0,
    `brand_id` INTEGER,
    `category_id` INTEGER NOT NULL,
    `related_products` VARCHAR(255),
    `old_price` DOUBLE (12,2),
    `created` INTEGER NOT NULL,
    `updated` INTEGER NOT NULL,
    `views` INTEGER DEFAULT 0,
    `added_to_cart_count` INTEGER,
    `enable_comments` TINYINT(1) DEFAULT 1,
    `tpl` VARCHAR(250),
    PRIMARY KEY (`id`),
    INDEX `shop_products_i_df1472` (`url`),
    INDEX `shop_products_i_24f797` (`brand_id`),
    INDEX `shop_products_i_916b34` (`category_id`),
    INDEX `shop_products_fi_c5366e` (`route_id`),
    CONSTRAINT `shop_products_fk_c5366e`
        FOREIGN KEY (`route_id`)
        REFERENCES `route` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `shop_products_fk_d02aad`
        FOREIGN KEY (`brand_id`)
        REFERENCES `shop_brands` (`id`),
    CONSTRAINT `shop_products_fk_5ade45`
        FOREIGN KEY (`category_id`)
        REFERENCES `shop_category` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_kit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_kit`;

CREATE TABLE `shop_kit`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_id` INTEGER,
    `active` TINYINT(1) DEFAULT 1 NOT NULL,
    `position` SMALLINT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `shop_kit_fi_6a9780` (`product_id`),
    CONSTRAINT `shop_kit_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_products_words
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products_words`;

CREATE TABLE `shop_products_words`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `local` VARCHAR(4) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `shop_products_words_u_d94269` (`name`),
    INDEX `shop_products_words_i_ca2c66` (`name`, `locale`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_kit_product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_kit_product`;

CREATE TABLE `shop_kit_product`
(
    `product_id` INTEGER NOT NULL,
    `kit_id` INTEGER NOT NULL,
    `discount` VARCHAR(11) DEFAULT '0',
    PRIMARY KEY (`product_id`,`kit_id`),
    INDEX `shop_kit_product_fi_350dcb` (`kit_id`),
    INDEX `shop_kit_product_i_3c83a1` (`kit_id`),
    CONSTRAINT `shop_kit_product_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `shop_kit_product_fk_f2c410`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_product_variants` (`product_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `shop_kit_product_fk_350dcb`
        FOREIGN KEY (`kit_id`)
        REFERENCES `shop_kit` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_products_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products_i18n`;

CREATE TABLE `shop_products_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500) NOT NULL,
    `short_description` TEXT,
    `full_description` TEXT,
    `meta_title` VARCHAR(255),
    `meta_description` VARCHAR(255),
    `meta_keywords` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_products_i18n_i_d94269` (`name`),
    INDEX `shop_products_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_products_i18n_fk_e71a1e`
        FOREIGN KEY (`id`)
        REFERENCES `shop_products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `shop_products_i18n_fk_bc3b70`
        FOREIGN KEY (`id`)
        REFERENCES `shop_product_variants` (`product_id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_images
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_images`;

CREATE TABLE `shop_product_images`
(
    `product_id` INTEGER NOT NULL,
    `image_name` VARCHAR(255) NOT NULL,
    `position` SMALLINT,
    PRIMARY KEY (`product_id`,`image_name`),
    INDEX `shop_product_images_i_ba7161` (`position`),
    INDEX `shop_product_images_i_236585` (`image_name`(255)),
    CONSTRAINT `shop_product_images_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_brands
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_brands`;

CREATE TABLE `shop_brands`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `url` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255),
    `position` SMALLINT NOT NULL,
    `created` INTEGER NOT NULL,
    `updated` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `shop_brands_i_df1472` (`url`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_brands_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_brands_i18n`;

CREATE TABLE `shop_brands_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500) NOT NULL,
    `description` TEXT,
    `meta_title` VARCHAR(255),
    `meta_description` VARCHAR(255),
    `meta_keywords` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_brands_i18n_i_d94269` (`name`),
    INDEX `shop_brands_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_brands_i18n_fk_ebd758`
        FOREIGN KEY (`id`)
        REFERENCES `shop_brands` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_variants
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_variants`;

CREATE TABLE `shop_product_variants`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `external_id` VARCHAR(255),
    `product_id` INTEGER NOT NULL,
    `price` DOUBLE (20,5) NOT NULL,
    `number` VARCHAR(255),
    `stock` INTEGER,
    `mainImage` VARCHAR(255),
    `position` INTEGER,
    `currency` INTEGER,
    `price_in_main` DOUBLE (20,5) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `shop_product_variants_i_7d267a` (`product_id`),
    INDEX `shop_product_variants_i_ba7161` (`position`),
    INDEX `shop_product_variants_i_358b23` (`number`),
    INDEX `shop_product_variants_i_a8d2e8` (`price`),
    INDEX `shop_product_variants_fi_aa8d8c` (`currency`),
    CONSTRAINT `shop_product_variants_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `shop_product_variants_fk_aa8d8c`
        FOREIGN KEY (`currency`)
        REFERENCES `shop_currencies` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_variants_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_variants_i18n`;

CREATE TABLE `shop_product_variants_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_product_variants_i18n_i_d94269` (`name`),
    INDEX `shop_product_variants_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_product_variants_i18n_fk_c1a6f0`
        FOREIGN KEY (`id`)
        REFERENCES `shop_product_variants` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_categories`;

CREATE TABLE `shop_product_categories`
(
    `product_id` INTEGER NOT NULL,
    `category_id` INTEGER NOT NULL,
    PRIMARY KEY (`product_id`,`category_id`),
    INDEX `shop_product_categories_fi_5ade45` (`category_id`),
    INDEX `shop_product_categories_i_916b34` (`category_id`),
    CONSTRAINT `shop_product_categories_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `shop_product_categories_fk_5ade45`
        FOREIGN KEY (`category_id`)
        REFERENCES `shop_category` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_properties
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties`;

CREATE TABLE `shop_product_properties`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `external_id` VARCHAR(255),
    `csv_name` VARCHAR(50) NOT NULL,
    `multiple` TINYINT(1),
    `active` TINYINT(1),
    `show_on_site` TINYINT(1),
    `show_in_compare` TINYINT(1),
    `show_in_filter` TINYINT(1),
    `show_faq` TINYINT(1),
    `main_property` TINYINT(1),
    `position` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `shop_product_properties_i_25ffb6` (`active`),
    INDEX `shop_product_properties_i_3e9fc9` (`show_on_site`),
    INDEX `shop_product_properties_i_2b812d` (`show_in_compare`),
    INDEX `shop_product_properties_i_ba7161` (`position`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_properties_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties_i18n`;

CREATE TABLE `shop_product_properties_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `description` TEXT,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_product_properties_i18n_i_d94269` (`name`),
    INDEX `shop_product_properties_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_product_properties_i18n_fk_44d362`
        FOREIGN KEY (`id`)
        REFERENCES `shop_product_properties` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_property_value
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_property_value`;

CREATE TABLE `shop_product_property_value`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `property_id` INTEGER NOT NULL,
    `position` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `shop_product_property_value_fi_0dfa18` (`property_id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_property_value_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_property_value_i18n`;

CREATE TABLE `shop_product_property_value_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_product_property_value_i18n_i_794a79` (`locale`(5))
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_properties_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties_categories`;

CREATE TABLE `shop_product_properties_categories`
(
    `property_id` INTEGER NOT NULL,
    `category_id` INTEGER NOT NULL,
    PRIMARY KEY (`property_id`,`category_id`),
    INDEX `shop_product_properties_categories_fi_5ade45` (`category_id`),
    INDEX `shop_product_properties_categories_i_916b34` (`category_id`),
    CONSTRAINT `shop_product_properties_categories_fk_0dfa18`
        FOREIGN KEY (`property_id`)
        REFERENCES `shop_product_properties` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `shop_product_properties_categories_fk_5ade45`
        FOREIGN KEY (`category_id`)
        REFERENCES `shop_category` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_product_properties_data
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties_data`;

CREATE TABLE `shop_product_properties_data`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `property_id` INTEGER,
    `product_id` INTEGER,
    `value_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `shop_product_properties_data_i_563e74` (`value`),
    INDEX `shop_product_properties_data_fi_c526ab` (`value_id`),
    INDEX `shop_product_properties_data_fi_0dfa18` (`property_id`),
    INDEX `shop_product_properties_data_fi_6a9780` (`product_id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_notifications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_notifications`;

CREATE TABLE `shop_notifications`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_id` INTEGER NOT NULL,
    `variant_id` INTEGER NOT NULL,
    `user_name` VARCHAR(100),
    `user_email` VARCHAR(100),
    `user_phone` VARCHAR(100),
    `user_comment` VARCHAR(500),
    `status` INTEGER NOT NULL,
    `date_created` INTEGER NOT NULL,
    `active_to` INTEGER NOT NULL,
    `manager_id` INTEGER,
    `notified_by_email` TINYINT(1),
    PRIMARY KEY (`id`),
    INDEX `shop_notifications_i_5ba9eb` (`user_email`),
    INDEX `shop_notifications_i_f257b1` (`user_phone`),
    INDEX `shop_notifications_i_d402b5` (`status`),
    INDEX `shop_notifications_i_b79ab1` (`date_created`),
    INDEX `shop_notifications_i_b9e798` (`active_to`),
    INDEX `shop_notifications_fi_6a9780` (`product_id`),
    INDEX `shop_notifications_fi_c17aa5` (`variant_id`),
    CONSTRAINT `shop_notifications_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`),
    CONSTRAINT `shop_notifications_fk_c17aa5`
        FOREIGN KEY (`variant_id`)
        REFERENCES `shop_product_variants` (`id`),
    CONSTRAINT `shop_notifications_fk_a62a9d`
        FOREIGN KEY (`status`)
        REFERENCES `shop_notification_statuses` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_notification_statuses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_notification_statuses`;

CREATE TABLE `shop_notification_statuses`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `position` SMALLINT,
    PRIMARY KEY (`id`),
    INDEX `shop_notification_statuses_i_ba7161` (`position`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_notification_statuses_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_notification_statuses_i18n`;

CREATE TABLE `shop_notification_statuses_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_notification_statuses_i18n_i_d94269` (`name`),
    INDEX `shop_notification_statuses_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_notification_statuses_i18n_fk_dc77c6`
        FOREIGN KEY (`id`)
        REFERENCES `shop_notification_statuses` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_delivery_methods
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_delivery_methods`;

CREATE TABLE `shop_delivery_methods`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `price` DOUBLE (20,5) NOT NULL,
    `free_from` DOUBLE (20,5) NOT NULL,
    `enabled` TINYINT(1),
    `is_price_in_percent` TINYINT(1) NOT NULL,
    `position` INTEGER(11),
    `delivery_sum_specified` TINYINT(1),
    PRIMARY KEY (`id`),
    INDEX `shop_delivery_methods_i_5d0c97` (`enabled`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_delivery_methods_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_delivery_methods_i18n`;

CREATE TABLE `shop_delivery_methods_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500) NOT NULL,
    `description` TEXT,
    `pricedescription` TEXT,
    `delivery_sum_specified_message` VARCHAR(500),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_delivery_methods_i18n_i_d94269` (`name`),
    INDEX `shop_delivery_methods_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_delivery_methods_i18n_fk_b312b6`
        FOREIGN KEY (`id`)
        REFERENCES `shop_delivery_methods` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_delivery_methods_systems
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_delivery_methods_systems`;

CREATE TABLE `shop_delivery_methods_systems`
(
    `delivery_method_id` INTEGER NOT NULL,
    `payment_method_id` INTEGER NOT NULL,
    PRIMARY KEY (`delivery_method_id`,`payment_method_id`),
    INDEX `shop_delivery_methods_systems_fi_6230d2` (`payment_method_id`),
    INDEX `shop_delivery_methods_systems_i_deeb1f` (`payment_method_id`),
    CONSTRAINT `shop_delivery_methods_systems_fk_2bb0f1`
        FOREIGN KEY (`delivery_method_id`)
        REFERENCES `shop_delivery_methods` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `shop_delivery_methods_systems_fk_6230d2`
        FOREIGN KEY (`payment_method_id`)
        REFERENCES `shop_payment_methods` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_order_statuses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_order_statuses`;

CREATE TABLE `shop_order_statuses`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `color` VARCHAR(255),
    `fontcolor` VARCHAR(255),
    `position` SMALLINT,
    PRIMARY KEY (`id`),
    INDEX `shop_order_statuses_i_ba7161` (`position`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_order_statuses_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_order_statuses_i18n`;

CREATE TABLE `shop_order_statuses_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_order_statuses_i18n_i_d94269` (`name`),
    INDEX `shop_order_statuses_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_order_statuses_i18n_fk_1c70bf`
        FOREIGN KEY (`id`)
        REFERENCES `shop_order_statuses` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_orders
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders`;

CREATE TABLE `shop_orders`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `order_key` VARCHAR(255) NOT NULL,
    `delivery_method` INTEGER,
    `delivery_price` DOUBLE (20,5),
    `payment_method` INTEGER,
    `status` INTEGER,
    `paid` TINYINT(1),
    `user_full_name` VARCHAR(255),
    `user_surname` VARCHAR(255),
    `user_email` VARCHAR(255),
    `user_phone` VARCHAR(255),
    `user_deliver_to` VARCHAR(500),
    `user_comment` VARCHAR(1000),
    `date_created` INTEGER,
    `date_updated` INTEGER,
    `user_ip` VARCHAR(255),
    `total_price` DOUBLE (20,5),
    `external_id` VARCHAR(255),
    `gift_cert_key` VARCHAR(25),
    `discount` DOUBLE (20,5),
    `gift_cert_price` DOUBLE (20,5),
    `discount_info` TEXT,
    `origin_price` DOUBLE (20,5),
    `comulativ` DOUBLE (20,5),
    PRIMARY KEY (`id`),
    INDEX `shop_orders_i_e2c126` (`order_key`),
    INDEX `shop_orders_i_d402b5` (`status`),
    INDEX `shop_orders_i_b79ab1` (`date_created`),
    INDEX `shop_orders_fi_6a5e47` (`delivery_method`),
    INDEX `shop_orders_fi_f737d2` (`payment_method`),
    CONSTRAINT `shop_orders_fk_6a5e47`
        FOREIGN KEY (`delivery_method`)
        REFERENCES `shop_delivery_methods` (`id`)
        ON DELETE SET NULL,
    CONSTRAINT `shop_orders_fk_f737d2`
        FOREIGN KEY (`payment_method`)
        REFERENCES `shop_payment_methods` (`id`)
        ON DELETE SET NULL,
    CONSTRAINT `shop_orders_fk_b90414`
        FOREIGN KEY (`status`)
        REFERENCES `shop_order_statuses` (`id`)
        ON DELETE SET NULL
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_orders_products
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders_products`;

CREATE TABLE `shop_orders_products`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `order_id` INTEGER NOT NULL,
    `kit_id` INTEGER,
    `is_main` TINYINT(1),
    `product_id` INTEGER NOT NULL,
    `variant_id` INTEGER NOT NULL,
    `product_name` VARCHAR(255),
    `variant_name` VARCHAR(255),
    `price` DOUBLE (20,5),
    `origin_price` DOUBLE (20,5),
    `quantity` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `shop_orders_products_i_3d3fe8` (`order_id`),
    INDEX `shop_orders_products_fi_6a9780` (`product_id`),
    INDEX `shop_orders_products_fi_c17aa5` (`variant_id`),
    CONSTRAINT `shop_orders_products_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`),
    CONSTRAINT `shop_orders_products_fk_c17aa5`
        FOREIGN KEY (`variant_id`)
        REFERENCES `shop_product_variants` (`id`),
    CONSTRAINT `shop_orders_products_fk_0a81b2`
        FOREIGN KEY (`order_id`)
        REFERENCES `shop_orders` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_orders_status_history
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders_status_history`;

CREATE TABLE `shop_orders_status_history`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `order_id` INTEGER NOT NULL,
    `status_id` INTEGER,
    `user_id` INTEGER NOT NULL,
    `date_created` INTEGER,
    `comment` VARCHAR(1000),
    PRIMARY KEY (`id`),
    INDEX `shop_orders_status_history_i_3d3fe8` (`order_id`),
    INDEX `shop_orders_status_history_fi_da0862` (`status_id`),
    CONSTRAINT `shop_orders_status_history_fk_0a81b2`
        FOREIGN KEY (`order_id`)
        REFERENCES `shop_orders` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `shop_orders_status_history_fk_da0862`
        FOREIGN KEY (`status_id`)
        REFERENCES `shop_order_statuses` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_payment_methods
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_payment_methods`;

CREATE TABLE `shop_payment_methods`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1),
    `currency_id` INTEGER(11),
    `payment_system_name` VARCHAR(255),
    `position` INTEGER(11),
    PRIMARY KEY (`id`),
    INDEX `shop_payment_methods_i_ba7161` (`position`),
    INDEX `shop_payment_methods_fi_d4e62d` (`currency_id`),
    CONSTRAINT `shop_payment_methods_fk_d4e62d`
        FOREIGN KEY (`currency_id`)
        REFERENCES `shop_currencies` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_payment_methods_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_payment_methods_i18n`;

CREATE TABLE `shop_payment_methods_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `name` VARCHAR(255),
    `description` TEXT,
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_payment_methods_i18n_i_d94269` (`name`),
    INDEX `shop_payment_methods_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_payment_methods_i18n_fk_a545a0`
        FOREIGN KEY (`id`)
        REFERENCES `shop_payment_methods` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_currencies
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_currencies`;

CREATE TABLE `shop_currencies`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `main` TINYINT(1),
    `is_default` TINYINT(1),
    `code` VARCHAR(5),
    `symbol` VARCHAR(5),
    `rate` DOUBLE (10,4) DEFAULT 1.0000,
    `showOnSite` INT (1) DEFAULT 0,
    `currency_template` VARCHAR(500),
    PRIMARY KEY (`id`),
    INDEX `shop_currencies_i_d94269` (`name`),
    INDEX `shop_currencies_i_695954` (`main`),
    INDEX `shop_currencies_i_6e6a13` (`is_default`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_products_rating
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products_rating`;

CREATE TABLE `shop_products_rating`
(
    `product_id` INTEGER(11) NOT NULL,
    `votes` INTEGER(11) DEFAULT 0,
    `rating` INTEGER(11) DEFAULT 0,
    PRIMARY KEY (`product_id`),
    CONSTRAINT `shop_products_rating_fk_6a9780`
        FOREIGN KEY (`product_id`)
        REFERENCES `shop_products` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_settings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_settings`;

CREATE TABLE `shop_settings`
(
    `name` VARCHAR(255) NOT NULL,
    `value` TEXT,
    `locale` VARCHAR(5) NOT NULL,
    PRIMARY KEY (`name`,`locale`),
    INDEX `shop_settings_i_794a79` (`locale`(5))
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_sorting
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_sorting`;

CREATE TABLE `shop_sorting`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pos` INTEGER(11),
    `get` VARCHAR(25) NOT NULL,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_sorting_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_sorting_i18n`;

CREATE TABLE `shop_sorting_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `name` VARCHAR(50) NOT NULL,
    `name_front` VARCHAR(50),
    `tooltip` VARCHAR(100),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_sorting_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_sorting_i18n_fk_ef8849`
        FOREIGN KEY (`id`)
        REFERENCES `shop_sorting` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `role_id` INTEGER,
    `username` VARCHAR(50),
    `password` VARCHAR(255),
    `email` VARCHAR(100),
    `address` VARCHAR(255),
    `phone` VARCHAR(32),
    `banned` TINYINT(1),
    `ban_reason` VARCHAR(255),
    `newpass` VARCHAR(255),
    `newpass_key` VARCHAR(255),
    `newpass_time` INTEGER,
    `created` INTEGER,
    `last_ip` VARCHAR(40),
    `last_login` INTEGER,
    `modified` DATETIME,
    `cart_data` TEXT,
    `wish_list_data` TEXT,
    `key` VARCHAR(255) NOT NULL,
    `amout` FLOAT (10,2) NOT NULL,
    `discount` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `users_i_b0eafe` (`key`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_callbacks
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_callbacks`;

CREATE TABLE `shop_callbacks`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `status_id` INTEGER,
    `theme_id` INTEGER,
    `phone` VARCHAR(255),
    `name` VARCHAR(255),
    `comment` TEXT,
    `date` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `shop_callbacks_i_6ca017` (`user_id`),
    INDEX `shop_callbacks_i_c2cb46` (`status_id`),
    INDEX `shop_callbacks_i_8b00ea` (`theme_id`),
    INDEX `shop_callbacks_i_d029dc` (`date`),
    CONSTRAINT `shop_callbacks_fk_5ee211`
        FOREIGN KEY (`status_id`)
        REFERENCES `shop_callbacks_statuses` (`id`),
    CONSTRAINT `shop_callbacks_fk_fe6e0b`
        FOREIGN KEY (`theme_id`)
        REFERENCES `shop_callbacks_themes` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_callbacks_statuses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_callbacks_statuses`;

CREATE TABLE `shop_callbacks_statuses`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `is_default` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_callbacks_statuses_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_callbacks_statuses_i18n`;

CREATE TABLE `shop_callbacks_statuses_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `text` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_callbacks_statuses_i18n_i_6801ae` (`text`),
    INDEX `shop_callbacks_statuses_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_callbacks_statuses_i18n_fk_891c2a`
        FOREIGN KEY (`id`)
        REFERENCES `shop_callbacks_statuses` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_callbacks_themes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_callbacks_themes`;

CREATE TABLE `shop_callbacks_themes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `position` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- shop_callbacks_themes_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_callbacks_themes_i18n`;

CREATE TABLE `shop_callbacks_themes_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) NOT NULL,
    `text` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    INDEX `shop_callbacks_themes_i18n_i_6801ae` (`text`),
    INDEX `shop_callbacks_themes_i18n_i_794a79` (`locale`(5)),
    CONSTRAINT `shop_callbacks_themes_i18n_fk_05fa17`
        FOREIGN KEY (`id`)
        REFERENCES `shop_callbacks_themes` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- custom_fields
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_fields`;

CREATE TABLE `custom_fields`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `entity` VARCHAR(32),
    `field_type_id` INTEGER NOT NULL,
    `field_name` VARCHAR(64) NOT NULL,
    `is_required` TINYINT(1) DEFAULT 1 NOT NULL,
    `is_active` TINYINT(1) DEFAULT 1 NOT NULL,
    `options` VARCHAR(65),
    `is_private` TINYINT(1) DEFAULT 0 NOT NULL,
    `validators` VARCHAR(255),
    `classes` TEXT,
    `position` TINYINT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- custom_fields_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_fields_i18n`;

CREATE TABLE `custom_fields_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(4) NOT NULL,
    `field_label` VARCHAR(255),
    `field_description` TEXT,
    `possible_values` TEXT,
    PRIMARY KEY (`id`,`locale`),
    INDEX `custom_fields_i18n_i_f684f9` (`locale`(4)),
    CONSTRAINT `custom_fields_i18n_fk_f33c9c`
        FOREIGN KEY (`id`)
        REFERENCES `custom_fields` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- custom_fields_data
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_fields_data`;

CREATE TABLE `custom_fields_data`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `locale` VARCHAR(4) NOT NULL,
    `field_id` INTEGER NOT NULL,
    `entity_id` INTEGER NOT NULL,
    `field_data` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- smart_filter_patterns
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `smart_filter_patterns`;

CREATE TABLE `smart_filter_patterns`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `category_id` INTEGER(11) NOT NULL,
    `active` TINYINT(1),
    `url_pattern` VARCHAR(255),
    `data` VARCHAR(255),
    `meta_index` TINYINT DEFAULT null,
    `meta_follow` TINYINT DEFAULT null,
    `created` INTEGER(11),
    `updated` INTEGER(11),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `smart_filter_patterns_u_7826e2` (`category_id`, `url_pattern`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- smart_filter_patterns_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `smart_filter_patterns_i18n`;

CREATE TABLE `smart_filter_patterns_i18n`
(
    `id` INTEGER(11) NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'ru' NOT NULL,
    `h1` TEXT,
    `meta_title` TEXT,
    `meta_description` TEXT,
    `meta_keywords` TEXT,
    `seo_text` TEXT,
    `name` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- banners
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `place` VARCHAR(255) NOT NULL,
    `width` INTEGER(5) NOT NULL,
    `height` INTEGER(5) NOT NULL,
    `effects` TEXT,
    `page_type` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- banners_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `banners_i18n`;

CREATE TABLE `banners_i18n`
(
    `id` INTEGER(11) NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'ru' NOT NULL,
    `name` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- banner_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `banner_image`;

CREATE TABLE `banner_image`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `banner_id` INTEGER(11) NOT NULL,
    `target` INTEGER(2),
    `url` VARCHAR(255),
    `allowed_page` INTEGER(11),
    `position` INTEGER(11),
    `active_from` INTEGER(11),
    `active_to` INTEGER(11),
    `active` INTEGER(1),
    `permanent` INTEGER(1),
    PRIMARY KEY (`id`),
    INDEX `banner_image_fi_0bb916` (`banner_id`)
) ENGINE=MYISAM CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- banner_image_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `banner_image_i18n`;

CREATE TABLE `banner_image_i18n`
(
    `id` INTEGER(11) NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'ru' NOT NULL,
    `src` VARCHAR(255),
    `name` VARCHAR(255),
    `clicks` INTEGER(20),
    `description` TEXT,
    PRIMARY KEY (`id`,`locale`)
) ENGINE=MYISAM CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
