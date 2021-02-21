CREATE TABLE `products` (
  `product_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `vendor` varchar(50) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `price` float DEFAULT '0',
  `handle` varchar(75) DEFAULT NULL,
  `inventory_quantity` int(11) NOT NULL DEFAULT '0',
  `sku` varchar(30) DEFAULT NULL,
  `design_url` varchar(255) DEFAULT NULL,
  `published_state` enum('inactive','active') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `title` (`title`),
  KEY `vendor` (`vendor`),
  KEY `type` (`type`),
  KEY `sku` (`sku`),
  KEY `size` (`size`),
  KEY `published_state` (`published_state`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `orders` (
  `order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `total_price` float DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `fulfillment_status` varchar(25) DEFAULT NULL,
  `fulfilled_date` timestamp NULL DEFAULT NULL,
  `order_status` enum('pending','active','done','cancelled','resend') DEFAULT NULL,
  `customer_order_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `order_number` (`order_number`),
  KEY `customer_id` (`customer_id`),
  KEY `fulfillment_status` (`fulfillment_status`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `orders_items` (
  `order_item_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `refund` bigint(20) DEFAULT '0',
  `resend_amount` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_item_id`),
  UNIQUE KEY `order_product` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  KEY `refunded` (`refund`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `print_sheet` (
  `ps_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('ecom','test') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ecom',
  `sheet_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ps_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `print_sheet_item` (
  `psi_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ps_id` int(10) unsigned NOT NULL,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `status` enum('pass','reject','complete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pass',
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `x_pos` int(11) NOT NULL,
  `y_pos` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  PRIMARY KEY (`psi_id`),
  KEY `ps_id` (`ps_id`),
  KEY `status` (`status`),
  KEY `print_sheet_item_ibfk_3` (`product_id`),
  KEY `print_sheet_item_ibfk_4` (`order_id`),
  CONSTRAINT `print_sheet_item_ibfk_1` FOREIGN KEY (`ps_id`) REFERENCES `print_sheet` (`ps_id`),
  CONSTRAINT `print_sheet_item_ibfk_2` FOREIGN KEY (`order_item_id`) REFERENCES `orders` (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
