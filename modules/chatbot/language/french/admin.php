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
define("CHATBOT_ELIZA_TYPE_3",	        "Données");


// utilities.php
define("_MD_CHATBOT_UTILITIES",		"Utilitaires");
define("_MD_CHATBOT_CLONE",		"Clonage du module");
define("_MD_CHATBOT_CLONENAME",	        "Nom du clone<br /><i>
                                         <ul>
                                             <li>Pas plus de 16 caractères</li>
                                             <li>Pas de caractères spéciaux</li>
                                             <li>Pas de nom de module déjà existant</li>
                                             <li>Majuscules et espacements acceptés</li>
                                         </ul></i>
                                         Exemple : 'Mon Module 01'. ");
define("_MD_CHATBOT_DB_DATAS",		"Données SQL");
define("_MD_CHATBOT_DB_IMPORT",		"Importation dans la base de donnée");
define("_MD_CHATBOT_DB_EXPORT",		"Exportation de la base de donnée");
define("_MD_CHATBOT_EXPORT",		"Exporter");
define("_MD_CHATBOT_INSERT",		"Ajouter");
define("_MD_CHATBOT_UPDATE",		"Mettre à jour");
define("_MD_CHATBOT_TOPIC_INFOS",	"<ul><li><i>Choisir le sujet de conversation<br />
pour les données en provenance<br />
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
                                        </a>(c) Août-Septembre 2006
                                        ");

define("_MD_CHATBOT_SUBMIT",	"Enregistrer");
define("_MD_CHATBOT_CLEAR",	"Effacer");
define("_MD_CHATBOT_CANCEL",	"Annuler");
define("_MD_CHATBOT_MODIFY",	"Modifier");
define("_MD_CHATBOT_EDIT",      "Editer");
define("_MD_CHATBOT_HIDDEN",    "Masqué");
define("_MD_CHATBOT_SEARCH",    "Chercher l'expression");

//index.php
define("_MD_CHATBOT_STATS",	"Stats");
define("_MD_CHATBOT_SUMMARY",	"Récapitulatif");
define("_MD_CHATBOT_ADMIN_TEXT","<h1 align='center'>ChatBot 1.0</h1>
Bienvenue dans ChatBot, le module de chat robotisé.");
define("_MD_CHATBOT_TITLE_REPLIES",	"Q/R");
define("_MD_CHATBOT_TITLE_CHAT",	"Q/R (Eliza)");

// content.php
define("_MD_CHATBOT_CONTENT",	"Gérer les questions/réponses");
define("_MD_CHATBOT_REPLIES",	"Questions/Réponses");

// topics.php
define("_MD_CHATBOT_TOPICS",	        "Sujets de conversation<br />
<i>Choisir les sujets de conversations du bot.
<ul>
<li>[ELIZA] : Active le mode de conversation 'Eliza Bot'</li>
<li>Autres sujets : Active les conversations 'Akali Bot'</li>
</ul></i>");
define("_MD_CHATBOT_TOPIC",	        "Sujet de conversation");
define("_MD_CHATBOT_PAGELINK",          "Page/module lié");
define("_MD_CHATBOT_PAGELINKDSC",          "<br />
Indiquer l'url de la page<br />
ou du module lié.");
define("_MD_CHATBOT_TOPIC_TITLE",	"Gérer les sujets de conversation");

// content.php
define("_MD_CHATBOT_TITLE_AND",	    "Obligatoire");
define("_MD_CHATBOT_TITLE_OR",	    "Facultatif");
define("_MD_CHATBOT_TITLE_CONTEXT", "Contextuel");
define("_MD_CHATBOT_TITLE_REPLY",   "Réponse");
define("_MD_CHATBOT_TITLE_QUESTION","Discussion");

define("_MD_CHATBOT_AND",	"Obligatoire<br />
- Termes obligatoires");
define("_MD_CHATBOT_CONTEXT",	"Contextuel<br />
- Termes contextuels<br />
suivant discussions précédentes");
define("_MD_CHATBOT_OR",	"Facultatif<br />
- Termes secondaires");
define("_MD_CHATBOT_REPLY",	"Réponse<br />
- A utiliser pour répondre<br />à une question précise.");
define("_MD_CHATBOT_QUESTION",	"Discussion<br />
- A utiliser pour <br />démarrer ou relancer<br />la dicussion.");

// Bots
define("_MD_CHATBOT_BOTS",      "ChatBots");
define("_MD_CHATBOT_BOT",       "Gérer les ChatBots");
define("_MD_CHATBOT_NAME",      "Nom du bot *");
define("_MD_CHATBOT_SMILIES",   "Répertoire du bot *<br /><i>
<ul><li>Images du bot</li>
<li>Emoticônes</li>
<li>Fichiers .js</li></ul>
Le répertoire doit être ouvert en écriture (vérifiez le CHMOD)!</i>");

define("_MD_CHATBOT_ACTIVE",    "Actif");
define("_MD_CHATBOT_INACTIVE",  "Inactif");
define("_MD_CHATBOT_IMAGE",     "Avatar");

define("_MD_CHATBOT_BACKGROUND","Illustrations<br /><i>
<font color='red'>Fond de page</font>|
<font color='blue'>Boîte de dialogue</font>|<br />
<font color='red'>Fond sonore</font>|
<font color='blue'>Son pour le mode 'machine à écrire'</font>|<br />
<font color='green'>Adresses mails</font></i>");

define("_MD_CHATBOT_COLOR",     "Couleurs<br /><i>
<font color='red'>Texte de la page</font>|
<font color='blue'>Fond de page</font>|<br />
<font color='red'>Texte boîte de dialogue</font>|
<font color='blue'>Fond de boîte de dialogue</font>|<br />
<font color='green'>Taille de la bordure</font></i>");

define("_MD_CHATBOT_INTRO",     "Phrase d'accueil<br /><i>
- Séparer chaque phrase par : |<br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: Bonjour {USERNAME}.|Salut!</i>");

define("_MD_CHATBOT_DUMB",      "Expressions personnalisées<br /><i>
- Séparer chaque phrase par : | <br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: He he {USERNAME}.|Hm...</i>");

define("_MD_CHATBOT_ZERO",      "Phrases d'incompréhension<br /><i>
Expressions utilisées lors d'un changement de sujet de conversation.
- Séparer chaque phrase par : |<br />
- Supporte les tags : {USERNAME}, etc.<br />
Ex: Pardon {USERNAME} ?|Ah oui!</i>");

define("_MD_CHATBOT_END",       "Phrase de conclusion<br /><i>
- Séparer chaque phrase par : |<br />
- Supporte les tags : {USERNAME},etc.<br />
Ex: Au revoir {USERNAME}.|A bientôt!</i>");

define("_MD_CHATBOT_GROUPS",      "Groupes");

// Datas redirection
define("_MD_CHATBOT_CREATE",            "Créer une nouvelle entrée");
define("_MD_CHATBOT_CREATED",	        "Donnée crée avec succès");
define("_MD_CHATBOT_NOTCREATED",        "Echec de la création de donnée");
define("_MD_CHATBOT_UPDATED",	        "Donnée mise à jour avec succès");
define("_MD_CHATBOT_NOTUPDATED",        "Echec de la mise à jour de donnée");
define("_MD_CHATBOT_DELETETHISDATA",    "Êtes vous certain de vouloir supprimer cette donnée ?");
define("_MD_CHATBOT_DELETED",	        "Donnée supprimée avec succès !");
define("_MD_CHATBOT_DELETE",            "Supprimer");

// Eliza
define("_MD_CHATBOT_CHAT",	        "Question/Réponse 'Eliza'");
define("_MD_CHATBOT_TYPE",	        "Type");
define("_MD_CHATBOT_KEYWORD",	        "Mot clé");
define("_MD_CHATBOT_REPLACEMENT",	"Remplacement");
define("_MD_CHATBOT_REPLIES_",	        "Réponses");

define("_MD_CHATBOT_SENTENCE",	        "Questions utilisateurs<br /><i>
- Séparer chaque phrase par : |<br />
Ex: Je te|Je vous</i>");

define("_MD_CHATBOT_REPLY_",	        "Réponses du bot<br /><i>
- Séparer chaque réponse par : |<br />
- Utiliser '(*)+ponctuation' pour remplacer le contenu.<br />
- Ponctuation possible : (. ! ? ...)<br />
Ex: Pourquoi me (*)?|D'accord!</i>");
// define("_MD_CHATBOT_MOREINFO",	        " <a href='http://tecfa.unige.ch/guides/js/jsref12/corea3.htm#1158210' target='_blank'>Plus d'infos...</a>");
define("_MD_CHATBOT_FROM",	        "De...");
define("_MD_CHATBOT_TO",	        "Vers...");
define("_MD_CHATBOT_CONVERSIONS",	"Conversion (avant application du masque)");
define("_MD_CHATBOT_CORRECTIONS",	"Correction (après application du masque)");
define("_MD_CHATBOT_DATAS",	        "Données (Masque et réponses aléatoires)");

define("_MD_CHATBOT_CONVERSION",	"Conversion");
define("_MD_CHATBOT_CORRECTION",	"Correction");
define("_MD_CHATBOT_DATA",	        "Données");

// Reports
define("_MD_CHATBOT_REPORTS",	        "Rapports de discussion");
define("_MD_CHATBOT_REPORTS_TITLE",	"Gérer les rapports de discussion");
define("_MD_CHATBOT_TITLE_CONVO",	"Conversation");
define("_MD_CHATBOT_TITLE_INFOS",	"Infos");

// Utilities
define("_MD_CHATBOT_CLONED",	        "Module cloné avec succès");
define("_MD_CHATBOT_MODULEXISTS",	"Ce module existe déjà");
define("_MD_CHATBOT_NOTCLONED",	        "Les paramètres du clonage sont incorrectes");
define("_MD_CHATBOT_CLONE_TROUBLE",	"Les paramètres de votre hébergement ne permettent pas le clonage.
					 Veuillez réessayer dans un environnement qui autorise le changement de permissions en écriture.
                                         (Exemple : en local)");

define("_MD_CHATBOT_MEDIA",	        "Medias");
define("_MD_CHATBOT_UPLOADMEDIA",	"Fichier à téléverser");
define("_MD_CHATBOT_UPLOAD",	        "Téléverser un média");
define("_MD_CHATBOT_UPLOAD_ERROR",	"Erreur lors du traitement de téléversement !");
define("_MD_CHATBOT_UPLOADED",	        "Média téléversé avec succès");


// Blocs et Groupes
define("_MD_CHATBOT_BLOCKS",	        "Gestion des Blocs et Groupes d'accès");
?>