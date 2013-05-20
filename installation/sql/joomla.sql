# $Id: joomla.sql 6070 2006-12-20 02:09:09Z robs $

#
# Table structure for table `#__banner`
#

CREATE TABLE `#__banner` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(10) NOT NULL default 'banner',
  `name` varchar(50) NOT NULL default '',
  `imptotal` int(11) NOT NULL default '0',
  `impmade` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(100) NOT NULL default '',
  `clickurl` varchar(200) NOT NULL default '',
  `date` datetime default NULL,
  `showBanner` tinyint(1) NOT NULL default '0',
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `custombannercode` text,
  PRIMARY KEY  (`bid`),
  KEY `viewbanner` (`showBanner`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Table structure for table `#__bannerclient`
#

CREATE TABLE `#__bannerclient` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `contact` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL default '0',
  `checked_out_time` time default NULL,
  `editor` varchar(50) default NULL,
  PRIMARY KEY  (`cid`)
) TYPE=MyISAM;

#
# Table structure for table `#__bannerfinish`
#

CREATE TABLE `#__bannerfinish` (
  `bid` int(11) NOT NULL auto_increment,
  `cid` int(11) NOT NULL default '0',
  `type` varchar(10) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `impressions` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `imageurl` varchar(50) NOT NULL default '',
  `datestart` datetime default NULL,
  `dateend` datetime default NULL,
  PRIMARY KEY  (`bid`)
) TYPE=MyISAM;

#
# Table structure for table `#__categories`
#

CREATE TABLE `#__categories` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default 0,
  `title` varchar(50) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `image` varchar(100) NOT NULL default '',
  `section` varchar(50) NOT NULL default '',
  `image_position` varchar(10) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `editor` varchar(50) default NULL,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_section` (`section`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) TYPE=MyISAM;

#
# Table structure for table `#__components`
#

CREATE TABLE `#__components` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `menuid` int(11) unsigned NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `admin_menu_link` varchar(255) NOT NULL default '',
  `admin_menu_alt` varchar(255) NOT NULL default '',
  `option` varchar(50) NOT NULL default '',
  `ordering` int(11) NOT NULL default '0',
  `admin_menu_img` varchar(255) NOT NULL default '',
  `iscore` tinyint(4) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `#__components`
#

INSERT INTO `#__components` VALUES (1, 'Bannières', '', 0, 0, '', 'Gestion des bannières', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, '');
INSERT INTO `#__components` VALUES (2, 'Gérer les bannières', '', 0, 1, 'option=com_banners', 'Bannières actives', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '');
INSERT INTO `#__components` VALUES (3, 'Gérer les clients', '', 0, 1, 'option=com_banners&task=listclients', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '');
INSERT INTO `#__components` VALUES (4, 'Liens web', 'option=com_weblinks', 0, 0, '', 'Gestion des liens web', 'com_weblinks', 0, 'js/ThemeOffice/globe2.png', 0, '');
INSERT INTO `#__components` VALUES (5, 'Liens web', '', 0, 4, 'option=com_weblinks', 'Voir les liens web existantss', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, '');
INSERT INTO `#__components` VALUES (6, 'Catégories de liens web', '', 0, 4, 'option=categories&section=com_weblinks', 'Gestion des catégories de liens web', '', 2, 'js/ThemeOffice/categories.png', 0, '');
INSERT INTO `#__components` VALUES (7, 'Contacts', 'option=com_contact', 0, 0, '', 'Gestion des contacts', 'com_contact', 0, 'js/ThemeOffice/user.png', 1, '');
INSERT INTO `#__components` VALUES (8, 'Gérer les contacts', '', 0, 7, 'option=com_contact', 'Editer les contacts', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '');
INSERT INTO `#__components` VALUES (9, 'Catégories de contacts', '', 0, 7, 'option=categories&section=com_contact_details', 'Gestion des catégories de contacts', '', 2, 'js/ThemeOffice/categories.png', 1, '');
INSERT INTO `#__components` VALUES (10, 'Page d&#146;accueil', 'option=com_frontpage', 0, 0, '', 'Gestion des articles de la page d&#146;accueil', 'com_frontpage', 0, 'js/ThemeOffice/component.png', 1, '');
INSERT INTO `#__components` VALUES (11, 'Sondage', 'option=com_poll', 0, 0, 'option=com_poll', 'Gestion des sondages', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, '');
INSERT INTO `#__components` VALUES (12, 'Flux RSS', 'option=com_newsfeeds', 0, 0, '', 'Gestion des Flux RSS', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, '');
INSERT INTO `#__components` VALUES (13, 'Gérer les flux RSS', '', 0, 12, 'option=com_newsfeeds', 'Gestion des Flux RSS', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, '');
INSERT INTO `#__components` VALUES (14, 'Gérer les catégories', '', 0, 12, 'option=com_categories&section=com_newsfeeds', 'Gestion des catégories', '', 2, 'js/ThemeOffice/categories.png', 0, '');
INSERT INTO `#__components` VALUES (15, 'Identification', 'option=com_login', 0, 0, '', '', 'com_login', 0, '', 1, '');
INSERT INTO `#__components` VALUES (16, 'Recherche', 'option=com_search', 0, 0, '', '', 'com_search', 0, '', 1, '');
INSERT INTO `#__components` VALUES (17, 'Syndication', '', 0, 0, 'option=com_syndicate&hidemainmenu=1', 'Paramètres de syndication', 'com_syndicate', 0, 'js/ThemeOffice/component.png', 0, '');
INSERT INTO `#__components` VALUES (18, 'Mailing', '', 0, 0, 'option=com_massmail&hidemainmenu=1', 'Envoyer un mailing', 'com_massmail', 0, 'js/ThemeOffice/mass_email.png', 0, '');
INSERT INTO `#__components` VALUES (19, 'Mafiajob', 'option=com_mafiajob', 0, 0, 'option=com_mafiajob', 'Mafiajob', 'com_mafiajob', 0, 'js/ThemeOffice/globe2.png', 0, '');
INSERT INTO `#__components` VALUES (20, 'Scores', 'option=com_scores', 0, 0, '', '', 'com_scores', 0, 'js/ThemeOffice/globe2.png', 0, '');
INSERT INTO `#__components` VALUES (21, 'Journal', 'option=com_journal', 0, 0, '', '', 'com_journal', 0, 'js/ThemeOffice/globe2.png', 0, '');

# --------------------------------------------------------

#
# Table structure for table `#__contact_details`
#

CREATE TABLE `#__contact_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `con_position` varchar(50) default NULL,
  `address` text,
  `suburb` varchar(50) default NULL,
  `state` varchar(20) default NULL,
  `country` varchar(50) default NULL,
  `postcode` varchar(10) default NULL,
  `telephone` varchar(25) default NULL,
  `fax` varchar(25) default NULL,
  `misc` mediumtext,
  `image` varchar(100) default NULL,
  `imagepos` varchar(20) default NULL,
  `email_to` varchar(100) default NULL,
  `default_con` tinyint(1) unsigned NOT NULL default '0',
  `published` tinyint(1) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Table structure for table `#__content`
#

CREATE TABLE `#__content` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `title_alias` varchar(100) NOT NULL default '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `sectionid` int(11) unsigned NOT NULL default '0',
  `mask` int(11) unsigned NOT NULL default '0',
  `catid` int(11) unsigned NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL default '0',
  `created_by_alias` varchar(100) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL default '1',
  `parentid` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_mask` (`mask`)
) TYPE=MyISAM;

#
# Table structure for table `#__content_frontpage`
#

CREATE TABLE `#__content_frontpage` (
  `content_id` int(11) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`content_id`)
) TYPE=MyISAM;

#
# Table structure for table `#__content_rating`
#

CREATE TABLE `#__content_rating` (
  `content_id` int(11) NOT NULL default '0',
  `rating_sum` int(11) unsigned NOT NULL default '0',
  `rating_count` int(11) unsigned NOT NULL default '0',
  `lastip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`content_id`)
) TYPE=MyISAM;

#
# Table structure for table `#__core_log_items`
#
# To be implemented

CREATE TABLE `#__core_log_items` (
  `time_stamp` date NOT NULL default '0000-00-00',
  `item_table` varchar(50) NOT NULL default '',
  `item_id` int(11) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '0'
) TYPE=MyISAM;

#
# Table structure for table `#__core_log_searches`
#
# To be implemented

CREATE TABLE `#__core_log_searches` (
  `search_term` varchar(128) NOT NULL default '',
  `hits` int(11) unsigned NOT NULL default '0'
) TYPE=MyISAM;

#
# Table structure for table `#__groups`
#

CREATE TABLE `#__groups` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `#__groups`
#

INSERT INTO `#__groups` VALUES (0, 'Public');
INSERT INTO `#__groups` VALUES (1, 'Membre');
INSERT INTO `#__groups` VALUES (2, 'Special');
# --------------------------------------------------------

#
# Table structure for table `#__mambots`
#

CREATE TABLE `#__mambots` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `element` varchar(100) NOT NULL default '',
  `folder` varchar(100) NOT NULL default '',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `published` tinyint(3) NOT NULL default '0',
  `iscore` tinyint(3) NOT NULL default '0',
  `client_id` tinyint(3) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) TYPE=MyISAM;

INSERT INTO `#__mambots` VALUES (1,'MOS Image','mosimage','content',0,-10000,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (2,'MOS Pagination','mospaging','content',0,10000,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (3,'Legacy Mambot Includer','legacybots','content',0,1,0,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (4,'SEF','mossef','content',0,3,1,0,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (5,'MOS Rating','mosvote','content',0,4,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (6,'Recherche dans les articles','content.searchbot','search',0,1,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (7,'Recherche dans les liens web','weblinks.searchbot','search',0,2,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (8,'Code support','moscode','content',0,2,0,0,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (9,'Aucun éditeur WYSIWYG','none','editors',0,0,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (10,'Editeur TinyMCE WYSIWYG','tinymce','editors',0,0,1,1,0,0,'0000-00-00 00:00:00','theme=advanced\ncleanup=1\nautosave=0\ncompressed=0\ntext_direction=ltr\nrelative_urls=0\ninvalid_elements=applet\ncontent_css=0\ncontent_css_custom=\nnewlines=0\ntoolbar=top\nsmilies=1\ntable=1\nflash=1\nmedia=1\nhr=1\nstyle=1\nlayer=1\nvisualchars=1\nnonbreaking=1\nfullscreen=1\nhtml_height=550\nhtml_width=750\npreview=1\npreview_height=550\npreview_width=750\nsearchreplace=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S');
INSERT INTO `#__mambots` VALUES (11,'Bouton MOS Image éditeur','mosimage.btn','editors-xtd',0,0,1,0,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (12,'Bouton MOS Pagebreak éditeur','mospage.btn','editors-xtd',0,0,1,0,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (13,'Recherche dans les contacts','contacts.searchbot','search',0,3,1,1,0,0,'0000-00-00 00:00:00','');
INSERT INTO `#__mambots` VALUES (14, 'Recherche dans les catégories', 'categories.searchbot', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `#__mambots` VALUES (15, 'Recherche dans les sections', 'sections.searchbot', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `#__mambots` VALUES (16, 'Email Cloaking', 'mosemailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `#__mambots` VALUES (17, 'GeSHi', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `#__mambots` VALUES (18, 'Recherche dans les flux RSS', 'newsfeeds.searchbot', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
INSERT INTO `#__mambots` VALUES (19, 'Chargeur de positions de module', 'mosloadposition', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', '');
# --------------------------------------------------------

#
# Table structure for table `#__menu`
#

CREATE TABLE `#__menu` (
  `id` int(11) NOT NULL auto_increment,
  `menutype` varchar(25) default NULL,
  `name` varchar(100) default NULL,
  `link` text,
  `type` varchar(50) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `componentid` int(11) unsigned NOT NULL default '0',
  `sublevel` int(11) default '0',
  `ordering` int(11) default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL default '0',
  `browserNav` tinyint(4) default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `utaccess` tinyint(3) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) TYPE=MyISAM;


INSERT INTO `#__menu` VALUES (1, 'mainmenu', 'Accueil', 'index.php?option=com_frontpage', 'components', -2, 0, 10, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'leading=1\r\nintro=2\r\nlink=1\r\nimage=1\r\npage_title=0\r\nheader=Bienvenue sur la page accueil\r\norderby_sec=front\r\nprint=0\r\npdf=0\r\nemail=0\r\nback_button=0');


# --------------------------------------------------------

#
# Table structure for table `#__messages`
#

CREATE TABLE `#__messages` (
  `message_id` int(10) unsigned NOT NULL auto_increment,
  `user_id_from` int(10) unsigned NOT NULL default '0',
  `user_id_to` int(10) unsigned NOT NULL default '0',
  `folder_id` int(10) unsigned NOT NULL default '0',
  `date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` int(11) NOT NULL default '0',
  `priority` int(1) unsigned NOT NULL default '0',
  `subject` varchar(230) NOT NULL default '',
  `message` text NOT NULL,
  PRIMARY KEY  (`message_id`)
) TYPE=MyISAM;

#
# Table structure for table `#__messages_cfg`
#

CREATE TABLE `#__messages_cfg` (
  `user_id` int(10) unsigned NOT NULL default '0',
  `cfg_name` varchar(100) NOT NULL default '',
  `cfg_value` varchar(255) NOT NULL default '',
  UNIQUE `idx_user_var_name` (`user_id`,`cfg_name`)
) TYPE=MyISAM;

#
# Table structure for table `#__modules`
#

CREATE TABLE `#__modules` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL default '0',
  `position` varchar(10) default NULL,
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `module` varchar(50) default NULL,
  `numnews` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `showtitle` tinyint(3) unsigned NOT NULL default '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) TYPE=MyISAM;

#
# Dumping data for table `#__modules`
#


INSERT INTO `#__modules` VALUES (1, 'Sondage', '', 6, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_poll', 0, 0, 1, 'cache=0\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (2, 'Menu utilisateur', '', 2, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 1, 1, 'class_sfx=\nmoduleclass_sfx=\nmenutype=usermenu\nmenu_style=vert_indent\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 1, 0);
INSERT INTO `#__modules` VALUES (3, 'Menu principal', '', 15, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_mainmenu', 0, 0, 1, 'class_sfx=\nmoduleclass_sfx=\nmenutype=mainmenu\nmenu_style=vert_indent\nfull_active_id=0\ncache=0\nmenu_images=0\nmenu_images_align=0\nexpand_menu=0\nactivate_parent=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=', 1, 0);
INSERT INTO `#__modules` VALUES (4, 'Identification', '', 3, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'moduleclass_sfx=\npretext=\nposttext=\nlogin=\nlogout=\nlogin_message=0\nlogout_message=0\ngreeting=1\nname=0', 1, 0);
INSERT INTO `#__modules` VALUES (5, 'Syndication', '', 5, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_rssfeed', 0, 0, 1, 'text=\ncache=0\nmoduleclass_sfx=\nrss091=1\nrss10=1\nrss20=1\natom=1\nopml=1\nrss091_image=\nrss10_image=\nrss20_image=\natom_image=\nopml_image=', 1, 0);
INSERT INTO `#__modules` VALUES (6, 'Derniers articles', '', 1, 'user7', 0, '0000-00-00 00:00:00', 1, 'mod_latestnews', 0, 0, 1, 'moduleclass_sfx=\ncache=0\ntype=1\nshow_front=1\ncount=5\ncatid=\nsecid=', 1, 0);
INSERT INTO `#__modules` VALUES (7, 'Statistiques', '', 9, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_stats', 0, 0, 1, 'serverinfo=1\nsiteinfo=1\ncounter=1\nincrease=0\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (8, 'Qui est en ligne', '', 4, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_whosonline', 0, 0, 1, 'showmode=0\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (9, 'Articles les plus lus', '', 2, 'user7', 0, '0000-00-00 00:00:00', 1, 'mod_mostread', 0, 0, 1, 'moduleclass_sfx=\ncache=0\ntype=1\nshow_front=1\ncount=5\ncatid=\nsecid=', 0, 0);
INSERT INTO `#__modules` VALUES (10, 'Sélecteur de template', '', 14, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_templatechooser', 0, 0, 1, 'title_length=20\nshow_preview=1\npreview_width=140\npreview_height=90\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (11, 'Archive', '', 10, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_archive', 0, 0, 1, 'count=10\ncache=0\nmoduleclass_sfx=', 1, 0);
INSERT INTO `#__modules` VALUES (12, 'Sections', '', 11, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_sections', 0, 0, 1, 'count=5\nmoduleclass_sfx=', 1, 0);
INSERT INTO `#__modules` VALUES (13, 'Flash info', '', 7, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_newsflash', 0, 0, 1, 'catid=0\nstyle=random\nimage=0\nlink_titles=\nreadmore=0\nitem_title=0\nitems=\ncache=0\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (14, 'Articles similaires', '', 12, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_related_items', 0, 0, 1, 'cache=0\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (15, 'Recherche', '', 1, 'search', 0, '0000-00-00 00:00:00', 1, 'mod_search', 0, 0, 0, 'moduleclass_sfx=\ncache=0\nset_itemid=\nwidth=20\ntext=\nbutton=\nbutton_pos=right\nbutton_text=', 0, 0);
INSERT INTO `#__modules` VALUES (16, 'Image aléatoire', '', 8, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_random_image', 0, 0, 1, 'type=jpg\nfolder=\nlink=\nwidth=\nheight=\nmoduleclass_sfx=', 0, 0);
INSERT INTO `#__modules` VALUES (18, 'Bannières', '', 1, 'banner', 62, '2009-01-17 17:10:32', 1, 'mod_banners', 0, 0, 0, 'banner_cids=\nmoduleclass_sfx=', 1, 0);
INSERT INTO `#__modules` VALUES (19, 'Composants', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_components', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (20, 'Les plus lus', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 99, 1, '', 0, 1);
INSERT INTO `#__modules` VALUES (21, 'Derniers articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 99, 1, '', 0, 1);
INSERT INTO `#__modules` VALUES (22, 'Stats des menus', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 99, 1, '', 0, 1);
INSERT INTO `#__modules` VALUES (23, 'Messages non lus', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (24, 'Utilisateurs en ligne', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (25, 'Menu entier', '', 1, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_fullmenu', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (26, 'Chemin', '', 1, 'pathway', 0, '0000-00-00 00:00:00', 1, 'mod_pathway', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (27, 'Barre d&#146;outils', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (28, 'Message système', '', 1, 'inset', 0, '0000-00-00 00:00:00', 1, 'mod_mosmsg', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (29, 'Icônes raccourcis', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 99, 1, '', 1, 1);
INSERT INTO `#__modules` VALUES (38, 'Compteur', '', 1, 'user12', 0, '0000-00-00 00:00:00', 1, 'mod_wub_compteur', 0, 0, 0, '', 0, 0);
INSERT INTO `#__modules` VALUES (31, 'Wrapper', '', 13, 'user1', 0, '0000-00-00 00:00:00', 0, 'mod_wrapper', 0, 0, 1, 'moduleclass_sfx=\nurl=\nscrolling=auto\nwidth=100%\nheight=200\nheight_auto=1\nadd=1', 0, 0);
INSERT INTO `#__modules` VALUES (32, 'Connectés', '', 0, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 99, 1, '', 0, 1);
INSERT INTO `#__modules` VALUES (33, 'Information sur la partie', '', 1, 'user4', 0, '0000-00-00 00:00:00', 1, 'mod_wub_infopartie', 0, 0, 1, 'moduleclass_sfx=-hilite1', 0, 0);
INSERT INTO `#__modules` VALUES (34, 'Statistique joueur', '', 1, 'inset', 0, '0000-00-00 00:00:00', 1, 'mod_wub_joueur', 0, 0, 0, '', 0, 0);
INSERT INTO `#__modules` VALUES (35, 'Meilleur joueur', '', 1, 'user3', 0, '0000-00-00 00:00:00', 1, 'mod_wub_meilleur', 0, 0, 0, 'moduleclass_sfx=-hilite5', 0, 0);
INSERT INTO `#__modules` VALUES (36, 'Menu du jeu', '', 1, 'user1', 0, '0000-00-00 00:00:00', 1, 'mod_wub_menu', 0, 1, 1, 'moduleclass_sfx=-hilite6', 0, 0);
INSERT INTO `#__modules` VALUES (37, 'Dernière victoire', '', 2, 'user3', 0, '0000-00-00 00:00:00', 1, 'mod_wub_victoire', 0, 0, 1, 'moduleclass_sfx=-hilite2', 0, 0);
INSERT INTO `#__modules` VALUES (39, 'Liste des flics dans la ville', '', 1, 'user10', 0, '0000-00-00 00:00:00', 1, 'mod_wub_flic', 0, 0, 1, '', 0, 0);


# --------------------------------------------------------

#
# Table structure for table `#__modules_menu`
#

CREATE TABLE `#__modules_menu` (
  `moduleid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
) TYPE=MyISAM;

#
# Dumping data for table `#__modules_menu`
#

INSERT INTO `#__modules_menu` VALUES (1, 30);
INSERT INTO `#__modules_menu` VALUES (2, 0);
INSERT INTO `#__modules_menu` VALUES (3, 0);
INSERT INTO `#__modules_menu` VALUES (4, 0);
INSERT INTO `#__modules_menu` VALUES (5, 30);
INSERT INTO `#__modules_menu` VALUES (6, 0);
INSERT INTO `#__modules_menu` VALUES (7, 0);
INSERT INTO `#__modules_menu` VALUES (8, 0);
INSERT INTO `#__modules_menu` VALUES (9, 0);
INSERT INTO `#__modules_menu` VALUES (10, 0);
INSERT INTO `#__modules_menu` VALUES (11, 0);
INSERT INTO `#__modules_menu` VALUES (12, 0);
INSERT INTO `#__modules_menu` VALUES (13, 30);
INSERT INTO `#__modules_menu` VALUES (14, 0);
INSERT INTO `#__modules_menu` VALUES (15, 0);
INSERT INTO `#__modules_menu` VALUES (16, 30);
INSERT INTO `#__modules_menu` VALUES (18, 0);
INSERT INTO `#__modules_menu` VALUES (31, 0);
INSERT INTO `#__modules_menu` VALUES (33, 30);
INSERT INTO `#__modules_menu` VALUES (34, 0);
INSERT INTO `#__modules_menu` VALUES (35, 30);
INSERT INTO `#__modules_menu` VALUES (36, 27);
INSERT INTO `#__modules_menu` VALUES (37, 30);
INSERT INTO `#__modules_menu` VALUES (38, 0);
INSERT INTO `#__modules_menu` VALUES (39, 0);


# --------------------------------------------------------

#
# Table structure for table `#__newsfeeds`
#

CREATE TABLE `#__newsfeeds` (
  `catid` int(11) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `filename` varchar(200) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  `numarticles` int(11) unsigned NOT NULL default '1',
  `cache_time` int(11) unsigned NOT NULL default '3600',
  `checked_out` tinyint(3) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `published` (`published`)
) TYPE=MyISAM;

#
# Table structure for table `#__poll_data`
#

CREATE TABLE `#__poll_data` (
  `id` int(11) NOT NULL auto_increment,
  `pollid` int(4) NOT NULL default '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) TYPE=MyISAM;

#
# Table structure for table `#__poll_date`
#

CREATE TABLE `#__poll_date` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL default '0',
  `poll_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `poll_id` (`poll_id`)
) TYPE=MyISAM;

#
# Table structure for table `#__polls`
#

CREATE TABLE `#__polls` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `voters` int(9) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL default '0',
  `access` int(11) NOT NULL default '0',
  `lag` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Table structure for table `#__poll_menu`
#

CREATE TABLE `#__poll_menu` (
  `pollid` int(11) NOT NULL default '0',
  `menuid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pollid`,`menuid`)
) TYPE=MyISAM;

#
# Table structure for table `#__sections`
#

CREATE TABLE `#__sections` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `image` varchar(100) NOT NULL default '',
  `scope` varchar(50) NOT NULL default '',
  `image_position` varchar(10) NOT NULL default '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `count` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_scope` (`scope`)
) TYPE=MyISAM;

#
# Table structure for table `#__session`
#

CREATE TABLE `#__session` (
  `username` varchar(50) default '',
  `time` varchar(14) default '',
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default '0',
  `usertype` varchar(50) default '',
  `gid` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `whosonline` (`guest`,`usertype`)
) TYPE=MyISAM;

#
# Table structure for table `#__stats_agents`
#

CREATE TABLE `#__stats_agents` (
  `agent` varchar(255) NOT NULL default '',
  `type` tinyint(1) unsigned NOT NULL default '0',
  `hits` int(11) unsigned NOT NULL default '1'
) TYPE=MyISAM;

#
# Table structure for table `#__templates_menu`
#

CREATE TABLE `#__templates_menu` (
  `template` varchar(50) NOT NULL default '',
  `menuid` int(11) NOT NULL default '0',
  `client_id` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`template`,`menuid`)
) TYPE=MyISAM;

# Dumping data for table `#__templates_menu`

INSERT INTO `#__templates_menu` VALUES ('rt_dimensions', '0', '0');
INSERT INTO `#__templates_menu` VALUES ('joomla_admin', '0', '1');

# --------------------------------------------------------

#
# Table structure for table `#__template_positions`
#

CREATE TABLE `#__template_positions` (
  `id` int(11) NOT NULL auto_increment,
  `position` varchar(10) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `#__template_positions`
#

INSERT INTO `#__template_positions` VALUES (1, 'left', '');
INSERT INTO `#__template_positions` VALUES (2, 'right', '');
INSERT INTO `#__template_positions` VALUES (3, 'top', '');
INSERT INTO `#__template_positions` VALUES (4, 'bottom', '');
INSERT INTO `#__template_positions` VALUES (5, 'inset', '');
INSERT INTO `#__template_positions` VALUES (6, 'banner', '');
INSERT INTO `#__template_positions` VALUES (7, 'header', '');
INSERT INTO `#__template_positions` VALUES (8, 'footer', '');
INSERT INTO `#__template_positions` VALUES (9, 'newsflash', '');
INSERT INTO `#__template_positions` VALUES (10, 'legals', '');
INSERT INTO `#__template_positions` VALUES (11, 'pathway', '');
INSERT INTO `#__template_positions` VALUES (12, 'toolbar', '');
INSERT INTO `#__template_positions` VALUES (13, 'cpanel', '');
INSERT INTO `#__template_positions` VALUES (14, 'user1', '');
INSERT INTO `#__template_positions` VALUES (15, 'user2', '');
INSERT INTO `#__template_positions` VALUES (16, 'user3', '');
INSERT INTO `#__template_positions` VALUES (17, 'user4', '');
INSERT INTO `#__template_positions` VALUES (18, 'user5', '');
INSERT INTO `#__template_positions` VALUES (19, 'user6', '');
INSERT INTO `#__template_positions` VALUES (20, 'user7', '');
INSERT INTO `#__template_positions` VALUES (21, 'user8', '');
INSERT INTO `#__template_positions` VALUES (22, 'user9', '');
INSERT INTO `#__template_positions` VALUES (23, 'advert1', '');
INSERT INTO `#__template_positions` VALUES (24, 'advert2', '');
INSERT INTO `#__template_positions` VALUES (25, 'advert3', '');
INSERT INTO `#__template_positions` VALUES (26, 'icon', '');
INSERT INTO `#__template_positions` VALUES (27, 'debug', '');
INSERT INTO `#__template_positions` VALUES (28, 'search', '');
INSERT INTO `#__template_positions` VALUES (29, 'user10', '');
INSERT INTO `#__template_positions` VALUES (30, 'user11', '');
INSERT INTO `#__template_positions` VALUES (31, 'user12', '');
# --------------------------------------------------------

#
# Table structure for table `#__users`
#

CREATE TABLE `#__users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `username` varchar(25) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`)
) TYPE=MyISAM;

#
# Table structure for table `#__usertypes`
#

CREATE TABLE `#__usertypes` (
  `id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `mask` varchar(11) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `#__usertypes`
#

INSERT INTO `#__usertypes` VALUES (0, 'superadministrator', '');
INSERT INTO `#__usertypes` VALUES (1, 'administrator', '');
INSERT INTO `#__usertypes` VALUES (2, 'editor', '');
INSERT INTO `#__usertypes` VALUES (3, 'user', '');
INSERT INTO `#__usertypes` VALUES (4, 'author', '');
INSERT INTO `#__usertypes` VALUES (5, 'publisher', '');
INSERT INTO `#__usertypes` VALUES (6, 'manager', '');
# --------------------------------------------------------

#
# Table structure for table `#__weblinks`
#

CREATE TABLE `#__weblinks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `sid` int(11) NOT NULL default '0',
  `title` varchar(250) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `description` varchar(250) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `archived` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) TYPE=MyISAM;

#
# Table structure for table `#__core_acl_aro`
#

CREATE TABLE `#__core_acl_aro` (
  `aro_id` int(11) NOT NULL auto_increment,
  `section_value` varchar(240) NOT NULL default '0',
  `value` varchar(240) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`aro_id`),
  UNIQUE KEY `#__gacl_section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `#__gacl_hidden_aro` (`hidden`)
) TYPE=MyISAM;

#
# Table structure for table `#__core_acl_aro_groups`
#
CREATE TABLE `#__core_acl_aro_groups` (
  `group_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `lft` int(11) NOT NULL default '0',
  `rgt` int(11) NOT NULL default '0',
  PRIMARY KEY  (`group_id`),
  KEY `parent_id_aro_groups` (`parent_id`),
  KEY `#__gacl_parent_id_aro_groups` (`parent_id`),
  KEY `#__gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) TYPE=MyISAM;

#
# Dumping data for table `#__core_acl_aro_groups`
#
INSERT INTO `#__core_acl_aro_groups` VALUES (17,0,'ROOT',1,22);
INSERT INTO `#__core_acl_aro_groups` VALUES (28,17,'USERS',2,21);
INSERT INTO `#__core_acl_aro_groups` VALUES (29,28,'Public Frontend',3,12);
INSERT INTO `#__core_acl_aro_groups` VALUES (18,29,'Registered',4,11);
INSERT INTO `#__core_acl_aro_groups` VALUES (19,18,'Author',5,10);
INSERT INTO `#__core_acl_aro_groups` VALUES (20,19,'Editor',6,9);
INSERT INTO `#__core_acl_aro_groups` VALUES (21,20,'Publisher',7,8);
INSERT INTO `#__core_acl_aro_groups` VALUES (30,28,'Public Backend',13,20);
INSERT INTO `#__core_acl_aro_groups` VALUES (23,30,'Manager',14,19);
INSERT INTO `#__core_acl_aro_groups` VALUES (24,23,'Administrator',15,18);
INSERT INTO `#__core_acl_aro_groups` VALUES (25,24,'Super Administrator',16,17);

#
# Table structure for table `#__core_acl_groups_aro_map`
#
CREATE TABLE `#__core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL default '0',
  `section_value` varchar(240) NOT NULL default '',
  `aro_id` int(11) NOT NULL default '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) TYPE=MyISAM;

#
# Table structure for table `#__core_acl_aro_sections`
#
CREATE TABLE `#__core_acl_aro_sections` (
  `section_id` int(11) NOT NULL auto_increment,
  `value` varchar(230) NOT NULL default '',
  `order_value` int(11) NOT NULL default '0',
  `name` varchar(230) NOT NULL default '',
  `hidden` int(11) NOT NULL default '0',
  PRIMARY KEY  (`section_id`),
  UNIQUE KEY `value_aro_sections` (`value`),
  UNIQUE KEY `#__gacl_value_aro_sections` (`value`),
  KEY `hidden_aro_sections` (`hidden`),
  KEY `#__gacl_hidden_aro_sections` (`hidden`)
) TYPE=MyISAM;

INSERT INTO `#__core_acl_aro_sections` VALUES (10,'users',1,'Users',0);


CREATE TABLE `#__wub_actions_plusieurs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `iduser` mediumint(11) unsigned NOT NULL default '0',
  `role` tinyint(8) unsigned NOT NULL default '0',
  `type` tinyint(8) unsigned NOT NULL default '0',
  `lat` tinyint(2) unsigned NOT NULL default '0',
  `lng` tinyint(2) unsigned NOT NULL default '0',
  `time_crea` int(11) unsigned NOT NULL default '0',
  `equipe` tinyint(2) unsigned NOT NULL default '0',
  `iddefense` mediumint(8) unsigned NOT NULL default '0',
  `idattaque` mediumint(8) unsigned NOT NULL default '0',
  `nomattaque` varchar(255) NOT NULL default '',
  `nomdefense` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_armes` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `image` varchar(50) NOT NULL default '',
  `munition` tinyint(3) unsigned NOT NULL default '0',
  `attaque` tinyint(3) unsigned NOT NULL default '0',
  `defense` tinyint(3) unsigned NOT NULL default '0',
  `precision` tinyint(3) unsigned NOT NULL default '1',
  `detente` tinyint(3) unsigned NOT NULL default '1',
  `prix_achat` mediumint(8) unsigned NOT NULL default '0',
  `prix_munition` mediumint(8) unsigned NOT NULL default '0',
  `commentaire` tinytext NOT NULL,
  `nom` varchar(20) NOT NULL default '',
  `idmagasin` mediumint(8) unsigned NOT NULL default '0',
  `nombre` tinyint(1) unsigned NOT NULL default '2',
  `xp` smallint(5) unsigned NOT NULL default '0',
  `special` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=57 ;

CREATE TABLE `#__wub_articles` (
  `id` int(11) NOT NULL auto_increment,
  `texte` longtext NOT NULL,
  `type` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=849 ;

CREATE TABLE `#__wub_batiments` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `lng` tinyint(2) unsigned NOT NULL default '0',
  `lat` tinyint(2) unsigned NOT NULL default '0',
  `nom` varchar(50) NOT NULL default '',
  `commentaire` mediumtext NOT NULL,
  `protection` smallint(5) unsigned NOT NULL default '500',
  `coffre` mediumint(8) unsigned NOT NULL default '5000',
  `option` varchar(50) NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  `couleur` varchar(7) NOT NULL default '#ffffff',
  `xp` smallint(5) unsigned NOT NULL default '0',
  `proprio` mediumint(8) unsigned NOT NULL default '0',
  `proprio_equipe` mediumint(8) unsigned NOT NULL default '0',
  `prix_achat` int(11) unsigned NOT NULL default '10000',
  `timer` int(10) unsigned NOT NULL default '0',
  `acces` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=9720 ;

CREATE TABLE `#__wub_carte_victoire` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `equipe` mediumint(8) unsigned NOT NULL default '0',
  `iduser` mediumint(8) unsigned NOT NULL default '0',
  `lat` tinyint(2) unsigned NOT NULL default '0',
  `lng` tinyint(2) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;



CREATE TABLE `#__wub_carte_voiture` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iduser` int(11) unsigned NOT NULL,
  `idvoiture` tinyint(3) unsigned NOT NULL,
  `reservoir` tinyint(3) unsigned NOT NULL,
  `defense` tinyint(3) unsigned NOT NULL,
  `rapidite` tinyint(3) unsigned NOT NULL,
  `timer` int(11) unsigned NOT NULL,
  `lat` tinyint(2) unsigned NOT NULL,
  `lng` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_drogues` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iduser` int(10) unsigned NOT NULL default '0',
  `quantite1` mediumint(8) unsigned NOT NULL default '0',
  `prix1` int(10) unsigned NOT NULL default '0',
  `quantite2` mediumint(8) unsigned NOT NULL default '0',
  `prix2` int(10) unsigned NOT NULL default '0',
  `quantite3` mediumint(8) unsigned NOT NULL default '0',
  `prix3` int(10) unsigned NOT NULL default '0',
  `quantite4` mediumint(8) unsigned NOT NULL default '0',
  `prix4` int(10) unsigned NOT NULL default '0',
  `quantite5` mediumint(8) unsigned NOT NULL default '0',
  `prix5` int(10) unsigned NOT NULL default '0',
  `quantite6` mediumint(8) unsigned NOT NULL default '0',
  `prix6` int(10) unsigned NOT NULL default '0',
  `quantite7` mediumint(8) unsigned NOT NULL default '0',
  `prix7` int(10) unsigned NOT NULL default '0',
  `timer` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;


CREATE TABLE `#__wub_ennemis` (
  `id` int(111) unsigned NOT NULL auto_increment,
  `nom` varchar(50) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `argent` int(11) unsigned NOT NULL default '0',
  `commentaire` longtext NOT NULL,
  `vie` tinyint(3) unsigned NOT NULL default '0',
  `humeur` tinyint(1) unsigned NOT NULL default '0',
  `lat` tinyint(2) unsigned NOT NULL default '2',
  `lng` tinyint(2) unsigned NOT NULL default '2',
  `puissance` tinyint(3) unsigned NOT NULL default '0',
  `intelligence` tinyint(3) unsigned NOT NULL default '0',
  `actif` tinyint(1) unsigned NOT NULL default '1',
  `idarme` tinyint(2) unsigned NOT NULL default '2',
  `idvoiture` tinyint(2) unsigned NOT NULL default '2',
  `xp` smallint(4) unsigned NOT NULL default '0',
  `discuter` tinyint(3) unsigned NOT NULL default '0',
  `taxi` tinyint(3) unsigned NOT NULL default '0',
  `reservoir` tinyint(3) unsigned NOT NULL default '0',
  `munition` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=257 ;

INSERT INTO `#__wub_ennemis` VALUES(2, 'Basile', '2.jpg', 250, 'Ancien commando, Basile est sous ses aires  enjôleur, une vrai tête brulée.Ne vous fiez pas aux apparences\r\n', 100, 0, 5, 26, 1, 1, 1, 0, 0, 1, 0, 1, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(4, 'Odilon', '4.jpg', 250, 'Odilon est une maîtresse incontestée en matière d\'explosif, faites attention à vous elle pourrait bien vous faire voir 36 chandelles!!!', 100, 3, 8, 24, 1, 1, 1, 0, 0, 1, 4, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(5, 'Micheline', '5.jpg', 250, 'Sous ses airs de femme, Le type est un vrai boxeur, il peut te casser les dents sans que tu t\'en rende compte.', 100, 3, 3, 7, 1, 1, 1, 0, 0, 1, 4, 1, 6, 0);
INSERT INTO `#__wub_ennemis` VALUES(7, 'Raymond', '7.jpg', 250, 'Ce type est cool mais si tu lui cherche la merde, il va savoir t\'accueillir.', 100, 3, 25, 24, 1, 1, 1, 0, 0, 1, 2, 1, 4, 1);
INSERT INTO `#__wub_ennemis` VALUES(8, 'Lucien', '8.jpg', 250, 'C\'est le genre de type qui oubli où sont ses clefs. Par contre niveau baston, il répond toujours présent!', 100, 1, 24, 4, 1, 1, 1, 0, 0, 1, 1, 1, 4, 1);
INSERT INTO `#__wub_ennemis` VALUES(9, 'Alexia', '9.jpg', 250, 'Jeune mais bagarreuse dans l\'âme elle te niquera peut-être ton joli portrait.', 100, 0, 11, 24, 1, 1, 1, 0, 0, 1, 4, 0, 8, 3);
INSERT INTO `#__wub_ennemis` VALUES(10, 'Guillaume', '10.jpg', 250, 'Fan de skateboard, ce type est un violent. Connu des forces de police, Guillaume te refera la tronche autant de fois que tu lui demandera. Attention aux coups de planche.', 100, 1, 14, 10, 1, 1, 1, 0, 0, 1, 4, 1, 4, 2);
INSERT INTO `#__wub_ennemis` VALUES(15, 'Rémi', '15.jpg', 250, 'Un peu solitaire ce mec a du vécu, il te refera la tronche même si tu es plus fort que lui.', 100, 3, 12, 13, 1, 1, 1, 0, 0, 1, 5, 1, 8, 0);
INSERT INTO `#__wub_ennemis` VALUES(16, 'Marcelle la folle', '16.jpg', 250, 'Petite folle du quartier, cette meuf peut te faire des pipes comme jamais tu en as eu. Attention mesdames....', 100, 0, 24, 6, 1, 1, 1, 0, 0, 1, 3, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(19, 'Mathilda la killeuse', '19.jpg', 250, 'Ancienne dealeuse, elle s\'est reconvertie en gangster de quartier. Sous ses apparences de première de la classe, cette meuf est dangereuse.', 100, 1, 21, 17, 1, 1, 1, 0, 0, 1, 4, 0, 10, 3);
INSERT INTO `#__wub_ennemis` VALUES(20, 'Sébastien', '20.jpg', 250, 'Beau gosse aux allures de surfeur, Seb est un mec qui combat facilement, donc ne le fait pas trop chier.', 100, 3, 17, 9, 1, 1, 1, 0, 0, 1, 3, 1, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(22, 'Vincent', '22.jpg', 250, 'Il travaille à la banque, toujours bien habillé, il a souvent du liquide sur lui.   C\'est une victime facile. ', 100, 1, 20, 20, 1, 1, 1, 0, 0, 1, 3, 1, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(23, 'Bernadette', '23.jpg', 250, 'Sportive de carrière, elle sait jouer au tennis. Attention messieurs qu\'elle ne confonde pas de balle...', 100, 0, 5, 8, 1, 1, 1, 0, 0, 1, 3, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(29, 'Gildas la coquine', '31.jpg', 250, 'Elle adore les mecs de terrain. Si tu es du bâtiment fais attention à ta queue. Par contre elle connaît bien les sport de combat.', 100, 3, 14, 8, 1, 1, 1, 0, 0, 1, 3, 1, 9, 0);
INSERT INTO `#__wub_ennemis` VALUES(31, 'Marcelle', '29.jpg', 250, 'Le roi de la muscu, Marcelle est fort, très fort... Il adore se battre! Maintenant est qu\'il est plus fort que toi ? A toi de voir.', 100, 3, 15, 19, 1, 1, 1, 0, 0, 1, 0, 1, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(34, 'Blaise', '34.jpg', 250, 'Père de 2 enfant, cet homme est ingénieur au centre d\'étude de Mafiajob. Très intelligent donc peu d\'argent sur lui.', 100, 2, 6, 13, 1, 1, 1, 0, 0, 1, 2, 0, 9, 0);
INSERT INTO `#__wub_ennemis` VALUES(37, 'Gaston le ninja', '37.jpg', 250, 'Moche de loin mais dangereux de près, cet homme est une arme à lui seul. Tu veux jouer le chaud ? A toi d\'être sûr de toi!!!', 100, 2, 22, 11, 1, 1, 1, 0, 0, 1, 1, 1, 7, 1);
INSERT INTO `#__wub_ennemis` VALUES(41, 'Arnaud', '41.jpg', 250, 'Il adore la moto surtout celle de 50cm. Son arme préférée, son casque, qui lui a sauvé plusieurs fois la vie mais pas celle du nez de ses adversaires.', 100, 0, 16, 5, 1, 1, 1, 0, 0, 1, 0, 1, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(43, 'Félix', '43.jpg', 250, 'Regarde le bien mec!! Ce type sait ce qu\'il fait. Moi personnellement, je ne m\'en approcherai pas, il a l\'air d\'un vrai sadique ce mec!', 100, 1, 5, 24, 1, 1, 1, 0, 0, 1, 0, 1, 6, 1);
INSERT INTO `#__wub_ennemis` VALUES(45, 'Valentin', '45.jpg', 250, 'C\'est le genre de type a aimer les gens, un peu chiant mais attachant. Viens lui faire un gros bisou!! sauf si tu préfères lui faire un deuxième trou du cul.', 100, 2, 20, 21, 1, 1, 1, 0, 0, 1, 2, 1, 4, 1);
INSERT INTO `#__wub_ennemis` VALUES(46, 'Claude', '46.jpg', 250, 'Ancien inspecteur des stupéfiant, Claude ne rigole pas. Il peut t\'éclater la tronche juste avec 2 doigts donc attention.', 100, 2, 2, 15, 1, 1, 1, 0, 0, 1, 3, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(48, 'Alexis', '48.jpg', 250, 'Fleuriste qui adore offrir des fleurs, il ne manque pas de ressource pour ce qui est de se battre.', 100, 1, 14, 7, 1, 1, 1, 0, 0, 1, 0, 1, 10, 0);
INSERT INTO `#__wub_ennemis` VALUES(50, 'Gabine', '50.jpg', 250, 'Grosse folle qui aime les hommes de haut rang, elle se balade souvent armé donc attention à vos petites fesses.', 100, 1, 11, 26, 1, 1, 1, 0, 0, 1, 1, 1, 7, 1);
INSERT INTO `#__wub_ennemis` VALUES(52, 'Dana', '52.jpg', 250, 'C\'est la femme téléphone par référence, elle en a plus de 10 sur elle, ce qui veut dire que cette meuf a un peu de tune sur elle...', 100, 1, 11, 26, 1, 1, 1, 0, 0, 1, 4, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(54, 'Lazare', '54.jpg', 250, 'Homme de la nature, il adore la forêt et les plantes en général, Il pratique plusieurs sports de combat...', 100, 2, 9, 2, 1, 1, 1, 0, 0, 1, 1, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(55, 'Modeste', '55.jpg', 250, 'Comme son prénom l\'indique, cette personne n\'est pas du genre a avoir beaucoup de liquide sur lui.', 100, 0, 4, 6, 1, 1, 1, 0, 0, 1, 4, 1, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(56, 'Roméo', '56.jpg', 250, 'Belle gueule mais aussi grande gueule donc ne croyez pas forcement ce qu\'il peut vous dire.', 100, 2, 8, 7, 1, 1, 1, 0, 0, 1, 0, 1, 6, 1);
INSERT INTO `#__wub_ennemis` VALUES(57, 'Nessia', '57.jpg', 250, 'Femme dynamique et d\'affaire, elle n\'a pas de temps à perdre avec des petits joueurs.', 100, 0, 11, 2, 1, 1, 1, 0, 0, 1, 0, 0, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(59, 'Romain', '59.jpg', 250, 'Antisocial de nature, ce type fait peur à voir, ce qui en fait un individu très dangereux.', 100, 1, 11, 20, 1, 1, 1, 0, 0, 1, 5, 1, 6, 2);
INSERT INTO `#__wub_ennemis` VALUES(60, 'Auguste', '60.jpg', 250, 'Gamin de la rue, il traine avec une petite bande de quartier mal famé. Il adore voler les touristes de Mafiajob.', 100, 2, 13, 26, 1, 1, 1, 0, 0, 1, 2, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(61, 'Aubin', '61.jpg', 250, 'Rappeur de profession, Il déteste les flics. D\'ailleurs à cause de lui 2 uniformes ont finis à l\'hôpital.', 100, 2, 3, 12, 1, 1, 1, 0, 0, 1, 3, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(63, 'Guénolé', '63.jpg', 250, 'Homme d\'église, il ne ferait pas de mal à une mouche, dites lui tous vos péchés il sera vous pardonner.', 100, 1, 22, 4, 1, 1, 1, 0, 0, 1, 2, 1, 5, 2);
INSERT INTO `#__wub_ennemis` VALUES(64, 'Casimir', '64.jpg', 250, 'Le business, c\'est son affaire. L\'argent, il connaît. Des clients lui laisse entre les mains plusieurs millions de $.', 100, 1, 7, 5, 1, 1, 1, 0, 0, 1, 0, 1, 6, 0);
INSERT INTO `#__wub_ennemis` VALUES(65, 'Olive', '65.jpg', 250, 'Ancienne étudiante en lettre, Olive est devenue ... Rien une pauvre branleuse sans emplois qui survie via papa et maman.', 100, 2, 11, 23, 1, 1, 1, 0, 0, 1, 5, 1, 5, 2);
INSERT INTO `#__wub_ennemis` VALUES(67, 'Jérémie', '67.jpg', 250, 'Femme de terrain, travaillant sur des chantiers spectaculaires, elle est devenu une image sur le monde du bâtiment et ceci sans jamais se salir les mains.', 100, 1, 18, 9, 1, 1, 1, 0, 0, 1, 0, 1, 7, 0);
INSERT INTO `#__wub_ennemis` VALUES(70, 'Vivien', '70.jpg', 250, 'Grand en age mais forgé dans le marbre. ce petit bout de choux vous montrera qu\'il y a pas d\'âge pour te niquer la tronche.', 100, 2, 22, 18, 1, 1, 1, 0, 0, 1, 0, 1, 4, 2);
INSERT INTO `#__wub_ennemis` VALUES(73, 'Roberta', '73.jpg', 250, 'elle crache!! Voilà ce qu\'il y a à dire d\'elle, une cracheuse. En plus, elle a mauvaise halène.', 100, 0, 13, 3, 1, 1, 1, 0, 0, 1, 4, 1, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(77, 'Patrice', '77.jpg', 250, 'La politique, c\'est son truc. Il connaît tout ce qu\'il faut savoir sur Mafiajob. ', 100, 3, 3, 22, 1, 1, 1, 0, 0, 1, 2, 1, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(78, 'Cyrille', '78.jpg', 250, 'On ne sait rien sur ce type, juste que le vert ne lui va pas.', 100, 0, 10, 13, 1, 1, 1, 0, 0, 1, 1, 1, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(79, 'Joseph', '79.jpg', 250, 'Vieux puceau de Mafiajob, il reste tout de même un danger pour les habitants car il adore la violence.', 100, 2, 14, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(80, 'Robinson', '80.jpg', 250, 'Echappé de son île, il s\'est réfugié dans la ville de mafiacity, malheureusement pas pour votre bien.', 100, 2, 2, 26, 1, 1, 1, 0, 0, 1, 5, 0, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(83, 'Victorien', '83.jpg', 250, 'Son sport à lui c\'est la prison. C\'est un dur de chez dur. D\'ailleurs quand tu le croise c\'est surtout ton cul qui s\'en souvient.', 100, 2, 15, 14, 1, 1, 1, 0, 0, 1, 4, 1, 6, 3);
INSERT INTO `#__wub_ennemis` VALUES(87, 'Habib', '87.jpg', 250, 'Il a été adopter à l\'âge de 4 ans par une famille de singe du Pérou.. Revenu il y a pas longtemps à la civilisation, il réagit toujours comme un singe ce qui en fait une personne dangereuse.', 100, 2, 4, 26, 1, 1, 1, 0, 0, 1, 1, 1, 8, 3);
INSERT INTO `#__wub_ennemis` VALUES(88, 'Gontran', '88.jpg', 250, 'Le roi de la viande. Ce mec connaît tout sur la façon de découper de la viande. Attention je n\'ai pas dis quelle genre de viande.', 100, 0, 1, 6, 1, 1, 1, 0, 0, 1, 4, 0, 7, 1);
INSERT INTO `#__wub_ennemis` VALUES(90, 'Amédée', '90.jpg', 250, 'Elle, tu ne craint rien. Elle n\'est pas dangereuse QUAND tu ne l\'emmerde pas. Par contre si tu la cherche elle te trouve très vite.', 100, 0, 9, 12, 1, 1, 1, 0, 0, 1, 5, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(91, 'Benjamin', '91.jpg', 250, 'Jeune homme dynamique, il a un empire pétrolier énorme. A mon avis si tu arrives à l\'approcher, tu peux te faire un max.', 100, 3, 18, 22, 1, 1, 1, 0, 0, 1, 4, 1, 5, 1);
INSERT INTO `#__wub_ennemis` VALUES(92, 'Huguette', '92.jpg', 250, 'Présentatrice télé sur une chaine privée de Mafiacity. Elle est connu par toutes les ménagères de plus de 50 ans.', 100, 3, 18, 11, 1, 1, 1, 0, 0, 1, 1, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(94, 'Richard', '94.jpg', 250, 'Un problème de plomberie ? Il connaît tout ce qu\'on doit savoir sur la plomberie. Attention à votre dame.', 100, 0, 9, 5, 1, 1, 1, 0, 0, 1, 0, 1, 6, 0);
INSERT INTO `#__wub_ennemis` VALUES(95, 'Isidore', '95.jpg', 250, 'Petite folle qui ne perd pas de temps pour vous proposer ses services. Promo de noël, vous pouvez inviter un partenaire.', 100, 0, 10, 4, 1, 1, 1, 0, 0, 1, 3, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(97, 'Marcellin', '97.jpg', 250, 'Assureur de prestige, si tu veux une bonne assurance, c\'est lui que tu dois venir voir. 30% sur toutes les assurances immobilière.', 100, 2, 24, 26, 1, 1, 1, 0, 0, 1, 5, 1, 9, 0);
INSERT INTO `#__wub_ennemis` VALUES(100, 'Gaelle', '100.jpg', 250, 'Chef du rayon fruits et légumes du super marché du coin. Elle te proposera des prix comme jamais tu en as eu sur les salades.', 100, 2, 7, 7, 1, 1, 1, 0, 0, 1, 2, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(101, 'Fulberte', '101.jpg', 250, 'Problème d\'argent ne rime pas avec cette femme! Elle le plus petit billet c\'est 300 $ au moins.', 100, 3, 1, 8, 1, 1, 1, 0, 0, 1, 5, 1, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(103, 'Juliane', '103.jpg', 250, 'Envie de connaître le plaisir du bonheur viens me voir dans ma chambre d\'hôtel.', 100, 0, 7, 25, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(105, 'Maxime', '105.jpg', 250, 'Il traine souvent sous les ponts... Pourquoi ? personne ne sait. Mais la prostitution est à tous les coins de rues dans Mafiacity.', 100, 1, 12, 21, 1, 1, 1, 0, 0, 1, 0, 0, 5, 2);
INSERT INTO `#__wub_ennemis` VALUES(106, 'Paterne', '106.jpg', 250, 'Fan des piscines. Cet individu peut faire mal par sa puissante. Il a des bras énormes. ', 100, 3, 24, 5, 1, 1, 1, 0, 0, 1, 5, 1, 9, 0);
INSERT INTO `#__wub_ennemis` VALUES(107, 'Betty-Joy', '107.jpg', 250, 'On ne sait rien sur cette personne. Elle est inconnu de nos fichiers.', 100, 2, 6, 10, 1, 1, 1, 0, 0, 1, 4, 1, 9, 1);
INSERT INTO `#__wub_ennemis` VALUES(109, 'Parfait', '109.jpg', 250, 'Ex membre de la police, il a été viré car il est fou. Une vrai tête brulée mais avec des techniques de combats.', 100, 3, 11, 14, 1, 1, 1, 0, 0, 1, 1, 1, 9, 2);
INSERT INTO `#__wub_ennemis` VALUES(112, 'Anselme', '112.jpg', 250, 'On ne sait rien sur ce type. Il est inconnu de nos fichiers.', 100, 2, 6, 26, 1, 1, 1, 0, 0, 1, 1, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(113, 'Alexandre', '113.jpg', 250, 'Gagnant à un jeu de grattage, il a ouvert une petite boutique dans un petit coin de Mafiacity.', 100, 1, 22, 22, 1, 1, 1, 0, 0, 1, 4, 1, 5, 2);
INSERT INTO `#__wub_ennemis` VALUES(114, 'Georges', '114.jpg', 250, 'Il adore la chasse! Et les vieilles armes de guerres.', 100, 2, 24, 14, 1, 1, 1, 0, 0, 1, 0, 1, 9, 0);
INSERT INTO `#__wub_ennemis` VALUES(115, 'Fidèle', '115.jpg', 250, 'Pour lui la santé c\'est la nourriture. Et un bon journal le matin.', 100, 0, 16, 6, 1, 1, 1, 0, 0, 1, 5, 1, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(116, 'Mareva', '116.jpg', 250, 'On ne sait rien sur cette personne. Elle est inconnu de nos fichiers.', 100, 1, 10, 17, 1, 1, 1, 0, 0, 1, 5, 1, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(121, 'Robert', '121.jpg', 250, 'On ne sait rien sur ce type. Il est inconnu de nos fichiers.', 100, 0, 22, 25, 1, 1, 1, 0, 0, 1, 0, 1, 9, 1);
INSERT INTO `#__wub_ennemis` VALUES(123, 'Bonnie', '123.jpg', 250, 'On ne sait rien sur cette personne. Elle est inconnu de nos fichiers.', 100, 1, 5, 22, 1, 1, 1, 0, 0, 1, 1, 1, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(124, 'Philippe - Jacques', '124.jpg', 250, 'Adore la guitare, il traîne avec une bande de rockeur un peu délire.', 100, 1, 10, 19, 1, 1, 1, 0, 0, 1, 2, 1, 6, 2);
INSERT INTO `#__wub_ennemis` VALUES(125, 'Sylvain', '125.jpg', 250, 'On ne sait rien sur ce type. Il est inconnu de nos fichiers. Mais d\'après le voisinage, ce type fais partie d\'une bande de guitariste.', 100, 1, 15, 1, 1, 1, 1, 0, 0, 1, 4, 1, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(133, 'Alexiane', '133.jpg', 250, 'On ne sait rien sur cette personne. Elle est inconnu de nos fichiers.', 100, 2, 12, 26, 1, 1, 1, 0, 0, 1, 1, 1, 5, 3);
INSERT INTO `#__wub_ennemis` VALUES(134, 'Roland', '134.jpg', 250, 'Le roi de la bouffe, c\'est lui. il est listé rouge sur les mur du mac do.', 100, 3, 3, 25, 1, 1, 1, 0, 0, 1, 5, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(135, 'Matthias', '135.jpg', 250, 'On ne sait rien sur ce type. Il est inconnu de nos fichiers.', 100, 1, 14, 2, 1, 1, 1, 0, 0, 1, 1, 1, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(137, 'Honoré', '137.jpg', 250, 'On ne sait rien sur ce type. Il est inconnu de nos fichiers. Il parait qu\'il fait partie d\'une bande de terroriste.', 100, 2, 11, 24, 1, 1, 1, 0, 0, 1, 0, 0, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(138, 'Pascal', '138.jpg', 250, 'Ancien boxeur de talent. Il est désormais videur en boîte de nuit. Il a toujours un gilet par balle sur lui.', 100, 0, 20, 2, 1, 1, 1, 0, 0, 1, 0, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(139, 'Eric', '139.jpg', 250, 'Mal réveillé ce matin, faut pas l\'emmerder.', 100, 1, 9, 26, 1, 1, 1, 0, 0, 1, 1, 0, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(140, 'Yva', '140.jpg', 250, 'Russe de nature, il habite Mafiacity depuis peu de temps mais s\'est vite fait connaître des services de police.', 100, 0, 9, 23, 1, 1, 1, 0, 0, 1, 3, 1, 4, 2);
INSERT INTO `#__wub_ennemis` VALUES(141, 'Bernardin', '141.jpg', 250, 'Un homme de cirque qui s\'y connaît avec les fauves.', 100, 0, 9, 20, 1, 1, 1, 0, 0, 1, 2, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(142, 'Constantine', '142.jpg', 250, 'Enfant d\'une famille riche, Elle a l\'habitude de se faire pouiller.', 100, 1, 25, 23, 1, 1, 1, 0, 0, 1, 0, 1, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(144, 'Didier', '144.jpg', 250, 'Ninja de renom, il te niquera la gueule en deux deux sans que tu souffre, c\'est déjà pas mal.', 100, 1, 7, 19, 1, 1, 1, 0, 0, 1, 0, 0, 6, 3);
INSERT INTO `#__wub_ennemis` VALUES(145, 'Donatien', '145.jpg', 250, 'Petit trou du cul, qui connaît déjà toutes les combines de l\'arnaque.', 100, 2, 22, 8, 1, 1, 1, 0, 0, 1, 5, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(149, 'Germain', '149.jpg', 250, 'Il travail à la SPA.', 100, 2, 3, 4, 1, 1, 1, 0, 0, 1, 2, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(150, 'Aymar', '150.jpg', 250, 'Oui c\'est pour quoi? une levrette ou sodomie ?', 100, 3, 15, 20, 1, 1, 1, 0, 0, 1, 1, 1, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(151, 'Ferdinande', '151.jpg', 250, 'Elle travaille à la poste. Attention à vos colis si vous la faites chier.', 100, 1, 4, 20, 1, 1, 1, 0, 0, 1, 5, 0, 9, 3);
INSERT INTO `#__wub_ennemis` VALUES(153, 'Justin', '153.jpg', 250, 'Il adore les gros manches...', 100, 2, 2, 15, 1, 1, 1, 0, 0, 1, 1, 1, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(155, 'Kévin le roi du sud', '155.jpg', 250, 'Grand parrains sur une autre grande ville, il connaît ce qu\'il faut pour te faire taire.', 100, 1, 7, 12, 1, 1, 1, 0, 0, 1, 3, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(157, 'Igor le béton', '157.jpg', 250, 'Son truc à lui c\'est le bâtiment et les fondations. D\'après une source sûr, il paraitrait que plusieurs corps se trouvent dans ses chefs d\'œuvres.', 100, 3, 19, 19, 1, 1, 1, 0, 0, 1, 3, 1, 7, 1);
INSERT INTO `#__wub_ennemis` VALUES(158, 'Norbert', '158.jpg', 250, 'Un homme simple et heureux.', 100, 0, 24, 5, 1, 1, 1, 0, 0, 1, 1, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(159, 'Gilbert', '159.jpg', 250, 'Architecte d\'intérieur. son casier est nickel.', 100, 0, 26, 5, 1, 1, 1, 0, 0, 1, 3, 0, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(160, 'Médard', '160.jpg', 250, 'Il adore le bricolage et les femmes...', 100, 1, 17, 24, 1, 1, 1, 0, 0, 1, 5, 1, 9, 3);
INSERT INTO `#__wub_ennemis` VALUES(162, 'Landry', '162.jpg', 250, 'Inconnu par les force de police. Pas étonnant vu sa tronche.', 100, 2, 10, 10, 1, 1, 1, 0, 0, 1, 2, 1, 5, 1);
INSERT INTO `#__wub_ennemis` VALUES(163, 'Barnabé', '163.jpg', 250, 'Séducteur de prestige. Il a niqué toutes les plus belles femmes de Mafiacity.', 100, 0, 4, 17, 1, 1, 1, 0, 0, 1, 0, 1, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(164, 'Guy', '164.jpg', 250, 'Prof de math.', 100, 3, 26, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(169, 'Hervé', '169.jpg', 250, 'Jeune chef d\'entreprise. Il produit des gilets par balles.', 100, 2, 2, 20, 1, 1, 1, 0, 0, 1, 1, 1, 7, 2);
INSERT INTO `#__wub_ennemis` VALUES(171, 'Romane', '171.jpg', 250, 'Ancienne agent du FBI reconvertie dans le terrorisme, Romane détient derrière elle une véritable armée.', 100, 0, 24, 18, 1, 1, 1, 0, 0, 1, 5, 0, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(172, 'Silvère', '172.jpg', 250, 'On sait juste de lui qu\'il a servi au service de la renne d\'Angleterre.', 100, 3, 13, 9, 1, 1, 1, 0, 0, 1, 3, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(174, 'Alban', '174.jpg', 250, 'C\'est pas moi, mais j\'adore son prénom lol. C\'est un chaud chaud. Attention à vous.', 100, 2, 9, 14, 1, 1, 1, 0, 0, 1, 1, 1, 6, 1);
INSERT INTO `#__wub_ennemis` VALUES(176, 'Jean-Baptiste', '176.jpg', 250, 'Il aime les belles voitures...', 100, 3, 24, 5, 1, 1, 1, 0, 0, 1, 1, 0, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(177, 'Prosper', '177.jpg', 250, 'Souris t\'es filmé. C\'est un ancien de l\'armée de Mafiacity.', 100, 1, 10, 20, 1, 1, 1, 0, 0, 1, 3, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(179, 'Fernand', '179.jpg', 250, 'Il est encore à la FAC. Son truc, c\'est la boxe dans la boue.', 100, 0, 26, 16, 1, 1, 1, 0, 0, 1, 1, 1, 9, 3);
INSERT INTO `#__wub_ennemis` VALUES(180, 'Iréné', '180.jpg', 250, 'Jumpper de profession... Attention qu\'il te saute pas dessus.', 100, 3, 17, 5, 1, 1, 1, 0, 0, 1, 2, 0, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(181, 'Pierre - Paul', '181.jpg', 250, 'Le roi de la glisse en personne. Déganté a fond, il adore les grosses défonces.', 100, 3, 6, 10, 1, 1, 1, 0, 0, 1, 2, 1, 8, 1);
INSERT INTO `#__wub_ennemis` VALUES(182, 'Martial', '182.jpg', 250, 'Un bourgeois qui traîne.', 100, 2, 19, 20, 1, 1, 1, 0, 0, 1, 1, 1, 4, 2);
INSERT INTO `#__wub_ennemis` VALUES(183, 'Thierry', '183.jpg', 250, 'Aucune information sur lui.', 100, 1, 26, 21, 1, 1, 1, 0, 0, 1, 4, 0, 4, 3);
INSERT INTO `#__wub_ennemis` VALUES(184, 'Martinien', '184.jpg', 250, 'Son frère est anakin. Auteur de films d\'actions...', 100, 0, 1, 13, 1, 1, 1, 0, 0, 1, 5, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(185, 'Thomas', '185.jpg', 250, 'Aucune information sur lui.', 100, 3, 13, 20, 1, 1, 1, 0, 0, 1, 5, 0, 10, 2);
INSERT INTO `#__wub_ennemis` VALUES(186, 'Florent', '186.jpg', 250, 'Aucune information sur lui.', 100, 0, 12, 1, 1, 1, 1, 0, 0, 1, 3, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(187, 'Antoine', '187.jpg', 250, 'Aucune information sur lui.', 100, 0, 21, 17, 1, 1, 1, 0, 0, 1, 5, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(189, 'Raoul', '189.jpg', 250, 'Aucune information sur lui.', 100, 2, 22, 18, 1, 1, 1, 0, 0, 1, 5, 1, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(190, 'Thibault', '190.jpg', 250, 'Sous ses apparences, ce type est le roi du sexe sur Mafiacity. Un acteur comme on en fait plus.', 100, 1, 11, 17, 1, 1, 1, 0, 0, 1, 3, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(192, 'Ulrich', '192.jpg', 250, 'Il adore les petites fêtes entre ami(e)s.', 100, 3, 13, 23, 1, 1, 1, 0, 0, 1, 1, 0, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(193, 'Benoît', '193.jpg', 250, 'Alcoolique sur les bords mais gentil comme tout.', 100, 2, 4, 8, 1, 1, 1, 0, 0, 1, 1, 0, 10, 1);
INSERT INTO `#__wub_ennemis` VALUES(194, 'Olivier', '194.jpg', 250, 'Peace and love les mecs!', 100, 0, 4, 3, 1, 1, 1, 0, 0, 1, 0, 1, 10, 3);
INSERT INTO `#__wub_ennemis` VALUES(197, 'Donald', '197.jpg', 250, 'Je veux ton petit trou!! donne le moi...', 100, 2, 18, 8, 1, 1, 1, 0, 0, 1, 4, 0, 4, 3);
INSERT INTO `#__wub_ennemis` VALUES(200, 'Frédérique', '200.jpg', 250, 'J\'adore les hommes de plus de 80 ans, ils connaissent tout du sexe.', 100, 1, 14, 19, 1, 1, 1, 0, 0, 1, 5, 0, 9, 1);
INSERT INTO `#__wub_ennemis` VALUES(201, 'Arsène', '201.jpg', 250, 'Crache moi tout sur la tronche oui!!!!!!!', 100, 0, 19, 15, 1, 1, 1, 0, 0, 1, 1, 0, 7, 1);
INSERT INTO `#__wub_ennemis` VALUES(203, 'Victoria', '203.jpg', 250, 'Oui je recherche du travail donc si tu as du boulot fait moi signe.', 100, 1, 4, 20, 1, 1, 1, 0, 0, 1, 5, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(207, 'Jacqueline', '207.jpg', 250, 'Oui allo ?', 100, 2, 7, 1, 1, 1, 1, 0, 0, 1, 1, 1, 6, 0);
INSERT INTO `#__wub_ennemis` VALUES(210, 'Samson', '210.jpg', 250, 'J\'adore les femmes de plus de 20 ans, elle connaissent rien du sexe.', 100, 0, 9, 20, 1, 1, 1, 0, 0, 1, 5, 1, 0, 0);
INSERT INTO `#__wub_ennemis` VALUES(211, 'Marthe', '211.jpg', 250, 'Il a mal aux couilles a priori.', 100, 2, 10, 14, 1, 1, 1, 0, 0, 1, 2, 0, 6, 2);
INSERT INTO `#__wub_ennemis` VALUES(214, 'Alphonse', '214.jpg', 250, 'Prof d\'histoire il adore le foot.', 100, 1, 12, 26, 1, 1, 1, 0, 0, 1, 2, 1, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(215, 'Julienne Eymarde', '215.jpg', 250, 'Le basket c\'est toute sa vie. Pourtant elle y connait rien.', 100, 3, 7, 23, 1, 1, 1, 0, 0, 1, 1, 0, 5, 1);
INSERT INTO `#__wub_ennemis` VALUES(218, 'Abel', '218.jpg', 250, 'Le BTP moi je connais.', 100, 0, 5, 3, 1, 1, 1, 0, 0, 1, 2, 1, 6, 2);
INSERT INTO `#__wub_ennemis` VALUES(220, 'Gaetane', '220.jpg', 250, 'J\'adore les hommes de plus de 40 ans, ils connaissent tout de la sodomie.', 100, 3, 22, 2, 1, 1, 1, 0, 0, 1, 1, 1, 8, 3);
INSERT INTO `#__wub_ennemis` VALUES(221, 'Dominic', '221.jpg', 250, 'Une spyco comme on les aime dans les films d\'actions.', 100, 3, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 4, 1);
INSERT INTO `#__wub_ennemis` VALUES(223, 'Laurence', '223.jpg', 250, 'On signe quand? tu as un tête de vainqueur!', 100, 2, 6, 25, 1, 1, 1, 0, 0, 1, 2, 1, 10, 2);
INSERT INTO `#__wub_ennemis` VALUES(227, 'Evrard', '227.jpg', 250, 'J\'adore les pommes!', 100, 1, 11, 3, 1, 1, 1, 0, 0, 1, 0, 1, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(232, 'Jean Eudes', '232.jpg', 250, 'Si tu veux un pain c\'est par ici!', 100, 1, 6, 11, 1, 1, 1, 0, 0, 1, 5, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(233, 'Bernard', '233.jpg', 250, 'Un agent immobilier connu par les forces de police pour plusieurs arnaques non résolues. ', 100, 0, 22, 14, 1, 1, 1, 0, 0, 1, 4, 0, 4, 0);
INSERT INTO `#__wub_ennemis` VALUES(234, 'Christophe', '234.jpg', 250, 'Tu veux te faire masser la gueule? Bienvenue chez lui...', 100, 0, 12, 6, 1, 1, 1, 0, 0, 1, 3, 1, 4, 3);
INSERT INTO `#__wub_ennemis` VALUES(235, 'Fabrice', '235.jpg', 250, 'Docteur en médecine, on dit de lui qu\'il a déjà tué et découpé les corps...', 100, 1, 20, 4, 1, 1, 1, 0, 0, 1, 3, 0, 0, 2);
INSERT INTO `#__wub_ennemis` VALUES(237, 'Barthélémy', '237.jpg', 250, 'Tu connais le base-ball ? Si tu veux je te montre avec ma batte dans ta gueule :)', 100, 0, 11, 26, 1, 1, 1, 0, 0, 1, 5, 1, 8, 2);
INSERT INTO `#__wub_ennemis` VALUES(238, 'Louis', '238.jpg', 250, 'Inconnu des force de police. Mais il a bien une tronche de con.', 100, 0, 25, 7, 1, 1, 1, 0, 0, 1, 2, 1, 5, 0);
INSERT INTO `#__wub_ennemis` VALUES(244, 'Aristide', '244.jpg', 250, 'Attention, avec son tracteur il défonce tout ce qu\'il peut...', 100, 1, 16, 15, 1, 1, 1, 0, 0, 1, 3, 1, 7, 2);
INSERT INTO `#__wub_ennemis` VALUES(245, 'Gilles', '245.jpg', 250, 'Il est l\'homme à ne pas connaître. Il est solitaire...', 100, 2, 2, 15, 1, 1, 1, 0, 0, 1, 1, 0, 0, 3);
INSERT INTO `#__wub_ennemis` VALUES(247, 'Grégoire', '247.jpg', 250, 'Une petite pièce et je te chante une belle chanson...', 100, 2, 21, 26, 1, 1, 1, 0, 0, 1, 1, 1, 7, 0);
INSERT INTO `#__wub_ennemis` VALUES(250, 'Berthe', '250.jpg', 250, 'Mafieuse sans scrupule, elle tue par plaisir. Elle a 5 affaires sur le dos de divers meurtres...', 100, 2, 17, 19, 1, 1, 1, 0, 0, 1, 3, 1, 0, 1);
INSERT INTO `#__wub_ennemis` VALUES(253, 'Hélène', '253.jpg', 250, 'Inconnu mais très dangereuse.', 100, 0, 8, 9, 1, 1, 1, 0, 0, 1, 5, 1, 7, 2);
INSERT INTO `#__wub_ennemis` VALUES(255, 'Adelphe', '255.jpg', 250, 'Un parrain sans beaucoup d\'importances.', 100, 1, 14, 0, 1, 1, 1, 0, 0, 1, 0, 1, 4, 3);


CREATE TABLE `#__wub_equipe` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL default '',
  `couleur` varchar(7) NOT NULL default '',
  `iduser` int(11) unsigned NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  `commentaire` varchar(255) NOT NULL default 'Aucun commentaire',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=4 ;


INSERT INTO `#__wub_equipe` VALUES(1, 'Flic', '#E49F49', 0, 'flic.jpg', 'Ce n\'est pas une mafia mais bien la police. Attention on vous voit !');
INSERT INTO `#__wub_equipe` VALUES(2, 'Cosa Nostra', '#f9ffbc', 0, 'cosa_nostra.jpg', 'Une mafia qui fais mal par son agressivité.');
INSERT INTO `#__wub_equipe` VALUES(3, 'Mafia Rouge', '#ffbcbc', 0, 'mafia_rouge.jpg', 'Une mafia très populaire pour tous les braquages fait par leurs membres');


CREATE TABLE `#__wub_forum_equipe` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `iduser` mediumint(8) unsigned NOT NULL default '0',
  `equipe` tinyint(2) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default 'Erreur',
  `texte` text NOT NULL,
  `date_crea` datetime NOT NULL default '0000-00-00 00:00:00',
  `timer` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;


CREATE TABLE `#__wub_historique` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `iduser` mediumint(8) unsigned NOT NULL default '0',
  `equipe` tinyint(3) unsigned NOT NULL default '0',
  `lat` tinyint(2) unsigned NOT NULL default '0',
  `lng` tinyint(2) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `type` tinyint(3) unsigned NOT NULL default '0',
  `texte` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_invite` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `equipe` mediumint(8) unsigned NOT NULL default '0',
  `key_invite` varchar(255) NOT NULL,
  `timer` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_journal` (
  `id` int(1) unsigned NOT NULL auto_increment,
  `idarticle` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `objectif` varchar(255) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `timer` int(11) unsigned NOT NULL default '0',
  `equipe` mediumint(8) unsigned NOT NULL default '0',
  `argent` int(11) unsigned NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  `position` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_maj` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `timer` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=2 ;

INSERT INTO `#__wub_maj` VALUES(1, 1225961730);


CREATE TABLE `#__wub_mission` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iduser` int(10) unsigned NOT NULL default '0',
  `type` tinyint(2) unsigned NOT NULL default '0',
  `score` int(11) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `niveau` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_parking` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `iduser` mediumint(8) unsigned NOT NULL default '0',
  `idvoiture` smallint(5) unsigned NOT NULL default '0',
  `prix` int(11) unsigned NOT NULL default '0',
  `date_crea` datetime NOT NULL default '0000-00-00 00:00:00',
  `timer` int(11) unsigned NOT NULL default '0',
  `nomvoiture` varchar(255) NOT NULL default '',
  `username` varchar(255) NOT NULL default '',
  `reservoir` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_personnage` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `iduser` int(10) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `lat` tinyint(2) unsigned NOT NULL default '3',
  `lng` tinyint(2) unsigned NOT NULL default '9',
  `vie` tinyint(3) unsigned NOT NULL default '100',
  `attaque` tinyint(3) unsigned NOT NULL default '0',
  `defense` tinyint(3) unsigned NOT NULL default '0',
  `discretion` tinyint(3) unsigned NOT NULL default '0',
  `rapidite` tinyint(3) unsigned NOT NULL default '0',
  `visibilite` smallint(5) unsigned NOT NULL default '0',
  `puissance` smallint(5) unsigned NOT NULL default '0',
  `intelligence` smallint(5) unsigned NOT NULL default '0',
  `equipe` tinyint(3) unsigned NOT NULL default '0',
  `xp` smallint(4) unsigned NOT NULL default '0',
  `argent` int(11) unsigned NOT NULL default '200',
  `idvoiture` tinyint(3) unsigned NOT NULL default '0',
  `reservoir` tinyint(3) unsigned NOT NULL default '0',
  `idarme` tinyint(3) unsigned NOT NULL default '0',
  `munition` tinyint(2) unsigned NOT NULL default '0',
  `actif` tinyint(1) NOT NULL default '0',
  `tempsplanque` int(11) unsigned NOT NULL default '0',
  `image` varchar(255) NOT NULL default '0.jpg',
  `tempsmove` int(10) unsigned NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `commentaire` varchar(255) NOT NULL default 'Aucun',
  `banque` int(11) unsigned NOT NULL default '0',
  `casier` tinyint(1) unsigned NOT NULL default '0',
  `mort` tinyint(1) NOT NULL default '0',
  `parrainage` mediumint(8) NOT NULL default '0',
  `stupefiant` mediumint(8) unsigned NOT NULL default '0',
  `volevoiture` smallint(5) unsigned NOT NULL default '0',
  `volearme` smallint(5) unsigned NOT NULL default '0',
  `voleargent` smallint(5) unsigned NOT NULL default '0',
  `nbrattaque` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `#__wub_victoire` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `timer` int(11) unsigned NOT NULL default '0',
  `idequipe` smallint(5) unsigned NOT NULL default '0',
  `nomequipe` varchar(255) NOT NULL default '',
  `iduser` int(11) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `couleur` varchar(255) NOT NULL default '',
  `argent` int(11) unsigned NOT NULL default '0',
  `date_victoire` datetime NOT NULL default '0000-00-00 00:00:00',
  `mafiapass` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=2 ;

INSERT INTO `#__wub_victoire` VALUES(1, 1208716402, 4, 'Modo', 62, 'Banban', '#ffffff', 0, '2008-04-20 00:00:00', 0);

CREATE TABLE `#__wub_voitures` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `image` varchar(50) NOT NULL default '',
  `reservoir` tinyint(3) unsigned NOT NULL default '0',
  `temps` tinyint(3) unsigned NOT NULL default '120',
  `nom` varchar(50) NOT NULL default '',
  `commentaire` longtext NOT NULL,
  `defense` tinyint(3) unsigned NOT NULL default '0',
  `consommation` tinyint(3) unsigned NOT NULL default '0',
  `tenue_route` tinyint(3) unsigned NOT NULL default '0',
  `puissance` tinyint(3) unsigned NOT NULL default '0',
  `prix_plein` smallint(5) unsigned NOT NULL default '0',
  `prix_achat` mediumint(8) unsigned NOT NULL default '0',
  `rapidite` tinyint(3) unsigned NOT NULL default '0',
  `idmagasin` mediumint(8) unsigned NOT NULL default '0',
  `nombre` tinyint(3) unsigned NOT NULL default '1',
  `xp` smallint(5) unsigned NOT NULL default '0',
  `special` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=51 ;

CREATE TABLE `#__liveshoutbox` (
  `id` mediumint(7) NOT NULL auto_increment,
  `time` bigint(11) NOT NULL default '0',
  `name` tinytext collate utf8_swedish_ci NOT NULL,
  `text` text collate utf8_swedish_ci NOT NULL,
  `url` text collate utf8_swedish_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;
