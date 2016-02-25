
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

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
