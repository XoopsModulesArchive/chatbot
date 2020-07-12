<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

// Admin Navigation
define("_MD_CHATBOT_HOWTO",	"Mode d'emploi");
define("_MD_CHATBOT_HOWTO_CONTENT_01",	"
<style type='text/css'>
.help ul { text-align: left; padding-left:50px; }
.help li { padding:5px; margin:5px;  list-style-type: disc;}
.exemple ul { }
.exemple li { margin:5px; list-style-type: disc; color:red;}
</style>

<p style='font-weight:bold;'>Basé sur un système de calcul de points en fonction des occurences de mots clés. Le script renvoie la réponse la réponse la plus pertinente en fonction des questions posées, et ne répond pas deux fois la même chose.</p>
<br />

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Mode d'emploi</div>
<ul class='help'>
    <li class='help'> <b>Sujet de conversation :</b> <br />Choisir un sujet de discussion auquel la question/réponse sera affectée.</li>
    <li class='help'> <b>Obligatoire :</b> <br />Liste des mots clés obligatoires pour activer la réponse. 
    Un seul terme correpondant activera la réponse.</li>
    <li class='help'> <b>Facultatif :</b> <br />Liste des mots clés facultatifs pour induire une réponse. 
    Un terme correspondant favorisera la réponse.</li>
    <li class='help'> <b>Contextuel :</b> <br />Liste des mots clés pour lier des réponses entre-elles.
    Si aucun mot clé obligatoire n'est détecté dans la réponse, il poursuit la conversation sur un thème équivalent.</li>
    <li class='help'> <b>Réponses :</b> <br />Réponses fournies obligatoirement si l'un des mots clés est activé. 
    A employer avec mots clés uniquement.</li>
    <li class='help'> <b>Discussion :</b> <br />Réponses fournies à une question précise, 
    ou si aucun terme n'est détecté afin de relancer la discussion sur un autre sujet.<br />Peut s'employer avec ou sans mots clés.</li>
</ul>
<font color='red'><u><b>Comment 'Activer une redirection' ?</b></u><p />
Valable uniquement pour les 'réponses' et 'discussions'.<br />
Insérer un lien dans une réponse (avec ouverture automatique ou non - paramétrable dans les préférences du module),
écrire le lien en url absolue ou relative entre {}.<p />
<u>Exemple</u> :<ul class='exemple'>
<li class='exemple'>{modules/news/}</li>
<li class='help'>{modules/chatbot/bot.php?id=1} </li>
<li class='exemple'>{www.wolfpackclan.com} </li>
<li class='exemple'>{http://wolfactory.wolfpackclan.com}</li></ul></font>
");


define("_MD_CHATBOT_HOWTO_CONTENT_02",	"
<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Exemple de configuration</div>
<ul class='help'>
    <li class='help'>Pour créer une conversation et assurer un suivi, il faut concevoir les réponses en entonnoir.</li>
</ul>
<div align='center'>
<table class='outer' style='background-color:white;width:80%;'>
       <tr>
       <th colspan='7'>Xoops</th>
       </tr>
                      
       <tr>
           <th>Obligatoire</th>
           <th>Facultatif</th>
           <th>Contextuel</th>
           <th width='35%'>Réponse</th>
           <th width='35%'>Discussion</th>
       </tr>
                                         
       <tr>
           <td class='even'>BLOC BLOCS</td>
           <td class='even'>XOOPS</td>
           <td class='even'>XOOPS BLOC</td>
           <td class='even'>
               <ul>
                   <li>Voici une autre explication sur les blocs. </li>
                   <li>Voici une explication sur les blocs.
                       Voulez-vous savoir autre chose ?</li>
               </ul>
           </td>
           <td class='even'>
               <ul>
                   <li>Voulez-vous une explications sur les blocs ou sur les modules ?</li>
               </ul>
           </td>
       </tr>

       <tr>
           <td class='even'>MODULE MODULES</td>
           <td class='even'>XOOPS</td>
           <td class='even'>XOOPS MODULE</td>
           <td class='even'>
               <ul>
                   <li>Une autre explication sur les modules.</li>
                   <li>Voici une explication sur les modules.
                       Voulez-vous savoir autre chose ?</li>
               </ul>
           </td>
           <td class='even' width='25%'>
               <ul>
                   <li>Voulez-vous une explications sur les modules ou sur les blocs ?</li>
               </ul>
           </td>
       </tr>
</table>
</div><br />
<b><u>Exemple</u> :</b>
    <ul class='help'>
    <li class='help'><b>User :</b> Bonjour !</li>
                             - Le bot ne connaît pas ce mot clé,<br />
                               il va donc chercher l'une des réponses de la colonne discussion.
    <li class='help'><b>Bot :</b> Voulez-vous une explications sur les modules ou sur les blocs ?</li>
    <li class='help'><b>User :</b> Je veux tout savoir sur les <u>blocs</u>.</li>
                             - Le bot reconnaît le mot clé : 'blocs',<br />
                               il va donc chercher l'une des réponses de la colonne obligatoire.
    <li class='help'><b>Bot :</b> Voici une explication sur les blocs. Voulez-vous savoir autre chose ?</li>
    <li class='help'><b>User :</b> Oui, je veux que l'on parle d'autre chose.</li>
                             - Le bot ne reconnaît aucun mot clé,<br /> 
                               mais puisque que l'un des mots clé employé dans la réponse précédente (XOOPS) est aussi présent dans la colonne contextuelle,<br />
                               il va chercher l'une des réponses de la colonne réponse correspondant au terme contextuel (XOOPS).
    <li class='help'><b>Bot :</b> Voici une explication sur les modules.</li>
    </ul>
");

define("_MD_CHATBOT_HOWTO_CONTENT_03",	"
<b><u>Astuces</u> :</b>
        <ul class='help'>
        <li class='help'>Evitez les réponses/questions fermées (réponses 'oui' ou 'non')<br />
                         Exemple : Evitez <i>'Connaissez-vous Xoops ?'</i> Préférez : <i>'Que souhaitez vous savoir au sujet de Xoops?</i></li>
        <li class='help'>Pour diriger la conversation, faites des réponses contenant des propositions.<br />
                         Exemple : <i>Voulez-vous parler des modules ou des blocs ?</i></li>
   </ul>

");

// Eliza
define("_MD_CHATBOT_HOWTO_ELIZA_01",	"
<style type='text/css'>
.help ul { text-align: left; padding-left:50px; }
.help li { padding:5px; margin:5px;  list-style-type: disc;}
</style>

<p style='font-weight:bold;'>
Ces questions-réponses se basent sur la méthode 'Eliza',
c'est à dire qu'elles renvoient à l'utilisateur des réponses basées
ou incluant les expressions clés repérées dans la question de l'utilisateur.
Ce script fonctionne sur base d'un système de masque 
et peut être employé pour éluder les questions trop personnelles.</p>
<br />

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Données</div><br />
Liste des expressions à convertir.
<ul class='help'>
    <li class='help'> <b>Mots clés :</b> <br />Liste des masques à appliquer aux questions de l'utilisateur.<br />
                         Exemple : <i>Je vais vous</i></li>
    <li class='help'> <b>Réponses :</b> <br />Liste des réponses potentielles, choisies de façon aléatoire. 
                         Utilisez (*) suivi du signe de ponctuation adéquat,
                         pour afficher les termes repris dans le masque de la question.<br />
                         Exemple : <i>Pourquoi voulez-vous me(*)?</i></li>
</ul>

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Conversion</div>
<ul class='help'>
    <li class='help'> <b>De... :</b> <br />Liste des termes à convertir des questions de l'utilisateur.<br />
                         Exemple : <i>te</i></li>
    <li class='help'> <b>Vers... :</b> <br />Liste des termes convertis.<br />
                         Exemple : <i>me</i></li>
</ul>

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Correction</div>
<ul class='help'>
    <li class='help'> <b>De... :</b> <br />Liste expressions à convertir après correction des réponses.<br />
                         Exemple : <i>je t'ai</i></li>
    <li class='help'> <b>Vers... :</b> <br />Terme corrigé.<br />
                         Exemple : <i>tu m'as</i></li>
</ul>
");


define("_MD_CHATBOT_HOWTO_ELIZA_02",	"
<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Exemple de configuration</div>
<ul class='help'>
    <li class='help'>Pour créer une réponse sensée, il faut prévoir tous les cas de figure.</li>
</ul>
<div align='center'>
       <table class='outer' style='background-color:white;width:60%;'>
       <tr>
       <th colspan='2'>Données</th>
       </tr>
                      
       <tr>
           <th width='50%'>Expression</th>
           <th width='50%'>Réponses</th>
       </tr>
                                         
       <tr>
           <td class='even'>Je vais</td>
           <td class='even'>
               <ul>
                   <li>Pourquoi voulez-vous(*)?</li>
                   <li>Hm... Sans moi.</li>
               </ul>
           </td>
       </tr>
       </table>
<p />

       <table class='outer' style='background-color:white;width:60%;'>
       <tr>
       <th colspan='2'>Conversion</th>
       </tr>
       <tr>
           <th width='50%'>De...</th>
           <th width='50%'>Vers</th>
       </tr>
       <tr>
           <td class='odd'>te</td>
           <td class='odd'>me</td>
       </tr>
       <tr>
           <td class='odd'>je</td>
           <td class='odd'>vous</td>
       </tr>
       </table>
<p />

       <table class='outer' style='background-color:white;width:60%;'>
       <tr>
       <th colspan='2'>Correction</th>
       </tr>
       <tr>
           <th width='50%'>De...</th>
           <th width='50%'>Vers</th>
       </tr>
       <tr>
           <td class='odd'>vous t'avais</td>
           <td class='odd'>vous m'aviez</td>
       </tr>
       </table>
</div><br />
<b><u>Exemple</u> :</b>
    <ul class='help'>
    <li class='help'><b>User :</b> <u><b>Je vais</b></u> <u><b>te</b></u> reprendre la carte de crédit que <u><b>je t'avais</b></u> donné !</li>
    <li class='help'><b>User :</b> Sache bien que <u><b>je vais</b></u> <u><b>te</b></u> reprendre la carte de crédit que <u><b>je t'avais</b></u> donné !</li>
                             1. Le bot reconnaît l'expression,
                             et va chercher l'une des réponses de la colonne 'Réponses'.<br />
                             2. Convertis les pronoms personnels et autres expressions :<br />
                             &nbsp;&nbsp;&nbsp;&nbsp;'te' - 'me' et 'je t'avais' - 'vous m'aviez'.
    <li class='help'><b>Bot :</b> Pourquoi voulez-vous <u>me rependre la carte de crédit que vous m'aviez donné </u> ?</li>
    </ul>
");

define("_MD_CHATBOT_HOWTO_ELIZA_03",	"
<b><u>Astuces</u> :</b>
        <ul class='help'>
        <li class='help'>Utilisez expressions les plus simples possibles.<br />
                         Exemple : <i>Veux-tu</i> au lieu de <i>Veux-tu que</i></li>
        <li class='help'>Prévoyez les formes singulières et plurièles dans les expressions.<br />
                         Exemple : <i>Veux-tu</i> et <i>Voulez-vous</i></li>
   </ul>
");

// Topics
define("_MD_CHATBOT_HOWTO_TOPICS",	"
<style type='text/css'>
.help ul { text-align: left; padding-left:50px; }
.help li { padding:5px; margin:5px;  list-style-type: disc;}
.exemple ul { }
.exemple li { margin:5px; list-style-type: disc; color:red;}
</style><br />
<b>Les sujets de conversation représentent les thèmes de discussion des bots.
Ces informations permettent de guider les utilisateurs dans les thèmes de discussion,
mais aussi d'affecter tel ou tel thème en fonction des bots. </b>
<p />
<b><u>Status</u> :</b><p />
        <img src='../images/icon/online.gif' align='absmiddle' />
        <b>Actif :</b> Sujet de conversation actif,
        affiché dans la liste des sujets disponibles.<br />
        <img src='../images/icon/hidden.gif' align='absmiddle' />
        <b>Masqué :</b> Sujet de conversation actif,
        mais invisible dans la liste des sujets disponibles.<br />
        <img src='../images/icon/offline.gif' align='absmiddle' />
        <b>Inactif :</b> Sujet de conversation inactif.
<p />
<b><u>Page liée</u> :</b><p />
        URL de la ou les pages sur lequel le sujet de conversation est actif
        <u>quelque-soit le bot</u>.<p />
        <u>Exemples</u> :<ul>
        <li class='exemple'><b>modules/news/</b> : Sujet employé par le bot sur l'ensemble du module 'news'</li>
        <li class='exemple'><b>modules/news/article.php?id=1</b> : Sujet employé par le bot sur cette page précise</li>
        <li class='exemple'><b>register.php</b> : Sujet employé par le bot sur la page d'enregistrement de Xoops.</li>
   </ul>
   <font color='red'>Attention : Utiliser des urls relatives uniquement.</font> <p />

<b><u>Sujet de conversation</u> :</b>
   <ul class='help'>
        <li class='help'>Nom du sujet.</li>
   </ul>

<b><u>Description</u> :</b>
   <ul class='help'>
        <li class='help'>Description du sujet.
        Indiquez ici les principaux mots clés qui permettront aux utilisateurs de débuter la conversation.</li>
   </ul>
");

// Bots
define("_MD_CHATBOT_HOWTO_BOTS",	"
<style type='text/css'>
.help ul { text-align: left; padding-left:50px; }
.help li { padding:5px; margin:5px;  list-style-type: disc;}
</style><br />
<b>Les bots permettent de donner une personnalité spécifiue à l'interlocuteur.
Ils permettent aussi de délimiter les thèmes abordés, 
en fonction des sujets de discussion sélectionné par le bot.</b><br />
* Infos obligatoires.
<p />
<b><u>Nom du bot</u>* :</b><p />
<b><u>Description</u> :</b>
   <ul class='help'>
        <li class='help'>Description du bot.
        Indiquez ici le type de conversation possible avec le bot.</li>
   </ul>

<b><u>Avatar</u> :</b>
   <ul class='help'>
        <li class='help'>Image représentative du bot.<br />
        <font color='red'>Attention : Le type de fichier utilisé par l'avatar détermine aussi
        le type de fichier utilisé pour les emoticones/illustrations.</font></li>
   </ul>

<b><u>Répertoire de stockage</u> :</b>
   <ul class='help'>
        <li class='help'>Répertoire où sont stockées toutes les fichiers utilisés par le bot : 
        images, medias (sons), fichiers .js contenant les données relatives aux discussions.<br />
        <font color='red'>Attention : Le répertoire doit être ouvert en écriture !</font></li>
   </ul>

<b><u>Illustrations</u> :</b><br />
      Liste des fichiers utilisés pour l'illustration visuelle et sonore de la page du bot,
      ainsi que les adresses mails pour la notification sur les rapports de conversation :
   <ul>
        <li>Image de fond de page</li>
        <li>Image de fond de la boîte de dialogue</li>
        <li>Fichier son d'ambiance</li>
        <li>Son pour chaque frappe pour le mode 'machine à écrire'</li>
        <li>Mails pour les rapports de conversation. Ex: [mail1@monsite.com mail2@monsite.com] - plusieurs mail possibles séparées par un espace.</li>
   </ul>
   <font color='red'>Attention : Les fichiers doivent être présents dans le répertoire de stockage du bot !<br />
   Séparer chaque chaque élément par un '|'.</font> <p />

<b><u>Couleurs</u> :</b><br />
      Liste des couleurs utilisées pour l'illustration visuelle de la page du bot :
   <ul>
        <li>Texte de la page. Ex: [black|#000]</li>
        <li>Fond de page
        <br />Ex:
        [white|#FFF]
        [no-repeat|repeat-x|repeat-y]
        [left|center|right|<i>xx</i>%|<i>xx</i>px]
        [top|middle|bottom|x%|<i>x</i>px] (white no-repeat top right)</li>
        <li>Texte boîte de dialogue. Ex: [black|#000]</li>
        <li>Fond de boîte de dialogue. Ex: [white|#FFF]</li>
        <li>Taille de la bordure, en pixels. Ex: [<i>xx</i>px]</li>
   </ul>
   <font color='red'>Attention : Séparer chaque chaque élément par un '|'.</font> <p />

<b><u>Phrases d'accueil</u> :</b>
   <ul class='help'>
        <li class='help'>Phrases d'accueil choisies de façon aléatoires et qui s'affichent dans la boîte de dialogue du bot.</li>
        <li class='help'>Possibilité d'utiliser le tag {USERNAME} pour insérer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : Séparer chaque chaque élément par un '|'.</font><p />

<b><u>Expressions personnalisées</u> :</b>
   <ul class='help'>
        <li class='help'>Expressions qui s'ajoutent à une réponse de redirection,
        utilisées uniquement lorsque le bot ne sait pas quoi répondre à une question.</li>
   </ul>
        <font color='red'>Attention : Séparer chaque chaque élément par un '|'.</font><p />

<b><u>Phrases d'incompréhension</u> :</b>
   <ul class='help'>
        <li class='help'>Expressions d'incompréhension choisies de façon aléatoires
        lorsque que l'utilisateur n'entre pas de question dans la boîte de dialogue.</li>
        <li class='help'>Possibilité d'utiliser le tag {USERNAME} pour insérer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : Séparer chaque chaque élément par un '|'.</font><p />

<b><u>Phrase de conclusion</u> :</b>
   <ul class='help'>
        <li class='help'>Phrases de conclusion choisies de façon aléatoires
        lorsque que le robot a fait le tour de toutes les réponses possibles et qu'il n'a plus rien à dire.</li>
        <li class='help'>Possibilité d'utiliser le tag {USERNAME} pour insérer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : Séparer chaque chaque élément par un '|'.</font><p />

<b><u>Sujets de conversation</u> :</b>
   <ul class='help'>
        <li class='help'>Liste des sujets de conversation disponibles.</li>
        <li class='help'>Le sujet '[ELIZA]Eliza Chat' reprend le mode Q/R Eliza.
        Il peut donc être activé ou désactivé pour le bot en cours.</li>
   </ul>
        <font color='red'>Attention : Séléction multiple. CTRL-Click pour  sélectionner plusieurs sujets de conversation.</font><p />


");

?>