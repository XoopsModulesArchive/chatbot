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


-- 
-- Contenu de la table `chatbot_bot`
-- 

--
-- Contenu de la table `chatbot_bot`
--


INSERT INTO chatbot_bot VALUES (1, 1, 'Francis', 'Francis Saraiva est responsable du département bois et aménagements intérieurs : lambris, parquets, sols stratifiés, semi-massifs et plaqué bois.', 'francis.jpg', 'uploads/chatbot/francis/', 'francis_bkg.jpg||||francis.saraiva@arma-sa.com webmestre@arma-sa.com', 'black|white no-repeat top left|green|white|2px', ' Eliza 7 10 5 9 3 6 8 15 14 4 1 2', 'Bonjour, comment puis-je vous aider ?|Bienvenue dans le département bois, comment puis-je vous être utile ?|Bonjour. Si vous avez des questions, je suis à votre disposition.', 'Hmm...|Intéressant.|Ah ?|Ah !|Oh oh...', 'Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas sûr de bien comprendre...|Pourriez-vous préciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma réponse ne vous satisfait pas, n\'hésitez pas à me contacter en direct.', 'Nous avons fait le tour de la question.|Je n\'ai rien d\'autre à ajouter à ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');

INSERT INTO chatbot_bot VALUES (2, 1, 'Michel M.', 'Michel Malgras est le responsable du département plein air : piscines, jeux pour enfants, serres de jardin, car-ports,  terreaux et écorces.', 'michel_m.jpg', 'uploads/chatbot/malgras/', 'michel_m_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 12', 'Bonjour. Que puis-je faire pour vous ?|Bienvenue dans le département plein air ! Comment puis-je vous aider ?|Bonjour, que cherchez-vous ?', 'Au fait, pour parler d\'autre chose.|Vous êtes déjà venu chez nous?', 'Pardon ?|Pouvez-vous reformuler votre question ?|Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas sûr de bien comprendre...|Pourriez-vous préciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma réponse ne vous satisfait pas, n\'hésitez pas à me contacter en direct.', 'Au revoir.|Nous avons fait le tour de la question.|Je n\'ai rien d\'autre à ajouter à ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');

INSERT INTO chatbot_bot VALUES (3, 1, 'Serge', 'Serge Chauvier est responsable du département peinture et saison : Levis Shop, Wood Shop, chauffages, meubles de jardin, parasols, barbecues et produits d\'entretien, boîtes aux lettres.', 'serge.jpg', 'uploads/chatbot/serge/', 'serge_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 11', 'Bonjour, comment puis-je vous aider ?|Bienvenue dans le département peinture, comment puis-je vous être utile ?|Bonjour. Si vous avez des questions, je suis à votre disposition.', 'Voilà.|Ah, d\'accord.|Je vois.|Pourquoi pas...', 'Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas sûr de bien comprendre...|Pourriez-vous préciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma réponse ne vous satisfait pas, n\'hésitez pas à me contacter en direct.', 'Nous avons fait le tour de la question.|Je n\'ai rien d\'autre à ajouter à ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?|Je dois vous laisser...', '1 2 3');

INSERT INTO chatbot_bot VALUES (4, 1, 'Michel A.', 'Michel Ambroise est le responsable du département outillage : outils électroportatifs, outils à main et outils de jardin.', 'michel_a.jpg', 'uploads/chatbot/ambroise/', 'michel_a_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 13', 'Bonjour. Que puis-je faire pour vous ?|Bienvenue dans le département outillage ! Comment puis-je vous aider ?|Bonjour, que cherchez-vous ?', 'Au fait, pour parler d\'autre chose.|Vous êtes déjà venu chez nous?', 'Pardon ?|Pouvez-vous reformuler votre question ?|Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas sûr de bien comprendre...|Pourriez-vous préciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma réponse ne vous satisfait pas, n\'hésitez pas à me contacter en direct.', 'Au revoir.|Nous avons fait le tour de la question.|Je n\'ai rien d\'autre à ajouter à ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');


-- 
-- Contenu de la table `chatbot_content`
-- 

--
-- Contenu de la table `chatbot_content`
--


INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'TR', '', 'C\'est quoi un TR ?', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'QUI ETES ES VOUS TU FRANCIS', 'SARAIVA', 'Je travaille pour Arma au département bois et aménagements intérieurs. Je suis là pour vous aider. En cas d\'absence, vous pouvez vous adresser à gerald qui se fera un plaisir de vous aider aussi. |
Je m\'appelle Francis, et je suis le responsable du département bois. Je m\'occupe de tout ce qui touche aux aménagements intérieurs et je suis disponible tous les jours de la semaine sauf le mardi.
', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'VOS ORIGINES', 'QUEL', 'Mes origines ? Je suis portugais, mais pourquoi me demandez-vous ça ?', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'CHATBOT CHATTERBOT VIRTUEL CONSEILLER CONSEILLERS', '', 'Je suis un conseiller virtuel (autrement appelé chatbot ou chatterbot). Je ne suis bien évidemment {CHATBOT}, véritable conseiller de chez Arma, mais je peux essayer de répondre à vos questions de mon mieux. Pour plus d\'informations, vous pouvez cliquer sur le lien [+] Mode d\'emploi.|
Eh non, je ne suis pas réellement {CHATBOT}. Je suis un conseiller virtuel (ChatBot ou Chatterbot), c\'est à dire un programme de simulation de la conversation. Posez-moi tout de même vos questions et on verra bien si je peux vous aider ?', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'SARDINE SARDINES', '', 'Oh oui, j\'adore les sardines. Ca doit venir de mes origines portugaises... ;-)', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'OUVERT OUVERTS OUVERTURE OUVERTURES HORAIRE HORAIRES JOURS JOUR', 'QUAND QUEL', 'Nous sommes ouvert du lundi au vendredi de 8h à 12h et de 13h15 à 18h30. Ainsi que le samedi de 8h à 18h30 sans interruption.', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'RENSEIGNEMENT INFORMATION', 'QUEL', 'Je peux vous renseigner sur tout ce qui touche au département bois. Cliquez sur [+] Informations pour en savoir plus sur nos gammes de produit.', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'BONJOUR SALUT HELLO KIKOU COUCOU', '', 'Bonjour. Est-ce que je peux vous aider ?|
Bonjour à vous. Content de vous rencontrer. Comment puis-je vous aider ?|
Oui ? Que puis-je faire pour vous ?', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'PRIX TARIF SITE', 'OU TROUVER', 'Effectivement, vous ne trouverez pas de tarif sur notre site. La raison en est que nous préférons ne pas afficher tous nos prix et permettre ainsi à nos concurrents de nous torpiller. Par contre, nous serons heureux de vous les fournir sur simple demande, soit par E-mail, soit par téléphone... ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'MERDE CHIER CHIOTTE ENCULé ENCULE CONNERIE SALOPERIE BORDEL PUTAIN CONNARD NULLARD CHIANT FUCK SALAUD FION FESSES FESSE CUL BIT COUILLE', '', 'Allons, il est inutile d\'être grossier. Posez-moi plutôt des questions simples et auquelles je peux vous répondre.|
Ne soyez pas grossier, je fais ce que je peux. Si je ne réponds pas correctement à vos questions, c\'est peut-être qu\'elles ne sont pas correctement formulées.|
t.t.t., la grossièreté ne mène nulle part...|
Hou là là, est-il nécessaire de parler de la sorte ?|
Allons, il n\'est pas nécessaire de prendre la chose de la sorte. Nous pouvons nous exprimer sans s\'énerver, non ?', '');

INSERT INTO chatbot_content VALUES ('', 5, 1, 'LAMBRIS', 'LAMBRIS', '', 'Nous disposons d\'un très large stock de lambris naturel, verni ou MDF.', 'Voulez-vous en savoir plus sur nos lambris ?');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'AU REVOIR BIENTOT BYE', '', 'Au revoir !|
A bientôt !|
Au plaisir de vous revoir. :-D|
J\'espère que j\'ai pu vous aider... Au revoir et à bientôt.', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'PARQUET PARQUETS REVETEMENT SOL REVETEMENTS SOLS', '', 'Ne vous ais-je pas déjà parlé de nos parquet stratifiés ? Sinon, nous avons aussi du parquet plaqué bois semi-massif, en liège ou encore en linoleum. Faites votre choix.|
Souhaitez-vous en savoir plus sur les parquets semi-massifs ? Ou un autre type, comme le stratifié, le liège ou même le linoleum. Lequel vous plaît le plus ?|
Effectivement, nous disposons d\'un très large choix en parquet. Que ce soit en revêtement de sol stratifié, plaqué bois, liège ou lino. Lequel vous intéresse ?', 'Connaissez-vous les parquets Meister ? Nous avons un très large choix en parquet semi-massif, stratifié, lino ou encore en liège.|
Je vous ai déjà parlé de nos parquets Meister? Nous avons une très large gamme pour tous les styles : semi-massif, liège, lino ou stratifié.');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MEISTER', 'PARQUET SOL REVETEMENT', 'Meister est le fabricant de parquet avec lequel nous travaillons régulièrement. Voulez-vous voir notre très large gamme de parquet Meister ? {modules/smartsection/item.php?itemid=199}', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'PORTUGAIS PORTUGAL', '', 'C\'est amusant, je suis justement originaire du Portugal ! Mais revenons plutôt à ce qui nous intéresse... vos aménagements intérieurs. ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'FORCE SOIT AVEC', '', 'Que la Force soit avec vous aussi. ;-)', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'MOUSTACHE MOUSTACHES', 'VOTRE TA', 'Aaaaah, ma moustache ! C\'est ma fierté ! Elle vous plaît ? Sinon, on pourrait peut-être revenir à un sujet de conversation plus terre à terre, non ? Vos aménagements intérieurs... pourquoi pas ?', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'ARMA', 'ARMA MAGASIN', 'OU REGION', 'Le magasin Arma est situé à Messancy, en Province de Luxembourg, sur la zone des trois frontières, en Belgique.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'CONTACT CONTACTER', 'VOUS', 'Pour nous contacter, vous pouvez soit nous téléphoner, soit nous envoyer un e-mail. Souhaitez-vous nous poser vos questions via notre formulaire ? <modules/liaise/>', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'MAIL REPONSE QUAND', '', 'Nous tâchons de répondre au plus vite par e-mail. Les courriers adressé à la société sont dispatché auprès de la bonne personne, et il est parfois nécessaire de patienter quelques jours avant d\'avoir une réponse à vos questions. Un peu de patience donc.  ', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'TELEPHONE TELEPHONER', '', 'Mon numéro de téléphone directe est le 0032(0)63 24 26 16. Sinon, vous pouvez téléphoner au central au 0032(0)63 24 26 15.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'EMAIL E-MAIL MAIL COURRIEL COURIEL', 'VOTRE QUEL COMMENT', 'Notre adresse générale est arma@arma-sa.com. Mais vous pouvez vous adresser directement à nos responsables de magasin en utilisant le formulaire de contact. Voulez-vous le voir ? <modules/liaise/>', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'COMMENT CONTACTER TELEPHONE MAIL CONTACT', 'VOUS TU TE', 'Le plus simple est que vous passiez me voir au magasin.|
Je suis présent au magasin tous les jours de la semaine sauf le mardi... et le dimanche bien entendu.|
Vous pouvez me contacter par e-mail à francis.saraiva@arma-sa.com, ou par téléphone au 0032(0)63.24.26.16.', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'TANTOT', '', 'Oui, à tantôt!|
A bientôt.|
A tout à l\'heure alors ?', '');

INSERT INTO chatbot_content VALUES ('', 8, 1, 'AUTOCLAVE', 'AUTOCLAVE', 'TRAITEMENT BOIS', 'Le traitement autoclave consiste en l\'imprégniation du bois à coeur. C\'est-à-dire, qu\'un bois ayant subi ce traitement est garantie sur plusieurs années en extérieur.|Certains produits sont traités autoclave. Voulez-vous en savoir plus à propos de ce type de traitement ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SEMI-MASSIF SEMI MASSIF TRITEC', 'PARQUET BOIS', 'Nous disposons d\'une large gamme en parquet semi-massif. Notre gamme est appelée Tritec. Voulez-vous en savoir plus ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PLAQUE', 'PLAQUé BOIS PLAQUE SEMI-MASSIF AVENIR', '', 'Connaissez-vous le revêtement de sol plaqué bois : Avenir, de chez Meister ? {modules/smartsection/item.php?itemid=184}|Tout comme le parquet, le plaqué bois présente une surface naturelle, en bois véritable. Le sol plaqué bois est par exemple un produit privilégié pour apporter une note d\'originalité dans un intérieur.', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'STRATIFIé STRATIFIE STRATIFIéS STRATIFIES', 'PARQUET SOL', 'Les revêtements de sol en stratifiés (ou mélaminés) sont idéal pour tous les budgets, et sont aujourd\'hui des produits d\'excellente qualité. Nous diposons de plusieurs type de parquet stratifiés : melango, canyon, frame et systema. L\'un de ces parquets vous intéresse-t-il ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'CANYON SILENCE', 'PARQUET STRATIFIé', 'Le Canyon ? Un sol aux allures maison de campagne avec d\'authentiques structures de bois, en deux largeurs de lames. Dites-moi \'oui\' et je vous en montre plus... {modules/smartsection/item.php?itemid=199}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'LAME', 'PARQUET SOL STRATIFIé', 'Parquet stratifié \'Lame\'. C\'est une nouvelle collection de sols aux éléments extra-larges. Un fin biseau en pourtour des éléments donnne une surface subtilement quadrillés. Je vous en montre plus ? {modules/smartsection/item.php?itemid=188}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MELANGO', 'PARQUET SOL STRATIFIé STRATIFIE MéLAMINé MELAMINE', 'Le parquet Melango... La large lame à jointure en V sur les côtés longitudinaux recrée l\'ambiance authentique du style maison de campagne. Ca vous intéresse ? {modules/smartsection/item.php?itemid=190}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SYSTEMA', 'PARQUET STRATIFIé', 'Systma est une collection séduisante, à la grande liberté d\'agencements. Découvrez la gamme systema silence, comprenant une sous-couche acoustique pout atténuer les nuisances sonores. Voulez-vous en savoir plus à ce sujet ? {modules/smartsection/item.php?itemid=192}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SOL SOLS LIèGE LIEGE PRADO', 'PARQUET SOL LIèGE LIEGE', 'Aaah, les sols en Liège... Pour discerner les qualités exceptionnelles du sol en liège, le mieux est d\'y marcher pieds nus. Cette chaleur sous les pieds est une caractéristique de confort que l\'on apprécie pas seulement dans une chambre à coucher. Les propriétés du liège se traduisent également par une élasticité particulièrement bénéfique pour nos articulations. Voulez-vous voir la collection Prado ? {modules/smartsection/item.php?itemid=191}', 'Connaissez-vous nos revêtements de sol en Liège Prado ?');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'LINORADO SOL LINOLEUM LINO', 'PARQUET SOL', 'Oh oui, le Linorado. Il se moque des roulettes des fauteuils de bureau et est insensible aux tâches et aux ultraviolets. Il est aussi anti-bactérien et antistatique. De plus, il est réalisé en matériaux naturels. Vous souhaitez en savoir plus ? {modules/smartsection/item.php?itemid=189}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MELAMINé MELAMINE MéLAMINé MéLAMINE MéLAMINéS MELAMINES', 'PARQUET REVETEMENT REVêTEMENT SOL', 'Les revêtements de sol mélaminés (ou stratifiés) sont idéal pour tous les budgets, et sont aujourd\'hui des produits d\'excellente qualité. Nous diposons de plusieurs type de parquet stratifiés : melango, canyon, frame et systema. Lequel de ces parquets vous intéresse ?', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND COMMENT CONTACTER TELEPHONE MAIL', 'VOUS TU', 'Je suis présent au magasin tous les jours de la semaine sauf le mardi... et le dimanche bien entendu.|
Vous pouvez me contacter par e-mail à michel.malgras@arma-sa.com, ou par téléphone au 0032(0)63.24.26.16. Mais le plus simple, c\'est que vous passiez me voir au magazin.', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'CONTACT CONTACTER', 'COMMENT', 'Vous souhaitez me contacter en direct ? Dites-moi \'oui\' !', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'POLOGNE POLAK POLONAIS', '', 'Ah ah ah ! C\'est vrai que mes collègues m\'ont surnommé le Polak. Quelle bande de farceurs ! ! ! ', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUI ETES ES VOUS TU', '', 'Je m\'appelle Michel, et je suis le responsable du département plein air.|
Mon nom est Michel Malgras. Je m\'occupe du département plein air, et je suis disponible tous les jours de la semaine sauf le vendredi... et le dimanche bien entendu.', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'RENSEIGNEMENT INFORMATION RENSEIGNEMENTS INFORMATIONS', '', 'Je peux vous renseigner sur tout ce qui touche au département plein. Cliquez sur [+] Informations pour en savoir plus sur les gammes de produit dont je m\'occupe.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'DIY', '', 'DIY est l\'acronyme de DO IT YOURSELF, ce qui signifie - Faites-le Vous-Même - en anglais. ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'QUESTIONS QUESTION CONSEIL CONSEILLER CONSEILS', 'QUELLE QUELLES QUEL', 'Vous pouvez me poser n\'importe quelle question, du moment que cela concerne mon département. Pour en savoir plus sur les sujets de conversation que je maîtrise, vous pouvez cliquer sur le [+] à droite de cette page. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PARQUET', 'CHENE HETRE', '', 'Selon le type de parquet que vous choisirez, il est possible de trouver l\'essence qui conviendra le mieux à votre intérieur. Souhaitez vous du parquet mélaminé ou plaqué bois ?|
Tout dépend du type de parquet recherché. La plupart de nos revêtements de sol sont disponibles en chêne, en hêtre ou même en erable, directement de stock ou sur commande. Quel type de revêtement cherchez-vous ? Du mélaminé, ou du semi massif ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'QUICKSTEP QUICK STEP', '', 'Nous ne commercialisons pas le parquet de la marque Quickstep. Par contre, nous disposons de produits de qualité équivalente de la marque Meister. Ces parquets sont disponibles en semi-massif, stratifié, lino et même en revêtement de sol en liège... Lequel vous intéresse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'UNICLIC', 'SYSTèME SYSTEME', 'Le système uniclic est un système breveté qui permet la pose facile du parquet, sans colle. Vous pouvez monter ou démonter une lame jusqu\'à 8 fois ! Vous gagnez énormément de temps à la pose, et surtout, c\'est beaucoup moins salissant. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SOUS-COUCHE SOUS COUCHE ISOLANT ISOLANTE', '', 'Selon le type de parquet utilisé, vous  aurez besoin d\'une sous-couche d\'isolation acoustique. Vous pouvez vous en procurer à part, ou alors opter pour le systema silence de chez Meister. Avec ce type de parquet, vous disposez d\'une sous-couche acoustique incluse, ce qui permet de gagner énormément en temps à la pose.', '');

INSERT INTO chatbot_content VALUES ('', 13, 1, '', 'SUPERMIMI MIMI', '', 'Houaaaahhh ! Vous aussi vous connaissez l\'identité secrète de Supermimi ? :-D :-D :-D', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'FRANCIS LABREL CABREL', 'APPEL APPELLE', 'Non, non, mes collègues m\'appellent Francis Labrel...', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'QUI RANGé', 'ITAUBA', 'Qui a rangé l\'Itauba ? Faut demander à Hulk...', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND VAS IRAS', 'WOODEX TU', 'Ah, ben c\'est sur, aujourd\'hui, on va chez Woodexx. D\'ailleur, je me suis bien préparé...', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND RETRAITE', 'TU VAS', 'Aah ben, je sais pas quand je vais prendre ma retraite, mais je sais grâce à qui...', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PINUS', 'MASSIF PARQUET CHENE CHATAIGNIER CHATAINIER CHATAIGNER', 'REVETEMENT SOL PLANCHER', 'Nous avons en magasin du chêne massif en différentes largeurs et épaisseurs :10, 14, et 21 mm d\'épaisseur. Nous avons ce type de parquet en chataigner en 14mm d\'épais et en Pin de la gamme Pinus. Lequel vous intéresse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, ' PINUS', 'PINUS PARQUET MASSIF', '', 'Dans la gamme Pinus, vous retrouvez un très large assortiment en parquet massif. {modules/smartsection/item.php?itemid=103}', 'Connaissez-vous notre gamme de parquet massif en sapin du nord ? C\'est notre gamme Pinus.');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'PARQUET MASSIF POSE', '', 'Dans les parquets massifs, vous avez deux types de pose : soit cloué sur lambourde, soit collé sur tout support. Lequel vous intéresse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SIKA COLLE POSE', 'CONSEIL CONSEILS POSER PARQUET', 'Pour poser les parquets en massif, nous conseillons la colle T52 de chez Sika. C\'est une colle élastique pour parquet sans solvant. {modules/smartsection/item.php?itemid=112}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'CHATAIGNIER CHATAINIER CHATAIGNER', 'PARQUET ESSENCE', 'Effectivement, nous avons du parquet massif en chataignier à coller. Bien évidemment, vous trouverez, comme pour tous nos autres produits, les plinthes assorties. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'BAMBOU', 'BAMBOU BAMBOUS CARBO EXOTIQUE PARQUET', 'CHERCHE', 'Le parquet bambou, c\'est un produit exotique extra. 30% de dureté en plus que le chêne ! Nous disposons d\'un très large choix dans ce domaine. Que ce soit le carbo ou nature... Nous avons même une version pont de bateau à découvrir en magasin.|Aaah, le parquet Bambou... Enormément de personnes nous demande ce type de parquet. En bois exotique, c\'est l\'idéal pour donner une couleur asiatique à vos intérieurs. {modules/smartsection/item.php?itemid=50}', 'Avez-vous déjà essayé le parquet bambou ? ');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'PRODUIS PRODUI PRODUIT PRODUITS ENTRETIEN BOIS HUILE HUILES HUILER PARQUET INTéRIEUR EXTéRIEUR INTERIEUR EXTERIEUR', '', 'Nous disposons d\'un large assortiment de produits d\'entretien pour les bois. Que ce soit pour vos intérieurs ou pour vos extérieurs. Que cherchez-vous ?', '');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'HUILE HUILES INTéRIEURE INTERIEUR INTERIEURE ENTRETIEN INTéRIEUR INTéRIEURS', '', 'Pour les produits d\'entretien pour parquet massifs, nous conseillons l\'huile Trip-Trap. {modules/smartsection/item.php?itemid=66}|
La meilleure huile pour entretenir les parquets en bois est disponible chez Trip-Trap. {modules/smartsection/item.php?itemid=66}', '');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'ENTRETIEN HUILE HUILES EXTéRIEUR EXTERIEUR EXTéRIEURE EXTERIEURE EXTéRIEURES BARDAGE CEDRE', '', 'Pour vos bois extérieurs, nous avons une huile d\'entretien disponible en différentes coloris. C\'est l\'idéal pour les bardages en cèdre. Pour plus d\'informations, me contacter...', '');

INSERT INTO chatbot_content VALUES ('', 15, 1, 'PLINTHES', 'PLINTHES PLINTH PLAINTH PLAINTHE PLEINTE PLINTE', '', 'Pour tous les types de parquet, nous avons la plinthes correspondante à votre revêtement. ', '');


-- 
-- Contenu de la table `chatbot_eliza`
-- 

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'suis', 'êtes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'as', 'ai');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ai', 'avez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'ai', 'vous avez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'avais', 'vous aviez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'êtes', 'suis');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'es', 'suis');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'je', 'vous');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tu', 'je');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'vôtres', 'nôtres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'nous', 'vous');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ton', 'ma');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mon', 'votre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ta', 'ma');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'étais', 'vous étiez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'aurais', 'vous auriez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mes', 'vos');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'vos', 'mes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tes', 'mes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'notre', 'votre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'miens', 'vôtres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'vôtre', 'nôtre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mien', 'vôtre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mienne', 'vôtre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'miennes', 'vôtres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tienne', 'nôtre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tiennes', 'nôtres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'eusse', 'vous eussiez');

INSERT INTO chatbot_eliza VALUES ('', 1, 2, 'me am', 'I am');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Je te fais|
Je vous fait|
Je te fait|
Je vous fais|
Je voudrais que tu me fasses|
Je voudrais que vous fassiez', 'Pourquoi voulez-vous me faire(*)?|
Pourquoi me faire(*)?|
Je n\'ai pas besoin que vous me fassiez(*).|
Il n\'y a aucune raison pour que vous me fassiez(*)!');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Voulez-vous me|
Voulez-vous me|
Veux-tu me|
Veux-tu me', 'Pourquoi voulez-vous que je vous(*)?|
Pourquoi vous(*)?|
Il n\'y a aucune raison pour que je vous(*).|
Est-il vraiment nécessaire que je vous(*)?');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Je vais te|Je vais vous', 'Pourquoi voulez-vous me(*)?|
Pourquoi me(*)?');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Tu me fais|Vous me faites|Tu me fait|Vous me faite', 'Pourquoi voulez-vous que je vous fasse(*)?|
Pourquoi est-ce que je vous ferais(*)?');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Tu me fait', 'Pourquoi voulez-vous que je vous fasse(*)?|
Pourquoi est-ce que je vous ferais(*)?');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'donne', 'donner');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Aimes tu|
Aimes-tu|
Aimez vous|
Aimez-vous|
Tu aimes|
Vous aimez', 'Pourquoi pensez-vous que j\'aime(*)?|
Oh oui, j\'adore(*)!');

INSERT INTO chatbot_eliza VALUES ('', 1, 3, 'Aimes-tu te|
Aimez-vous vous|
Tu aimes te|
Vous aimez vous', 'Pourquoi pensez-vous que j\'aime me(*)?|
Pourquoi voulez-vous savoir si j\'aime me(*)?|
Je préfère ne pas répondre à ce genre de question...');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'te', 'me');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'me', 'te');




-- 
-- Contenu de la table `chatbot_topics`
-- 

INSERT INTO chatbot_topics VALUES (2, 1, '[FRANCIS]', 'Quelques informations à propos de Francis, responsable du département bois.');

INSERT INTO chatbot_topics VALUES (3, 2, 'Parquets', 'Tout à propos de nos parquets en mélaminé, stratifié, bois brute, plaqué bois...');

INSERT INTO chatbot_topics VALUES (1, 1, '[COMMUN] Réactions standard', 'Les questions/réponses communes et formules de politesse.');

INSERT INTO chatbot_topics VALUES (4, 1, '[COMMUN] Arma', 'Quelques informations à propos d\'Arma.');

INSERT INTO chatbot_topics VALUES (5, 2, 'Lambris', 'Toutes les informations à propos  de nos lambris en bois massif naturel et verni ou MDF.');

INSERT INTO chatbot_topics VALUES (6, 2, 'Placards', 'Découvrez nos placards et nos agencements intérieurs sur-mesure !');

INSERT INTO chatbot_topics VALUES (7, 2, 'Escaliers', 'Les informations utiles à propos des escaliers en bois ou en métal.');

INSERT INTO chatbot_topics VALUES (8, 2, 'Planchers de terrasse', 'Toutes les infos relatives aux planchers de terrasse en bois exotique et sapin autoclave.');

INSERT INTO chatbot_topics VALUES (9, 2, 'Panneaux', 'Tous les types de panneaux : mélaminés, marin, dalles d\'agencement OSB, etc.');

INSERT INTO chatbot_topics VALUES (10, 2, 'Isolation', 'Les infos à propos de l\'isolation : laine de verre, laine de roche, multicouche et styrodur.');

INSERT INTO chatbot_topics VALUES (11, 1, '[SERGE]', 'Quelques informations à propos de Serge, responsable du département peinture.');

INSERT INTO chatbot_topics VALUES (12, 1, '[MICHEL M]', 'Quelques informations à propos de Michel Malgras, responsable du département plein air.');

INSERT INTO chatbot_topics VALUES (13, 1, '[MICHEL A]', 'Quelques informations à propos de Michel Ambroise, responsable du département outillage.');

INSERT INTO chatbot_topics VALUES (14, 2, 'Produits d\'entretien', 'Tous sur les produits d\'entretien pour parquet.');

INSERT INTO chatbot_topics VALUES (15, 2, 'Plinthes et accessoires', 'Toutes les infos à propos de nos plinthes, moulures et accessoires pour vos aménagements intérieurs.');