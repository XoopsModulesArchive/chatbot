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


INSERT INTO chatbot_bot VALUES (1, 1, 'Francis', 'Francis Saraiva est responsable du d�partement bois et am�nagements int�rieurs : lambris, parquets, sols stratifi�s, semi-massifs et plaqu� bois.', 'francis.jpg', 'uploads/chatbot/francis/', 'francis_bkg.jpg||||francis.saraiva@arma-sa.com webmestre@arma-sa.com', 'black|white no-repeat top left|green|white|2px', ' Eliza 7 10 5 9 3 6 8 15 14 4 1 2', 'Bonjour, comment puis-je vous aider ?|Bienvenue dans le d�partement bois, comment puis-je vous �tre utile ?|Bonjour. Si vous avez des questions, je suis � votre disposition.', 'Hmm...|Int�ressant.|Ah ?|Ah !|Oh oh...', 'Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas s�r de bien comprendre...|Pourriez-vous pr�ciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma r�ponse ne vous satisfait pas, n\'h�sitez pas � me contacter en direct.', 'Nous avons fait le tour de la question.|Je n\'ai rien d\'autre � ajouter � ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');

INSERT INTO chatbot_bot VALUES (2, 1, 'Michel M.', 'Michel Malgras est le responsable du d�partement plein air : piscines, jeux pour enfants, serres de jardin, car-ports,  terreaux et �corces.', 'michel_m.jpg', 'uploads/chatbot/malgras/', 'michel_m_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 12', 'Bonjour. Que puis-je faire pour vous ?|Bienvenue dans le d�partement plein air ! Comment puis-je vous aider ?|Bonjour, que cherchez-vous ?', 'Au fait, pour parler d\'autre chose.|Vous �tes d�j� venu chez nous?', 'Pardon ?|Pouvez-vous reformuler votre question ?|Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas s�r de bien comprendre...|Pourriez-vous pr�ciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma r�ponse ne vous satisfait pas, n\'h�sitez pas � me contacter en direct.', 'Au revoir.|Nous avons fait le tour de la question.|Je n\'ai rien d\'autre � ajouter � ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');

INSERT INTO chatbot_bot VALUES (3, 1, 'Serge', 'Serge Chauvier est responsable du d�partement peinture et saison : Levis Shop, Wood Shop, chauffages, meubles de jardin, parasols, barbecues et produits d\'entretien, bo�tes aux lettres.', 'serge.jpg', 'uploads/chatbot/serge/', 'serge_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 11', 'Bonjour, comment puis-je vous aider ?|Bienvenue dans le d�partement peinture, comment puis-je vous �tre utile ?|Bonjour. Si vous avez des questions, je suis � votre disposition.', 'Voil�.|Ah, d\'accord.|Je vois.|Pourquoi pas...', 'Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas s�r de bien comprendre...|Pourriez-vous pr�ciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma r�ponse ne vous satisfait pas, n\'h�sitez pas � me contacter en direct.', 'Nous avons fait le tour de la question.|Je n\'ai rien d\'autre � ajouter � ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?|Je dois vous laisser...', '1 2 3');

INSERT INTO chatbot_bot VALUES (4, 1, 'Michel A.', 'Michel Ambroise est le responsable du d�partement outillage : outils �lectroportatifs, outils � main et outils de jardin.', 'michel_a.jpg', 'uploads/chatbot/ambroise/', 'michel_a_bck.jpg|||', 'black|white no-repeat top right|black|white|1px', ' Eliza 4 1 13', 'Bonjour. Que puis-je faire pour vous ?|Bienvenue dans le d�partement outillage ! Comment puis-je vous aider ?|Bonjour, que cherchez-vous ?', 'Au fait, pour parler d\'autre chose.|Vous �tes d�j� venu chez nous?', 'Pardon ?|Pouvez-vous reformuler votre question ?|Excusez-moi, mais je ne comprend pas votre question.|Je ne suis pas s�r de bien comprendre...|Pourriez-vous pr�ciser votre demande ?|Pour que je puisse bien vous comprendre, il vaut mieux poser des questions simples.|Si ma r�ponse ne vous satisfait pas, n\'h�sitez pas � me contacter en direct.', 'Au revoir.|Nous avons fait le tour de la question.|Je n\'ai rien d\'autre � ajouter � ce sujet pour le moment.|Pour plus d\'information, contactez-moi directement.|Vous pouvez passer au magasin pour plus d\'information.|Que puis-je faire d\'autre pour vous ?|Souhaitez-vous avoir d\'autres renseignements ? Dans quel domaine ?', '1 2 3');


-- 
-- Contenu de la table `chatbot_content`
-- 

--
-- Contenu de la table `chatbot_content`
--


INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'TR', '', 'C\'est quoi un TR ?', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'QUI ETES ES VOUS TU FRANCIS', 'SARAIVA', 'Je travaille pour Arma au d�partement bois et am�nagements int�rieurs. Je suis l� pour vous aider. En cas d\'absence, vous pouvez vous adresser � gerald qui se fera un plaisir de vous aider aussi. |
Je m\'appelle Francis, et je suis le responsable du d�partement bois. Je m\'occupe de tout ce qui touche aux am�nagements int�rieurs et je suis disponible tous les jours de la semaine sauf le mardi.
', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'VOS ORIGINES', 'QUEL', 'Mes origines ? Je suis portugais, mais pourquoi me demandez-vous �a ?', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'CHATBOT CHATTERBOT VIRTUEL CONSEILLER CONSEILLERS', '', 'Je suis un conseiller virtuel (autrement appel� chatbot ou chatterbot). Je ne suis bien �videmment {CHATBOT}, v�ritable conseiller de chez Arma, mais je peux essayer de r�pondre � vos questions de mon mieux. Pour plus d\'informations, vous pouvez cliquer sur le lien [+] Mode d\'emploi.|
Eh non, je ne suis pas r�ellement {CHATBOT}. Je suis un conseiller virtuel (ChatBot ou Chatterbot), c\'est � dire un programme de simulation de la conversation. Posez-moi tout de m�me vos questions et on verra bien si je peux vous aider ?', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'SARDINE SARDINES', '', 'Oh oui, j\'adore les sardines. Ca doit venir de mes origines portugaises... ;-)', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'OUVERT OUVERTS OUVERTURE OUVERTURES HORAIRE HORAIRES JOURS JOUR', 'QUAND QUEL', 'Nous sommes ouvert du lundi au vendredi de 8h � 12h et de 13h15 � 18h30. Ainsi que le samedi de 8h � 18h30 sans interruption.', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'RENSEIGNEMENT INFORMATION', 'QUEL', 'Je peux vous renseigner sur tout ce qui touche au d�partement bois. Cliquez sur [+] Informations pour en savoir plus sur nos gammes de produit.', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'BONJOUR SALUT HELLO KIKOU COUCOU', '', 'Bonjour. Est-ce que je peux vous aider ?|
Bonjour � vous. Content de vous rencontrer. Comment puis-je vous aider ?|
Oui ? Que puis-je faire pour vous ?', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'PRIX TARIF SITE', 'OU TROUVER', 'Effectivement, vous ne trouverez pas de tarif sur notre site. La raison en est que nous pr�f�rons ne pas afficher tous nos prix et permettre ainsi � nos concurrents de nous torpiller. Par contre, nous serons heureux de vous les fournir sur simple demande, soit par E-mail, soit par t�l�phone... ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'MERDE CHIER CHIOTTE ENCUL� ENCULE CONNERIE SALOPERIE BORDEL PUTAIN CONNARD NULLARD CHIANT FUCK SALAUD FION FESSES FESSE CUL BIT COUILLE', '', 'Allons, il est inutile d\'�tre grossier. Posez-moi plut�t des questions simples et auquelles je peux vous r�pondre.|
Ne soyez pas grossier, je fais ce que je peux. Si je ne r�ponds pas correctement � vos questions, c\'est peut-�tre qu\'elles ne sont pas correctement formul�es.|
t.t.t., la grossi�ret� ne m�ne nulle part...|
Hou l� l�, est-il n�cessaire de parler de la sorte ?|
Allons, il n\'est pas n�cessaire de prendre la chose de la sorte. Nous pouvons nous exprimer sans s\'�nerver, non ?', '');

INSERT INTO chatbot_content VALUES ('', 5, 1, 'LAMBRIS', 'LAMBRIS', '', 'Nous disposons d\'un tr�s large stock de lambris naturel, verni ou MDF.', 'Voulez-vous en savoir plus sur nos lambris ?');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'AU REVOIR BIENTOT BYE', '', 'Au revoir !|
A bient�t !|
Au plaisir de vous revoir. :-D|
J\'esp�re que j\'ai pu vous aider... Au revoir et � bient�t.', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'PARQUET PARQUETS REVETEMENT SOL REVETEMENTS SOLS', '', 'Ne vous ais-je pas d�j� parl� de nos parquet stratifi�s ? Sinon, nous avons aussi du parquet plaqu� bois semi-massif, en li�ge ou encore en linoleum. Faites votre choix.|
Souhaitez-vous en savoir plus sur les parquets semi-massifs ? Ou un autre type, comme le stratifi�, le li�ge ou m�me le linoleum. Lequel vous pla�t le plus ?|
Effectivement, nous disposons d\'un tr�s large choix en parquet. Que ce soit en rev�tement de sol stratifi�, plaqu� bois, li�ge ou lino. Lequel vous int�resse ?', 'Connaissez-vous les parquets Meister ? Nous avons un tr�s large choix en parquet semi-massif, stratifi�, lino ou encore en li�ge.|
Je vous ai d�j� parl� de nos parquets Meister? Nous avons une tr�s large gamme pour tous les styles : semi-massif, li�ge, lino ou stratifi�.');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MEISTER', 'PARQUET SOL REVETEMENT', 'Meister est le fabricant de parquet avec lequel nous travaillons r�guli�rement. Voulez-vous voir notre tr�s large gamme de parquet Meister ? {modules/smartsection/item.php?itemid=199}', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'PORTUGAIS PORTUGAL', '', 'C\'est amusant, je suis justement originaire du Portugal ! Mais revenons plut�t � ce qui nous int�resse... vos am�nagements int�rieurs. ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'FORCE SOIT AVEC', '', 'Que la Force soit avec vous aussi. ;-)', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'MOUSTACHE MOUSTACHES', 'VOTRE TA', 'Aaaaah, ma moustache ! C\'est ma fiert� ! Elle vous pla�t ? Sinon, on pourrait peut-�tre revenir � un sujet de conversation plus terre � terre, non ? Vos am�nagements int�rieurs... pourquoi pas ?', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'ARMA', 'ARMA MAGASIN', 'OU REGION', 'Le magasin Arma est situ� � Messancy, en Province de Luxembourg, sur la zone des trois fronti�res, en Belgique.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'CONTACT CONTACTER', 'VOUS', 'Pour nous contacter, vous pouvez soit nous t�l�phoner, soit nous envoyer un e-mail. Souhaitez-vous nous poser vos questions via notre formulaire ? <modules/liaise/>', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'MAIL REPONSE QUAND', '', 'Nous t�chons de r�pondre au plus vite par e-mail. Les courriers adress� � la soci�t� sont dispatch� aupr�s de la bonne personne, et il est parfois n�cessaire de patienter quelques jours avant d\'avoir une r�ponse � vos questions. Un peu de patience donc.  ', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'TELEPHONE TELEPHONER', '', 'Mon num�ro de t�l�phone directe est le 0032(0)63 24 26 16. Sinon, vous pouvez t�l�phoner au central au 0032(0)63 24 26 15.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, 'MAIL', 'EMAIL E-MAIL MAIL COURRIEL COURIEL', 'VOTRE QUEL COMMENT', 'Notre adresse g�n�rale est arma@arma-sa.com. Mais vous pouvez vous adresser directement � nos responsables de magasin en utilisant le formulaire de contact. Voulez-vous le voir ? <modules/liaise/>', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'COMMENT CONTACTER TELEPHONE MAIL CONTACT', 'VOUS TU TE', 'Le plus simple est que vous passiez me voir au magasin.|
Je suis pr�sent au magasin tous les jours de la semaine sauf le mardi... et le dimanche bien entendu.|
Vous pouvez me contacter par e-mail � francis.saraiva@arma-sa.com, ou par t�l�phone au 0032(0)63.24.26.16.', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'TANTOT', '', 'Oui, � tant�t!|
A bient�t.|
A tout � l\'heure alors ?', '');

INSERT INTO chatbot_content VALUES ('', 8, 1, 'AUTOCLAVE', 'AUTOCLAVE', 'TRAITEMENT BOIS', 'Le traitement autoclave consiste en l\'impr�gniation du bois � coeur. C\'est-�-dire, qu\'un bois ayant subi ce traitement est garantie sur plusieurs ann�es en ext�rieur.|Certains produits sont trait�s autoclave. Voulez-vous en savoir plus � propos de ce type de traitement ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SEMI-MASSIF SEMI MASSIF TRITEC', 'PARQUET BOIS', 'Nous disposons d\'une large gamme en parquet semi-massif. Notre gamme est appel�e Tritec. Voulez-vous en savoir plus ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PLAQUE', 'PLAQU� BOIS PLAQUE SEMI-MASSIF AVENIR', '', 'Connaissez-vous le rev�tement de sol plaqu� bois : Avenir, de chez Meister ? {modules/smartsection/item.php?itemid=184}|Tout comme le parquet, le plaqu� bois pr�sente une surface naturelle, en bois v�ritable. Le sol plaqu� bois est par exemple un produit privil�gi� pour apporter une note d\'originalit� dans un int�rieur.', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'STRATIFI� STRATIFIE STRATIFI�S STRATIFIES', 'PARQUET SOL', 'Les rev�tements de sol en stratifi�s (ou m�lamin�s) sont id�al pour tous les budgets, et sont aujourd\'hui des produits d\'excellente qualit�. Nous diposons de plusieurs type de parquet stratifi�s : melango, canyon, frame et systema. L\'un de ces parquets vous int�resse-t-il ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'CANYON SILENCE', 'PARQUET STRATIFI�', 'Le Canyon ? Un sol aux allures maison de campagne avec d\'authentiques structures de bois, en deux largeurs de lames. Dites-moi \'oui\' et je vous en montre plus... {modules/smartsection/item.php?itemid=199}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'LAME', 'PARQUET SOL STRATIFI�', 'Parquet stratifi� \'Lame\'. C\'est une nouvelle collection de sols aux �l�ments extra-larges. Un fin biseau en pourtour des �l�ments donnne une surface subtilement quadrill�s. Je vous en montre plus ? {modules/smartsection/item.php?itemid=188}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MELANGO', 'PARQUET SOL STRATIFI� STRATIFIE M�LAMIN� MELAMINE', 'Le parquet Melango... La large lame � jointure en V sur les c�t�s longitudinaux recr�e l\'ambiance authentique du style maison de campagne. Ca vous int�resse ? {modules/smartsection/item.php?itemid=190}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SYSTEMA', 'PARQUET STRATIFI�', 'Systma est une collection s�duisante, � la grande libert� d\'agencements. D�couvrez la gamme systema silence, comprenant une sous-couche acoustique pout att�nuer les nuisances sonores. Voulez-vous en savoir plus � ce sujet ? {modules/smartsection/item.php?itemid=192}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SOL SOLS LI�GE LIEGE PRADO', 'PARQUET SOL LI�GE LIEGE', 'Aaah, les sols en Li�ge... Pour discerner les qualit�s exceptionnelles du sol en li�ge, le mieux est d\'y marcher pieds nus. Cette chaleur sous les pieds est une caract�ristique de confort que l\'on appr�cie pas seulement dans une chambre � coucher. Les propri�t�s du li�ge se traduisent �galement par une �lasticit� particuli�rement b�n�fique pour nos articulations. Voulez-vous voir la collection Prado ? {modules/smartsection/item.php?itemid=191}', 'Connaissez-vous nos rev�tements de sol en Li�ge Prado ?');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'LINORADO SOL LINOLEUM LINO', 'PARQUET SOL', 'Oh oui, le Linorado. Il se moque des roulettes des fauteuils de bureau et est insensible aux t�ches et aux ultraviolets. Il est aussi anti-bact�rien et antistatique. De plus, il est r�alis� en mat�riaux naturels. Vous souhaitez en savoir plus ? {modules/smartsection/item.php?itemid=189}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'MELAMIN� MELAMINE M�LAMIN� M�LAMINE M�LAMIN�S MELAMINES', 'PARQUET REVETEMENT REV�TEMENT SOL', 'Les rev�tements de sol m�lamin�s (ou stratifi�s) sont id�al pour tous les budgets, et sont aujourd\'hui des produits d\'excellente qualit�. Nous diposons de plusieurs type de parquet stratifi�s : melango, canyon, frame et systema. Lequel de ces parquets vous int�resse ?', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND COMMENT CONTACTER TELEPHONE MAIL', 'VOUS TU', 'Je suis pr�sent au magasin tous les jours de la semaine sauf le mardi... et le dimanche bien entendu.|
Vous pouvez me contacter par e-mail � michel.malgras@arma-sa.com, ou par t�l�phone au 0032(0)63.24.26.16. Mais le plus simple, c\'est que vous passiez me voir au magazin.', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'CONTACT CONTACTER', 'COMMENT', 'Vous souhaitez me contacter en direct ? Dites-moi \'oui\' !', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'POLOGNE POLAK POLONAIS', '', 'Ah ah ah ! C\'est vrai que mes coll�gues m\'ont surnomm� le Polak. Quelle bande de farceurs ! ! ! ', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUI ETES ES VOUS TU', '', 'Je m\'appelle Michel, et je suis le responsable du d�partement plein air.|
Mon nom est Michel Malgras. Je m\'occupe du d�partement plein air, et je suis disponible tous les jours de la semaine sauf le vendredi... et le dimanche bien entendu.', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'RENSEIGNEMENT INFORMATION RENSEIGNEMENTS INFORMATIONS', '', 'Je peux vous renseigner sur tout ce qui touche au d�partement plein. Cliquez sur [+] Informations pour en savoir plus sur les gammes de produit dont je m\'occupe.', '');

INSERT INTO chatbot_content VALUES ('', 4, 1, '', 'DIY', '', 'DIY est l\'acronyme de DO IT YOURSELF, ce qui signifie - Faites-le Vous-M�me - en anglais. ', '');

INSERT INTO chatbot_content VALUES ('', 1, 1, '', 'QUESTIONS QUESTION CONSEIL CONSEILLER CONSEILS', 'QUELLE QUELLES QUEL', 'Vous pouvez me poser n\'importe quelle question, du moment que cela concerne mon d�partement. Pour en savoir plus sur les sujets de conversation que je ma�trise, vous pouvez cliquer sur le [+] � droite de cette page. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PARQUET', 'CHENE HETRE', '', 'Selon le type de parquet que vous choisirez, il est possible de trouver l\'essence qui conviendra le mieux � votre int�rieur. Souhaitez vous du parquet m�lamin� ou plaqu� bois ?|
Tout d�pend du type de parquet recherch�. La plupart de nos rev�tements de sol sont disponibles en ch�ne, en h�tre ou m�me en erable, directement de stock ou sur commande. Quel type de rev�tement cherchez-vous ? Du m�lamin�, ou du semi massif ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'QUICKSTEP QUICK STEP', '', 'Nous ne commercialisons pas le parquet de la marque Quickstep. Par contre, nous disposons de produits de qualit� �quivalente de la marque Meister. Ces parquets sont disponibles en semi-massif, stratifi�, lino et m�me en rev�tement de sol en li�ge... Lequel vous int�resse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'UNICLIC', 'SYST�ME SYSTEME', 'Le syst�me uniclic est un syst�me brevet� qui permet la pose facile du parquet, sans colle. Vous pouvez monter ou d�monter une lame jusqu\'� 8 fois ! Vous gagnez �norm�ment de temps � la pose, et surtout, c\'est beaucoup moins salissant. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SOUS-COUCHE SOUS COUCHE ISOLANT ISOLANTE', '', 'Selon le type de parquet utilis�, vous  aurez besoin d\'une sous-couche d\'isolation acoustique. Vous pouvez vous en procurer � part, ou alors opter pour le systema silence de chez Meister. Avec ce type de parquet, vous disposez d\'une sous-couche acoustique incluse, ce qui permet de gagner �norm�ment en temps � la pose.', '');

INSERT INTO chatbot_content VALUES ('', 13, 1, '', 'SUPERMIMI MIMI', '', 'Houaaaahhh ! Vous aussi vous connaissez l\'identit� secr�te de Supermimi ? :-D :-D :-D', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'FRANCIS LABREL CABREL', 'APPEL APPELLE', 'Non, non, mes coll�gues m\'appellent Francis Labrel...', '');

INSERT INTO chatbot_content VALUES ('', 2, 1, '', 'QUI RANG�', 'ITAUBA', 'Qui a rang� l\'Itauba ? Faut demander � Hulk...', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND VAS IRAS', 'WOODEX TU', 'Ah, ben c\'est sur, aujourd\'hui, on va chez Woodexx. D\'ailleur, je me suis bien pr�par�...', '');

INSERT INTO chatbot_content VALUES ('', 12, 1, '', 'QUAND RETRAITE', 'TU VAS', 'Aah ben, je sais pas quand je vais prendre ma retraite, mais je sais gr�ce � qui...', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'PINUS', 'MASSIF PARQUET CHENE CHATAIGNIER CHATAINIER CHATAIGNER', 'REVETEMENT SOL PLANCHER', 'Nous avons en magasin du ch�ne massif en diff�rentes largeurs et �paisseurs :10, 14, et 21 mm d\'�paisseur. Nous avons ce type de parquet en chataigner en 14mm d\'�pais et en Pin de la gamme Pinus. Lequel vous int�resse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, ' PINUS', 'PINUS PARQUET MASSIF', '', 'Dans la gamme Pinus, vous retrouvez un tr�s large assortiment en parquet massif. {modules/smartsection/item.php?itemid=103}', 'Connaissez-vous notre gamme de parquet massif en sapin du nord ? C\'est notre gamme Pinus.');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'PARQUET MASSIF POSE', '', 'Dans les parquets massifs, vous avez deux types de pose : soit clou� sur lambourde, soit coll� sur tout support. Lequel vous int�resse ?', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'SIKA COLLE POSE', 'CONSEIL CONSEILS POSER PARQUET', 'Pour poser les parquets en massif, nous conseillons la colle T52 de chez Sika. C\'est une colle �lastique pour parquet sans solvant. {modules/smartsection/item.php?itemid=112}', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, '', 'CHATAIGNIER CHATAINIER CHATAIGNER', 'PARQUET ESSENCE', 'Effectivement, nous avons du parquet massif en chataignier � coller. Bien �videmment, vous trouverez, comme pour tous nos autres produits, les plinthes assorties. ', '');

INSERT INTO chatbot_content VALUES ('', 3, 1, 'BAMBOU', 'BAMBOU BAMBOUS CARBO EXOTIQUE PARQUET', 'CHERCHE', 'Le parquet bambou, c\'est un produit exotique extra. 30% de duret� en plus que le ch�ne ! Nous disposons d\'un tr�s large choix dans ce domaine. Que ce soit le carbo ou nature... Nous avons m�me une version pont de bateau � d�couvrir en magasin.|Aaah, le parquet Bambou... Enorm�ment de personnes nous demande ce type de parquet. En bois exotique, c\'est l\'id�al pour donner une couleur asiatique � vos int�rieurs. {modules/smartsection/item.php?itemid=50}', 'Avez-vous d�j� essay� le parquet bambou ? ');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'PRODUIS PRODUI PRODUIT PRODUITS ENTRETIEN BOIS HUILE HUILES HUILER PARQUET INT�RIEUR EXT�RIEUR INTERIEUR EXTERIEUR', '', 'Nous disposons d\'un large assortiment de produits d\'entretien pour les bois. Que ce soit pour vos int�rieurs ou pour vos ext�rieurs. Que cherchez-vous ?', '');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'HUILE HUILES INT�RIEURE INTERIEUR INTERIEURE ENTRETIEN INT�RIEUR INT�RIEURS', '', 'Pour les produits d\'entretien pour parquet massifs, nous conseillons l\'huile Trip-Trap. {modules/smartsection/item.php?itemid=66}|
La meilleure huile pour entretenir les parquets en bois est disponible chez Trip-Trap. {modules/smartsection/item.php?itemid=66}', '');

INSERT INTO chatbot_content VALUES ('', 14, 1, 'ENTRETIEN', 'ENTRETIEN HUILE HUILES EXT�RIEUR EXTERIEUR EXT�RIEURE EXTERIEURE EXT�RIEURES BARDAGE CEDRE', '', 'Pour vos bois ext�rieurs, nous avons une huile d\'entretien disponible en diff�rentes coloris. C\'est l\'id�al pour les bardages en c�dre. Pour plus d\'informations, me contacter...', '');

INSERT INTO chatbot_content VALUES ('', 15, 1, 'PLINTHES', 'PLINTHES PLINTH PLAINTH PLAINTHE PLEINTE PLINTE', '', 'Pour tous les types de parquet, nous avons la plinthes correspondante � votre rev�tement. ', '');


-- 
-- Contenu de la table `chatbot_eliza`
-- 

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'suis', '�tes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'as', 'ai');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ai', 'avez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'ai', 'vous avez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'avais', 'vous aviez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, '�tes', 'suis');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'es', 'suis');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'je', 'vous');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tu', 'je');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'v�tres', 'n�tres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'nous', 'vous');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ton', 'ma');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mon', 'votre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'ta', 'ma');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'�tais', 'vous �tiez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'j\'aurais', 'vous auriez');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mes', 'vos');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'vos', 'mes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tes', 'mes');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'notre', 'votre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'miens', 'v�tres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'v�tre', 'n�tre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mien', 'v�tre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'mienne', 'v�tre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'miennes', 'v�tres');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tienne', 'n�tre');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'tiennes', 'n�tres');

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
Est-il vraiment n�cessaire que je vous(*)?');

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
Je pr�f�re ne pas r�pondre � ce genre de question...');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'te', 'me');

INSERT INTO chatbot_eliza VALUES ('', 1, 1, 'me', 'te');




-- 
-- Contenu de la table `chatbot_topics`
-- 

INSERT INTO chatbot_topics VALUES (2, 1, '[FRANCIS]', 'Quelques informations � propos de Francis, responsable du d�partement bois.');

INSERT INTO chatbot_topics VALUES (3, 2, 'Parquets', 'Tout � propos de nos parquets en m�lamin�, stratifi�, bois brute, plaqu� bois...');

INSERT INTO chatbot_topics VALUES (1, 1, '[COMMUN] R�actions standard', 'Les questions/r�ponses communes et formules de politesse.');

INSERT INTO chatbot_topics VALUES (4, 1, '[COMMUN] Arma', 'Quelques informations � propos d\'Arma.');

INSERT INTO chatbot_topics VALUES (5, 2, 'Lambris', 'Toutes les informations � propos  de nos lambris en bois massif naturel et verni ou MDF.');

INSERT INTO chatbot_topics VALUES (6, 2, 'Placards', 'D�couvrez nos placards et nos agencements int�rieurs sur-mesure !');

INSERT INTO chatbot_topics VALUES (7, 2, 'Escaliers', 'Les informations utiles � propos des escaliers en bois ou en m�tal.');

INSERT INTO chatbot_topics VALUES (8, 2, 'Planchers de terrasse', 'Toutes les infos relatives aux planchers de terrasse en bois exotique et sapin autoclave.');

INSERT INTO chatbot_topics VALUES (9, 2, 'Panneaux', 'Tous les types de panneaux : m�lamin�s, marin, dalles d\'agencement OSB, etc.');

INSERT INTO chatbot_topics VALUES (10, 2, 'Isolation', 'Les infos � propos de l\'isolation : laine de verre, laine de roche, multicouche et styrodur.');

INSERT INTO chatbot_topics VALUES (11, 1, '[SERGE]', 'Quelques informations � propos de Serge, responsable du d�partement peinture.');

INSERT INTO chatbot_topics VALUES (12, 1, '[MICHEL M]', 'Quelques informations � propos de Michel Malgras, responsable du d�partement plein air.');

INSERT INTO chatbot_topics VALUES (13, 1, '[MICHEL A]', 'Quelques informations � propos de Michel Ambroise, responsable du d�partement outillage.');

INSERT INTO chatbot_topics VALUES (14, 2, 'Produits d\'entretien', 'Tous sur les produits d\'entretien pour parquet.');

INSERT INTO chatbot_topics VALUES (15, 2, 'Plinthes et accessoires', 'Toutes les infos � propos de nos plinthes, moulures et accessoires pour vos am�nagements int�rieurs.');