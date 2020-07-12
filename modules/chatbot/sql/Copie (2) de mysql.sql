#
# Table structure for module 'chatbot'
#

CREATE TABLE chatbot_content (
  id 				int(11) NOT NULL auto_increment,
  catid 			int(6) unsigned default '0',
  status 			tinyint(1) unsigned default '0',
  pref_or 			varchar(255) NOT NULL default '',
  pref_and 			varchar(255) NOT NULL default '',
  pref_misc 		        varchar(255) NOT NULL default '',
  reply 			text,
  question 			text,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE chatbot_eliza (
  id 				int(11) NOT NULL auto_increment,
  status 			tinyint(1) unsigned default '0',
  type 			        tinyint(1) unsigned default '0',
  keyword 			varchar(255) NOT NULL default '',
  response 			text,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE chatbot_topics (
  catid 		        int(6) NOT NULL auto_increment,
  status 		        tinyint(1) unsigned default '0',
  page_link 		        varchar(255) NOT NULL default '',
  cat_subject 		        varchar(255) NOT NULL default '',
  cat_description 	        text,
  PRIMARY KEY  (catid)
) TYPE=MyISAM;



CREATE TABLE chatbot_bot (
  botid 			int(6) NOT NULL auto_increment,
  status 			tinyint(1) unsigned default '0',
  bot_name   		        varchar(255) NOT NULL default '',
  bot_description 	        text,
  bot_image  		        varchar(255) NOT NULL default '',
  bot_directory		        varchar(255) NOT NULL default '',
  bot_background		varchar(255) NOT NULL default '',
  text_color 		        varchar(255) NOT NULL default '',
  topics			varchar(255) NOT NULL default '',
  start			        text,
  dumb			        text,
  zero			        text,
  end				text,
  groups			varchar(255) NOT NULL default '',
  PRIMARY KEY  (botid)
) TYPE=MyISAM;



CREATE TABLE chatbot_report (
  id 				int(6) NOT NULL auto_increment,
  botid                         int(6) unsigned default '0',
  status 			tinyint(1) unsigned default '1',
  rec_reply 		        text,
  rec_convo 		        text,
  date                          int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;


