-- 
-- Table structure for table `cistrap_log`
-- 
CREATE TABLE `cistrap_log` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '0',
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ipAddr` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- 
-- Table structure for table `cistrap_users`
-- 
CREATE TABLE `cistrap_users` (
  `uid` int(9) NOT NULL auto_increment,
  `token` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` enum('true','false') NOT NULL default 'false',
  `group` enum('admin','user') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) default NULL,
  `created` timestamp NULL default NULL,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;