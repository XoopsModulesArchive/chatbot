<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

if (file_exists("../language/".$xoopsConfig['language']."/help.php")) {
   include "../language/".$xoopsConfig['language']."/help.php";
} elseif (file_exists("../language/english/help.php")) {
   include "../language/english/help.php";
}

// Admin Navigation
define("_MD_CHATBOT_INDEX",	        "Index");
define("_MD_CHATBOT_HELP",	        "Aide");
define("_MD_CHATBOT_ADMIN",	        "Admin");
define("_MD_CHATBOT_EDIT_BOT",	        "- Bot -");
define("_MD_CHATBOT_EDIT_TOPIC",	"- Sujet de conversation -");
define("_MD_CHATBOT_EDIT_AKALI",	"- Ajouter Q/R : Akali -");
define("_MD_CHATBOT_EDIT_ELIZA",	"- Ajouter Q/R : Eliza -");
define("_MD_CHATBOT_EDIT_REPORT",	"- Rapports de discussion -");
define("_MD_CHATBOT_EDIT_CHAT",	        "Discuter avec...");
define("CHATBOT_ELIZA_TYPE_1",	        "Conversion");
define("CHATBOT_ELIZA_TYPE_2",	        "Correction");
define("CHATBOT_ELIZA_TYPE_3",	        "Donn�es");


// utilities.php
define("_MD_CHATBOT_UTILITIES",		"Utilitaires");
define("_MD_CHATBOT_CLONE",		"Clonage du module");
define("_MD_CHATBOT_CLONENAME",	        "Nom du clone<br /><i>
                                         <ul>
                                             <li>Pas plus de 16 caract�res</li>
                                             <li>Pas de caract�res sp�ciaux</li>
                                             <li>Pas de nom de module d�j� existant</li>
                                             <li>Majuscules et espacements accept�s</li>
                                         </ul></i>
                                         Exemple : 'Mon Module 01'. ");
define("_MD_CHATBOT_DB_DATAS",		"Donn�es SQL");
define("_MD_CHATBOT_DB_IMPORT",		"Importation dans la base de donn�e");
define("_MD_CHATBOT_DB_EXPORT",		"Exportation de la base de donn�e");
define("_MD_CHATBOT_EXPORT",		"Exporter");
define("_MD_CHATBOT_INSERT",		"Ajouter");
define("_MD_CHATBOT_UPDATE",		"Mettre � jour");
define("_MD_CHATBOT_TOPIC_INFOS",	"<ul><li><i>Choisir le sujet de conversation<br />
pour les donn�es en provenance<br />
de la table '<font color='red'>chatbot_content</font>'</i></li>");

// common
define("_MD_CHATBOT_STATUS",	"Status");
define("_MD_CHATBOT_ONLINE",	"Utiliser");
define("_MD_CHATBOT_OFFLINE",	"Ignorer");
define("_MD_CHATBOT_DESCRIPTION",       "Description");

define("_MD_CHATBOT_CREDIT",	        "ChatBot 1.0 est une creation de Solo (Solo71)<br />
                                        <img src='../images/chatbot_tag.png' alt='myHome' align='absmiddle' />
                                        <a href='http://wolfactory.wolfpackclan.com/' target='_blank'>
                                        <img src='../images/wolfactory_tag.gif' alt='wolFactory' align='absmiddle' />
                                        </a>(c) Ao�t-Septembre 2006
                                        ");

define("_MD_CHATBOT_SUBMIT",	"Enregistrer");
define("_MD_CHATBOT_CLEAR",	"Effacer");
define("_MD_CHATBOT_CANCEL",	"Annuler");
define("_MD_CHATBOT_MODIFY",	"Modifier");
define("_MD_CHATBOT_EDIT",      "Editer");
define("_MD_CHATBOT_HIDDEN",    "Masqu�");
define("_MD_CHATBOT_SEARCH",    "Chercher l'expression");

//index.php
define("_MD_CHATBOT_STATS",	"Stats");
define("_MD_CHATBOT_SUMMARY",	"R�capitulatif");
define("_MD_CHATBOT_ADMIN_TEXT","<h1 align='center'>ChatBot 1.0</h1>
Bienvenue dans ChatBot, le module de chat robotis�.");
define("_MD_CHATBOT_TITLE_REPLIES",	"Q/R");
define("_MD_CHATBOT_TITLE_CHAT",	"Q/R (Eliza)");

// content.php
define("_MD_CHATBOT_CONTENT",	"G�rer les questions/r�ponses");
define("_MD_CHATBOT_REPLIES",	"Questions/R�ponses");

// topics.php
define("_MD_CHATBOT_TOPICS",	        "Sujets de conversation<br />
<i>Choisir les sujets de conversations du bot.
<ul>
<li>[ELIZA] : Active le mode de conversation 'Eliza Bot'</li>
<li>Autres sujets : Active les conversations 'Akali Bot'</li>
</ul></i>");
define("_MD_CHATBOT_TOPIC",	        "Sujet de conversation");
define("_MD_CHATBOT_PAGELINK",          "Page/module li�");
define("_MD_CHATBOT_PAGELINKDSC",          "<br />
Indiquer l'url de la page<br />
ou du module li�.");
define("_MD_CHATBOT_TOPIC_TITLE",	"G�rer les sujets de conversation");

// content.php
define("_MD_CHATBOT_TITLE_AND",	    "Obligatoire");
define("_MD_CHATBOT_TITLE_OR",	    "Facultatif");
define("_MD_CHATBOT_TITLE_CONTEXT", "Contextuel");
define("_MD_CHATBOT_TITLE_REPLY",   "R�ponse");
define("_MD_CHATBOT_TITLE_QUESTION","Discussion");

define("_MD_CHATBOT_AND",	"Obligatoire<br />
- Termes obligatoires");
define("_MD_CHATBOT_CONTEXT",	"Contextuel<br />
- Termes contextuels<br />
suivant discussions pr�c�dentes");
define("_MD_CHATBOT_OR",	"Facultatif<br />
- Termes secondaires");
define("_MD_CHATBOT_REPLY",	"R�ponse<br />
- A utiliser pour r�pondre<br />� une question pr�cise.");
define("_MD_CHATBOT_QUESTION",	"Discussion<br />
- A utiliser pour <br />d�marrer ou relancer<br />la dicussion.");

// Bots
define("_MD_CHATBOT_BOTS",      "ChatBots");
define("_MD_CHATBOT_BOT",       "G�rer les ChatBots");
define("_MD_CHATBOT_NAME",      "Nom du bot *");
define("_MD_CHATBOT_SMILIES",   "R�pertoire du bot *<br /><i>
<ul><li>Images du bot</li>
<li>Emotic�nes</li>
<li>Fichiers .js</li></ul>
Le r�pertoire doit �tre ouvert en �criture (v�rifiez le CHMOD)!</i>");

define("_MD_CHATBOT_ACTIVE",    "Actif");
define("_MD_CHATBOT_INACTIVE",  "Inactif");
define("_MD_CHATBOT_IMAGE",     "Avatar");

define("_MD_CHATBOT_BACKGROUND","Illustrations<br /><i>
<font color='red'>Fond de page</font>|
<font color='blue'>Bo�te de dialogue</font>|<br />
<font color='red'>Fond sonore</font>|
<font color='blue'>Son pour le mode 'machine � �crire'</font>|<br />
<font color='green'>Adresses mails</font></i>");

define("_MD_CHATBOT_COLOR",     "Couleurs<br /><i>
<font color='red'>Texte de la page</font>|
<font color='blue'>Fond de page</font>|<br />
<font color='red'>Texte bo�te de dialogue</font>|
<font color='blue'>Fond de bo�te de dialogue</font>|<br />
<font color='green'>Taille de la bordure</font></i>");

define("_MD_CHATBOT_INTRO",     "Phrase d'accueil<br /><i>
- S�parer chaque phrase par : |<br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: Bonjour {USERNAME}.|Salut!</i>");

define("_MD_CHATBOT_DUMB",      "Expressions personnalis�es<br /><i>
- S�parer chaque phrase par : | <br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: He he {USERNAME}.|Hm...</i>");

define("_MD_CHATBOT_ZERO",      "Phrases d'incompr�hension<br /><i>
Expressions utilis�es lors d'un changement de sujet de conversation.
- S�parer chaque phrase par : |<br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: Pardon {USERNAME} ?|Ah oui!</i>");

define("_MD_CHATBOT_END",       "Phrase de conclusion<br /><i>
- S�parer chaque phrase par : |<br />
- Supporte les tags : {USERNAME},etc.<br />
Ex: Au revoir {USERNAME}.|A bient�t!</i>");

define("_MD_CHATBOT_GROUPS",      "Groupes");

// Datas redirection
define("_MD_CHATBOT_CREATE",            "Cr�er une nouvelle entr�e");
define("_MD_CHATBOT_CREATED",	        "Donn�e cr�e avec succ�s");
define("_MD_CHATBOT_NOTCREATED",        "Echec de la cr�ation de donn�e");
define("_MD_CHATBOT_UPDATED",	        "Donn�e mise � jour avec succ�s");
define("_MD_CHATBOT_NOTUPDATED",        "Echec de la mise � jour de donn�e");
define("_MD_CHATBOT_DELETETHISDATA",    "�tes vous certain de vouloir supprimer cette donn�e ?");
define("_MD_CHATBOT_DELETED",	        "Donn�e supprim�e avec succ�s !");
define("_MD_CHATBOT_DELETE",            "Supprimer");

// Eliza
define("_MD_CHATBOT_CHAT",	        "Question/R�ponse 'Eliza'");
define("_MD_CHATBOT_TYPE",	        "Type");
define("_MD_CHATBOT_KEYWORD",	        "Mot cl�");
define("_MD_CHATBOT_REPLACEMENT",	"Remplacement");
define("_MD_CHATBOT_REPLIES_",	        "R�ponses");

define("_MD_CHATBOT_SENTENCE",	        "Questions utilisateurs<br /><i>
- S�parer chaque phrase par : |<br />
Ex: Je te|Je vous</i>");

define("_MD_CHATBOT_REPLY_",	        "R�ponses du bot<br /><i>
- S�parer chaque r�ponse par : |<br />
- Utiliser '(*)+ponctuation' pour remplacer le contenu.<br />
- Ponctuation possible : (. ! ? ...)<br />
Ex: Pourquoi me (*)?|D'accord!</i>");
// define("_MD_CHATBOT_MOREINFO",	        " <a href='http://tecfa.unige.ch/guides/js/jsref12/corea3.htm#1158210' target='_blank'>Plus d'infos...</a>");
define("_MD_CHATBOT_FROM",	        "De...");
define("_MD_CHATBOT_TO",	        "Vers...");
define("_MD_CHATBOT_CONVERSIONS",	"Conversion (avant application du masque)");
define("_MD_CHATBOT_CORRECTIONS",	"Correction (apr�s application du masque)");
define("_MD_CHATBOT_DATAS",	        "Donn�es (Masque et r�ponses al�atoires)");

define("_MD_CHATBOT_CONVERSION",	"Conversion");
define("_MD_CHATBOT_CORRECTION",	"Correction");
define("_MD_CHATBOT_DATA",	        "Donn�es");

// Reports
define("_MD_CHATBOT_REPORTS",	        "Rapports de discussion");
define("_MD_CHATBOT_REPORTS_TITLE",	"G�rer les rapports de discussion");
define("_MD_CHATBOT_TITLE_CONVO",	"Conversation");
define("_MD_CHATBOT_TITLE_INFOS",	"Infos");

// Utilities
define("_MD_CHATBOT_CLONED",	        "Module clon� avec succ�s");
define("_MD_CHATBOT_MODULEXISTS",	"Ce module existe d�j�");
define("_MD_CHATBOT_NOTCLONED",	        "Les param�tres du clonage sont incorrectes");
define("_MD_CHATBOT_CLONE_TROUBLE",	"Les param�tres de votre h�bergement ne permettent pas le clonage.
					 Veuillez r�essayer dans un environnement qui autorise le changement de permissions en �criture.
                                         (Exemple : en local)");

define("_MD_CHATBOT_MEDIA",	        "Medias");
define("_MD_CHATBOT_UPLOADMEDIA",	"Fichier � t�l�verser");
define("_MD_CHATBOT_UPLOAD",	        "T�l�verser un m�dia");
define("_MD_CHATBOT_UPLOAD_ERROR",	"Erreur lors du traitement de t�l�versement !");
define("_MD_CHATBOT_UPLOADED",	        "M�dia t�l�vers� avec succ�s");


// Blocs et Groupes
define("_MD_CHATBOT_BLOCKS",	        "Gestion des Blocs et Groupes d'acc�s");
?>