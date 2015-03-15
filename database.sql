CREATE TABLE IF NOT EXISTS `tbl_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` smallint(1) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `price_type` tinyint(1) DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '-1',
  `state` int(2) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ads_category` (`category_id`),
  KEY `fk_ads_owner` (`create_user_id`),
  KEY `fk_ads_update_user` (`update_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_ads_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(100) DEFAULT NULL,
  `ads_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ads_id` (`ads_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_parent` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

INSERT INTO `tbl_category` (`id`, `name`, `description`, `parent_id`) VALUES
(1, 'تجهيزات و ماشين آلات كارخانجات و معادن', 'kkkkkkkkkkkkkkkkkkkkk', NULL),
(2, 'صنايع نفت گاز  پتروشيمي و پالايشگاهي', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 1),
(3, 'صنايع شيميايي', '', 1),
(6, 'صنايع نيروگاهي و انتقال و توزيع  برق', '', 1),
(7, 'صنايع فولاد و ريخته گري و فلزي', '', 1),
(8, 'صنايع ماشين سازي و قالب', '', 1),
(9, 'صنايع غذايي', '', 1),
(10, 'صنايع ساختماني', '', 1),
(11, 'صنايع حمل و نقل و ترابري', '', 1),
(12, 'ماشين هاي راه سازي', '', 11),
(13, 'ماشين هاي معدني', '', 11),
(14, 'ماشين هاي  ساختمان سازي', '', 11),
(15, 'ماشين هاي جابجايي كالا و جرثقيل', '', 11),
(16, 'سايرماشين ها و تجهيزات مربوط به صنعت حمل و نقل', '', 11),
(17, 'صنايع معدني', '', 1),
(18, 'صنايع كشاورزي', '', 1),
(19, 'صنايع داروسازي و پزشكي', '', 1),
(20, 'صنايع حرارتي و برودتي', '', 1),
(21, 'صنايع ساخت ', '', 1),
(22, 'صنايع پوشاك', '', 1),
(23, 'تجهيزات كمكي  مشترك صنايع', '', 1),
(24, 'ساير صنايع', '', 1);

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `create_user_id` (`create_user_id`),
  KEY `update_user_id` (`update_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_post_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(100) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `key`, `value`) VALUES
(1, 'title', 'تاس کباب'),
(2, 'about', 'محتویات این صفحه از طریق پنل ادمین قابل تغییر است.'),
(3, 'smsuser', 'vip34'),
(4, 'smspass', 'sms123456'),
(5, 'smsnumber', '5000264439'),
(6, 'smstext', 'به تاس کباب خوش آمدید!\r\nکد تایید شما: {code}'),
(7, 'description', 'بانک اطلاعات تجهیزات و ماشین آلات صنایع، کالاها و اجناس نو و مستعمل و خدمات فنی و عمومی'),
(8, 'adminEmail', ':)'),
(9, 'ads1-img', '/taskabab/theme/img/banner.gif'),
(10, 'ads1-link', '#'),
(11, 'ads2-img', '/taskabab/theme/img/banner.gif'),
(12, 'ads2-link', '#'),
(13, 'ads3-img', ''),
(14, 'ads3-link', ''),
(15, 'ads4-img', ''),
(16, 'ads4-link', ''),
(17, 'ads5-img', ''),
(18, 'ads5-link', ''),
(19, 'ads6-img', ''),
(20, 'ads6-link', ''),
(21, 'ads7-img', ''),
(22, 'ads7-link', ''),
(23, 'ads8-img', ''),
(24, 'ads8-link', ''),
(25, 'ads9-img', ''),
(26, 'ads9-link', ''),
(27, 'ads10-img', ''),
(28, 'ads10-link', ''),
(29, 'ads11-img', ''),
(30, 'ads11-link', ''),
(31, 'ads12-img', ''),
(32, 'ads12-link', ''),
(33, 'ads13-img', ''),
(34, 'ads13-link', ''),
(35, 'ads14-img', ''),
(36, 'ads14-link', ''),
(37, 'ads15-img', ''),
(38, 'ads15-link', ''),
(39, 'ads16-img', ''),
(40, 'ads16-link', ''),
(41, 'ads17-img', ''),
(42, 'ads17-link', ''),
(43, 'ads18-img', ''),
(44, 'ads18-link', ''),
(45, 'ads19-img', ''),
(46, 'ads19-link', '');

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` int(6) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `address` text,
  `last_login_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `tbl_ads`
  ADD CONSTRAINT `fk_ads_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`),
  ADD CONSTRAINT `fk_ads_owner` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `fk_ads_update_user` FOREIGN KEY (`update_user_id`) REFERENCES `tbl_user` (`id`);

ALTER TABLE `tbl_ads_images`
  ADD CONSTRAINT `fk_ads_images` FOREIGN KEY (`ads_id`) REFERENCES `tbl_ads` (`id`);

ALTER TABLE `tbl_category`
  ADD CONSTRAINT `fk_category_parent` FOREIGN KEY (`parent_id`) REFERENCES `tbl_category` (`id`);

ALTER TABLE `tbl_post`
  ADD CONSTRAINT `fk_post_author` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_post_update_id` FOREIGN KEY (`update_user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

ALTER TABLE `tbl_post_attachments`
  ADD CONSTRAINT `fk_post_images` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`);

