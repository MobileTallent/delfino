<?php
include_once('databaseValues.php');
$conn = @mysql_pconnect($hostName,$dbUserName,$dbPassword) or die("Database Connection Failed<br>". mysql_error());

mysql_select_db($databaseName, $conn) or die('DB not selected'); 

//echo 'Add log success '.mysql_query("INSERT INTO  `fc_layout` (`place`)VALUES ('login success msg');");

echo 'Add shorturl '.mysql_query("CREATE TABLE if not exists `fc_short_url` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `short_url` mediumtext NOT NULL,
 `long_url` longtext NOT NULL,
 `view_count` int(11) NOT NULL,
 `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `product_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=183 DEFAULT CHARSET=utf8");

echo 'Add upload requests '.mysql_query("CREATE TABLE if not exists `fc_upload_requests` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `message` blob NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8");

echo 'Add upload mails '.mysql_query("CREATE TABLE if not exists `fc_upload_mails` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `user_name` text NOT NULL,
 `title` text NOT NULL,
 `comment` longtext NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");

echo 'Add contact seller '.mysql_query("CREATE TABLE if not exists `fc_contact_seller` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `question` longblob NOT NULL,
 `name` varchar(500) NOT NULL,
 `email` varchar(500) NOT NULL,
 `phone` varchar(100) NOT NULL,
 `selleremail` varchar(500) NOT NULL,
 `sellerid` int(11) NOT NULL,
 `product_id` int(11) NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1");

echo 'Alter product suid '.mysql_query("ALTER TABLE  `fc_product` ADD  `short_url_id` BIGINT NOT NULL");
echo 'Alter product suid '.mysql_query("ALTER TABLE  `fc_user_product` ADD  `short_url_id` BIGINT NOT NULL");

//echo 'Insert contact seller template '.mysql_query("INSERT INTO `fc_newsletter` (`id`, `news_title`, `news_descrip`, `status`, `dateAdded`, `news_image`, `news_subject`, `sender_name`, `sender_email`) VALUES ('20', 'contactseller', 0x3c7461626c6520626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d2236343022206267636f6c6f723d2223376461326331223e5c725c6e3c74626f64793e5c725c6e3c74723e5c725c6e3c7464207374796c653d2270616464696e673a20343070783b223e5c725c6e3c7461626c65207374796c653d22626f726465723a20233164343536372031707820736f6c69643b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e732d73657269663b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d2230222077696474683d22363130223e5c725c6e3c74626f64793e5c725c6e3c74723e5c725c6e3c74643e3c6120687265663d227b626173655f75726c28297d223e3c696d67207374796c653d226d617267696e3a20313570782035707820303b2070616464696e673a203070783b20626f726465723a206e6f6e653b22207372633d227b626173655f75726c28297d696d616765732f6c6f676f2f7b246c6f676f7d2220616c743d227b246d6574615f7469746c657d22202f3e3c2f613e3c2f74643e5c725c6e3c2f74723e5c725c6e3c74723e5c725c6e3c74642076616c69676e3d22746f70223e5c725c6e3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e5c725c6e3c74626f64793e5c725c6e3c74723e5c725c6e3c746420636f6c7370616e3d2232223e5c725c6e3c6833207374796c653d2270616464696e673a203130707820313570783b206d617267696e3a203070783b20636f6c6f723a20233064343837613b223e436f6e746163742053656c6c65723c2f68333e5c725c6e3c70207374796c653d2270616464696e673a203070782031357078203130707820313570783b20666f6e742d73697a653a20313270783b206d617267696e3a203070783b223e266e6273703b3c2f703e5c725c6e3c2f74643e5c725c6e3c2f74723e5c725c6e3c74723e5c725c6e3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e5c725c6e3c703e3c7374726f6e673e436f6e74616374204e616d65203a3c2f7374726f6e673e207b246e616d657d3c2f703e5c725c6e3c703e3c7374726f6e673e436f6e7461637420456d61696c203a3c2f7374726f6e673e207b24656d61696c7d3c2f703e5c725c6e3c703e3c7374726f6e673e436f6e746163742050686f6e65203a3c2f7374726f6e673e207b2470686f6e657d3c2f703e5c725c6e3c703e3c7374726f6e673e436f6e74616374205175657374696f6e203a3c2f7374726f6e673e207b247175657374696f6e7d3c2f703e5c725c6e3c2f74643e5c725c6e3c2f74723e5c725c6e3c74723e5c725c6e3c2f74723e5c725c6e3c2f74626f64793e5c725c6e3c2f7461626c653e5c725c6e3c7461626c65207374796c653d2277696474683a20313030253b2220626f726465723d2230222063656c6c73706163696e673d2230222063656c6c70616464696e673d223022206267636f6c6f723d2223464646464646223e5c725c6e3c74626f64793e5c725c6e3c74723e5c725c6e3c74643e50726f64756374204e616d653c2f74643e5c725c6e3c74643e50726f6475637420496d6167653c2f74643e5c725c6e3c2f74723e5c725c6e3c74723e5c725c6e3c74643e3c6120687265663d227b626173655f75726c28297d7468696e67732f7b2470726f6475637449647d2f7b2470726f6475637453656f75726c7d223e7b2470726f647563744e616d657d3c2f613e3c2f74643e5c725c6e3c74643e3c696d67207372633d22696d616765732f70726f647563742f7b2470726f647563744e616d657d2220616c743d227b2470726f64756374496d6167657d222077696474683d2231303022202f3e3c2f74643e5c725c6e3c2f74723e5c725c6e3c2f74626f64793e5c725c6e3c2f7461626c653e5c725c6e3c2f74643e5c725c6e3c2f74723e5c725c6e3c74723e5c725c6e3c7464207374796c653d22666f6e742d73697a653a20313270783b2070616464696e673a203130707820313570783b222076616c69676e3d22746f70223e5c725c6e3c703e266e6273703b3c2f703e5c725c6e3c703e3c7374726f6e673e2d207b24656d61696c5f7469746c657d205465616d3c2f7374726f6e673e3c2f703e5c725c6e3c2f74643e5c725c6e3c2f74723e5c725c6e3c2f74626f64793e5c725c6e3c2f7461626c653e5c725c6e3c2f74643e5c725c6e3c2f74723e5c725c6e3c2f74626f64793e5c725c6e3c2f7461626c653e, 'Active', '2014-02-19 00:00:00', '', 'Someone Contacts You', 'Fancyclone V2 for google', 'sample@sample.com');");

mysql_close();

 ?>