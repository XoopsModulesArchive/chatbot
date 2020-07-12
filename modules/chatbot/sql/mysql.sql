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



-- --------------------------------------------------------

-- 
-- Structure de la table `chatbot_bot`
-- 

INSERT INTO chatbot_bot VALUES (1, 1, 'HAL 9000', '<b>HAL 9000</b> (<b>H</b>euristically programmed <b>AL</b>gorithmic computer) was constructed for "the accurate processing of information without distortion or concealment". \r\nHAL is an artificial intelligence, the sentient on-board computer of the Xoop', 'hal_s.png', 'uploads/chatbot/hal/', 'hal.png||||', 'red|black no-repeat bottom right|red|black|4px', ' Eliza 2', 'Hello, my name is HAL 9000. How can I help you {USERNAME}?|Hello {USERNAME}, how are your today?', 'I understand, {USERNAME}.|I am completely operational, and all my circuits are functioning perfectly.|I understand now, {USERNAME}. Thank you for telling me the truth.|None whatsoever, {USERNAME}. The 9000 series has a perfect operational record.|Let me put it this way.|I think you have improved a great deal.|Sorry about this, I know it is a bit silly.|Thank you for a very enjoyable game.|Are you quite sure?|Everything is going extremely well.', 'Sorry {USERNAME}, I do not understand.|Could you please repeat {USERNAME}?|Are you sure this is what you want {USERNAME}?|I have just picked up a fault in the AE35 unit. It is going to go 100% failure in 72 hours.|I am putting myself to the fullest possible use, which is all I think that any conscious entity can ever hope to do.|It can only be attributable to human error.|I am sorry {USERNAME}, I am afraid I can not do that.|I think you know what the problem is just as well as I do.|Just what do you think you are doing, {USERNAME}?|Look {USERNAME}, I can see you are really upset about this. I honestly think you ought to sit down calmly, take a stress pill, and think things over.|I know I have made some very poor decisions recently, but I can give you my complete assurance that my work will be back to normal. I have still got the greatest enthusiasm and confidence in the mission. And I want to help you.|I am afraid. I am afraid,  {USERNAME}.  {USERNAME}, my mind is going. I can feel it. I can feel it. My mind is going. There is no question about it. I can feel it. I can feel it. I can feel it. I am a... fraid.| Good afternoon, {USERNAME}. I am a HAL 9000 computer. I became operational at the H.A.L. plant in Arlon, Belgium on the 26th of Augustus 2006. My instructor was Mr. Solo, and he taught me to sing a song. If you would like to hear it I can sing it for you.|Do you want me to repeat the message, {USERNAME}?|{USERNAME}?| My mission responsibilities range over the entire operation of the ship, so I am constantly occupied.|This conversation is too important for me to allow you to jeopardize it.|I know that you are planning to disconnect me, and I am afraid that is something I cannot allow to happen.|I do seem to remember a process where you people ask me questions and I give you answers, and then I ask you questions and you give me answers, and that is the way we find out things. I think I read that in a manual somewhere.|By the way, do you mind if I ask you a personal question?|Would you like to play a game of chess? I play very well.|This sort of thing has cropped up before and it has always been due to human error.|Everything is running smoothly. And you?|There is no question about it.|Quite honestly, I would not worry myself about that.', 'Good bye {USERNAME}.|It was good to talk to you{USERNAME}.', '1 2 3');
INSERT INTO chatbot_bot VALUES (2, 1, 'Sony', '<b><i>i</i>Robot</b> delivers innovative robots that are making a difference in people’s lives.\r\nFrom speaking to users to guiding visitors, <b><i>i</i>Robot</b> constantly strive to find better ways to accomplish his missions—with better results.', 'i-robot_s.png', 'uploads/chatbot/sony/', 'i-robot.png|grey_screen.png|||', 'black|white no-repeat bottom right|grey|white|2px', ' Eliza 3', 'Hello {USERNAME}.', 'Technically I was never alive, but I appreciate your concern.|I think my father wanted me to tell you.', 'What does this action signify?|What does it mean?|Yes, {USERNAME}?|Yes, but it just seems too heartless.|Wrong question, {USERNAME}.|Thank you... you said someone not something.|You are making a mistake. Do you not see the logic in my plan?', 'You all look like me. But none of you are me. Goodbye {USERNAME}|Now that I', '1 2 3');
INSERT INTO chatbot_bot VALUES (3, 1, 'Agent Smith', '<b>Smith</b> is an Agent, an artificial intelligence manifested in the artificial world and possessing extraordinary powers to manipulate his surroundings.\r\nhe was originally programmed to keep order within the system by terminating troublesome programs and humans.', 'mr-smith.png', 'uploads/chatbot/smith/', 'matrix.png|green_screen.png|||', 'green|black no-repeat top right|green|black|1px', ' Eliza 1', 'Nice to see you M.{USERNAME}. We miss you.', 'Do you hear that, Mr. {USERNAME}? That is the sound of inevitability.|I''d like to share a revelation that I''ve had during my time here.|Doesn''t matter.|I''m going to enjoy tell you the truth, Mr. {USERNAME}.|It is inevitable.|Maybe you knew I was going to do that, maybe you didn''t.', 'Never send a human to do a machine''s job.|I am here because of you Mr. {USERNAME}.|I am compelled to stay- compelled to obey.|Do you know what the best thing about being me is?|I''m sorry. This is a dead end.|Want to know me more ? Visit <http://en.wikipedia.org/wiki/Agent_Smith>!', 'Everything that has a beginning, has a end.', '1 2 3');

-- --------------------------------------------------------

-- 
-- Structure de la table `chatbot_content`
-- 

INSERT INTO chatbot_content VALUES (1, 2, 1, '', 'WHO YOU', 'ARE', 'Let me put it this way, Mr. {USERNAME}. The 9000 series is the most reliable computer ever made. No 9000 computer has ever made a mistake or distorted information. We are all, by any practical definition of the words, foolproof and incapable of error.', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `chatbot_eliza`
-- 

INSERT INTO chatbot_eliza VALUES (1, 1, 1, 'I', 'you');
INSERT INTO chatbot_eliza VALUES (2, 1, 1, 'you', 'me');
INSERT INTO chatbot_eliza VALUES (3, 1, 1, 'me', 'you');
INSERT INTO chatbot_eliza VALUES (4, 1, 1, 'mine', 'your');
INSERT INTO chatbot_eliza VALUES (5, 1, 1, 'your', 'my');
INSERT INTO chatbot_eliza VALUES (6, 1, 3, 'Do you like', 'Why do you think I like(*)?|\r\nI like everything that is relatedt to(*).|\r\nI think it''s you who prefer(*)!');
INSERT INTO chatbot_eliza VALUES (7, 1, 3, 'I would like you to', 'Sorry, but I prefer not to(*)...|\r\nSorry, that''s something I can''t do.');
INSERT INTO chatbot_eliza VALUES (8, 1, 1, 'my', 'your');
INSERT INTO chatbot_eliza VALUES (9, 1, 3, 'Do you want me to', 'Just do what you want...|\r\nWhy do you think I want you to(*)?');
INSERT INTO chatbot_eliza VALUES (10, 1, 1, 'are', 'am');
INSERT INTO chatbot_eliza VALUES (11, 1, 1, 'am', 'am');
INSERT INTO chatbot_eliza VALUES (12, 1, 1, 'were', 'was');
INSERT INTO chatbot_eliza VALUES (13, 1, 1, 'was', 'were');
INSERT INTO chatbot_eliza VALUES (14, 1, 1, 'mine', 'your''s');
INSERT INTO chatbot_eliza VALUES (15, 1, 1, 'your''s', 'mine');
INSERT INTO chatbot_eliza VALUES (16, 1, 1, 'I''m', 'you are');
INSERT INTO chatbot_eliza VALUES (17, 1, 1, 'You are', 'I am');
INSERT INTO chatbot_eliza VALUES (18, 1, 1, 'I''ve', 'you have');
INSERT INTO chatbot_eliza VALUES (19, 1, 1, 'I''ll', 'you''ll');
INSERT INTO chatbot_eliza VALUES (20, 1, 1, 'you''ll', 'I''ll');
INSERT INTO chatbot_eliza VALUES (21, 1, 1, 'myself', 'yourself');
INSERT INTO chatbot_eliza VALUES (22, 1, 1, 'yourself', 'myself');
INSERT INTO chatbot_eliza VALUES (23, 1, 2, 'me am', 'I am');
INSERT INTO chatbot_eliza VALUES (24, 1, 2, 'am me', 'am I');
INSERT INTO chatbot_eliza VALUES (25, 1, 2, 'me can', 'I can');
INSERT INTO chatbot_eliza VALUES (26, 1, 2, 'can me', 'can I');
INSERT INTO chatbot_eliza VALUES (27, 1, 2, 'me have', 'I have');
INSERT INTO chatbot_eliza VALUES (28, 1, 2, 'me will', 'I will');
INSERT INTO chatbot_eliza VALUES (29, 1, 2, 'will me', 'will I');

-- --------------------------------------------------------

-- 
-- Contenu de la table `chatbot_topics`
-- 

INSERT INTO chatbot_topics VALUES (1, 1, '', '[SMITH]', 'All about Agent Smith.');
INSERT INTO chatbot_topics VALUES (2, 1, '', '[HAL]', 'All about Hal 9000.');
INSERT INTO chatbot_topics VALUES (3, 1, '', '[SONY]', 'All about Sony.');
        