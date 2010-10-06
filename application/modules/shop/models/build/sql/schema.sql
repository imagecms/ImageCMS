
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- shop_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_category`;


CREATE TABLE `shop_category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`meta_desc` VARCHAR(255)  NOT NULL,
	`meta_title` VARCHAR(255)  NOT NULL,
	`parent_id` INTEGER,
	`position` INTEGER,
	`full_path` VARCHAR(1000),
	`full_path_ids` VARCHAR(250),
	PRIMARY KEY (`id`),
	KEY `shop_category_I_1`(`name`),
	KEY `shop_category_I_2`(`url`),
	KEY `shop_category_I_3`(`parent_id`),
	KEY `shop_category_I_4`(`position`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products`;


CREATE TABLE `shop_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(500)  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`price` FLOAT  NOT NULL,
	`stock` INTEGER,
	`number` VARCHAR(255),
	`active` TINYINT,
	`hit` TINYINT,
	`brand_id` INTEGER,
	`category_id` INTEGER  NOT NULL,
	`related_products` VARCHAR(255),
	`mainImage` TINYINT,
	`smallImage` TINYINT,
	`short_description` TEXT,
	`full_description` TEXT,
	`meta_title` VARCHAR(255),
	`meta_description` VARCHAR(255),
	`meta_keywords` VARCHAR(255),
	`created` INTEGER  NOT NULL,
	`updated` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `shop_products_I_1`(`name`),
	KEY `shop_products_I_2`(`url`),
	INDEX `shop_products_FI_1` (`brand_id`),
	CONSTRAINT `shop_products_FK_1`
		FOREIGN KEY (`brand_id`)
		REFERENCES `shop_brands` (`id`),
	INDEX `shop_products_FI_2` (`category_id`),
	CONSTRAINT `shop_products_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `shop_category` (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_brands
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_brands`;


CREATE TABLE `shop_brands`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(500)  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`meta_title` VARCHAR(255),
	`meta_description` VARCHAR(255),
	`meta_keywords` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `shop_brands_I_1`(`name`),
	KEY `shop_brands_I_2`(`url`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_product_variants
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_variants`;


CREATE TABLE `shop_product_variants`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`product_id` INTEGER  NOT NULL,
	`name` VARCHAR(500)  NOT NULL,
	`price` FLOAT  NOT NULL,
	`number` VARCHAR(255),
	`stock` INTEGER,
	`position` INTEGER,
	PRIMARY KEY (`id`),
	KEY `shop_product_variants_I_1`(`position`),
	INDEX `shop_product_variants_FI_1` (`product_id`),
	CONSTRAINT `shop_product_variants_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `shop_products` (`id`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_product_categories
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_categories`;


CREATE TABLE `shop_product_categories`
(
	`product_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	PRIMARY KEY (`product_id`,`category_id`),
	CONSTRAINT `shop_product_categories_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `shop_products` (`id`),
	INDEX `shop_product_categories_FI_2` (`category_id`),
	CONSTRAINT `shop_product_categories_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `shop_category` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_product_properties
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties`;


CREATE TABLE `shop_product_properties`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50)  NOT NULL,
	`active` TINYINT,
	`show_in_compare` TINYINT,
	`position` INTEGER  NOT NULL,
	`data` TEXT,
	PRIMARY KEY (`id`),
	KEY `shop_product_properties_I_1`(`name`),
	KEY `shop_product_properties_I_2`(`show_in_compare`),
	KEY `shop_product_properties_I_3`(`position`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_product_properties_categories
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties_categories`;


CREATE TABLE `shop_product_properties_categories`
(
	`property_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	PRIMARY KEY (`property_id`,`category_id`),
	CONSTRAINT `shop_product_properties_categories_FK_1`
		FOREIGN KEY (`property_id`)
		REFERENCES `shop_product_properties` (`id`),
	INDEX `shop_product_properties_categories_FI_2` (`category_id`),
	CONSTRAINT `shop_product_properties_categories_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `shop_category` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_product_properties_data
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_properties_data`;


CREATE TABLE `shop_product_properties_data`
(
	`property_id` INTEGER  NOT NULL,
	`product_id` INTEGER  NOT NULL,
	`value` VARCHAR(500)  NOT NULL,
	PRIMARY KEY (`property_id`,`product_id`),
	KEY `shop_product_properties_data_I_1`(`value`),
	CONSTRAINT `shop_product_properties_data_FK_1`
		FOREIGN KEY (`property_id`)
		REFERENCES `shop_product_properties` (`id`),
	INDEX `shop_product_properties_data_FI_2` (`product_id`),
	CONSTRAINT `shop_product_properties_data_FK_2`
		FOREIGN KEY (`product_id`)
		REFERENCES `shop_products` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_delivery_methods
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_delivery_methods`;


CREATE TABLE `shop_delivery_methods`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(500)  NOT NULL,
	`description` TEXT,
	`price` FLOAT  NOT NULL,
	`free_from` FLOAT  NOT NULL,
	`enabled` TINYINT,
	PRIMARY KEY (`id`),
	KEY `shop_delivery_methods_I_1`(`name`),
	KEY `shop_delivery_methods_I_2`(`enabled`)
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_orders
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders`;


CREATE TABLE `shop_orders`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`key` VARCHAR(255)  NOT NULL,
	`delivery_method` INTEGER,
	`delivery_price` FLOAT,
	`status` SMALLINT,
	`paid` TINYINT,
	`user_full_name` VARCHAR(255),
	`user_email` VARCHAR(255),
	`user_phone` VARCHAR(255),
	`user_deliver_to` VARCHAR(500),
	`user_comment` VARCHAR(1000),
	`date_created` INTEGER,
	`date_updated` INTEGER,
	`user_ip` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `shop_orders_I_1`(`key`),
	KEY `shop_orders_I_2`(`status`),
	KEY `shop_orders_I_3`(`date_created`),
	INDEX `shop_orders_FI_1` (`delivery_method`),
	CONSTRAINT `shop_orders_FK_1`
		FOREIGN KEY (`delivery_method`)
		REFERENCES `shop_delivery_methods` (`id`)
		ON DELETE SET NULL
) ENGINE=MyISAM;

#-----------------------------------------------------------------------------
#-- shop_orders_products
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders_products`;


CREATE TABLE `shop_orders_products`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`order_id` INTEGER  NOT NULL,
	`product_id` INTEGER  NOT NULL,
	`variant_id` INTEGER  NOT NULL,
	`product_name` VARCHAR(255),
	`variant_name` VARCHAR(255),
	`price` FLOAT,
	`quantity` INTEGER,
	PRIMARY KEY (`id`),
	KEY `shop_orders_products_I_1`(`order_id`),
	INDEX `shop_orders_products_FI_1` (`product_id`),
	CONSTRAINT `shop_orders_products_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `shop_products` (`id`),
	CONSTRAINT `shop_orders_products_FK_2`
		FOREIGN KEY (`order_id`)
		REFERENCES `shop_orders` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
