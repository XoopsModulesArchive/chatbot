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

<p style='font-weight:bold;'>Bas� sur un syst�me de calcul de points en fonction des occurences de mots cl�s. Le script renvoie la r�ponse la r�ponse la plus pertinente en fonction des questions pos�es, et ne r�pond pas deux fois la m�me chose.</p>
<br />

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Mode d'emploi</div>
<ul class='help'>
    <li class='help'> <b>Sujet de conversation :</b> <br />Choisir un sujet de discussion auquel la question/r�ponse sera affect�e.</li>
    <li class='help'> <b>Obligatoire :</b> <br />Liste des mots cl�s obligatoires pour activer la r�ponse. 
    Un seul terme correpondant activera la r�ponse.</li>
    <li class='help'> <b>Facultatif :</b> <br />Liste des mots cl�s facultatifs pour induire une r�ponse. 
    Un terme correspondant favorisera la r�ponse.</li>
    <li class='help'> <b>Contextuel :</b> <br />Liste des mots cl�s pour lier des r�ponses entre-elles.
    Si aucun mot cl� obligatoire n'est d�tect� dans la r�ponse, il poursuit la conversation sur un th�me �quivalent.</li>
    <li class='help'> <b>R�ponses :</b> <br />R�ponses fournies obligatoirement si l'un des mots cl�s est activ�. 
    A employer avec mots cl�s uniquement.</li>
    <li class='help'> <b>Discussion :</b> <br />R�ponses fournies � une question pr�cise, 
    ou si aucun terme n'est d�tect� afin de relancer la discussion sur un autre sujet.<br />Peut s'employer avec ou sans mots cl�s.</li>
</ul>
<font color='red'><u><b>Comment 'Activer une redirection' ?</b></u><p />
Valable uniquement pour les 'r�ponses' et 'discussions'.<br />
Ins�rer un lien dans une r�ponse (avec ouverture automatique ou non - param�trable dans les pr�f�rences du module),
�crire le lien en url absolue ou relative entre {}.<p />
<u>Exemple</u> :<ul class='exemple'>
<li class='exemple'>{modules/news/}</li>
<li class='help'>{modules/chatbot/bot.php?id=1} </li>
<li class='exemple'>{www.wolfpackclan.com} </li>
<li class='exemple'>{http://wolfactory.wolfpackclan.com}</li></ul></font>
");


define("_MD_CHATBOT_HOWTO_CONTENT_02",	"
<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Exemple de configuration</div>
<ul class='help'>
    <li class='help'>Pour cr�er une conversation et assurer un suivi, il faut concevoir les r�ponses en entonnoir.</li>
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
           <th width='35%'>R�ponse</th>
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
                             - Le bot ne conna�t pas ce mot cl�,<br />
                               il va donc chercher l'une des r�ponses de la colonne discussion.
    <li class='help'><b>Bot :</b> Voulez-vous une explications sur les modules ou sur les blocs ?</li>
    <li class='help'><b>User :</b> Je veux tout savoir sur les <u>blocs</u>.</li>
                             - Le bot reconna�t le mot cl� : 'blocs',<br />
                               il va donc chercher l'une des r�ponses de la colonne obligatoire.
    <li class='help'><b>Bot :</b> Voici une explication sur les blocs. Voulez-vous savoir autre chose ?</li>
    <li class='help'><b>User :</b> Oui, je veux que l'on parle d'autre chose.</li>
                             - Le bot ne reconna�t aucun mot cl�,<br /> 
                               mais puisque que l'un des mots cl� employ� dans la r�ponse pr�c�dente (XOOPS) est aussi pr�sent dans la colonne contextuelle,<br />
                               il va chercher l'une des r�ponses de la colonne r�ponse correspondant au terme contextuel (XOOPS).
    <li class='help'><b>Bot :</b> Voici une explication sur les modules.</li>
    </ul>
");

define("_MD_CHATBOT_HOWTO_CONTENT_03",	"
<b><u>Astuces</u> :</b>
        <ul class='help'>
        <li class='help'>Evitez les r�ponses/questions ferm�es (r�ponses 'oui' ou 'non')<br />
                         Exemple : Evitez <i>'Connaissez-vous Xoops ?'</i> Pr�f�rez : <i>'Que souhaitez vous savoir au sujet de Xoops?</i></li>
        <li class='help'>Pour diriger la conversation, faites des r�ponses contenant des propositions.<br />
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
Ces questions-r�ponses se basent sur la m�thode 'Eliza',
c'est � dire qu'elles renvoient � l'utilisateur des r�ponses bas�es
ou incluant les expressions cl�s rep�r�es dans la question de l'utilisateur.
Ce script fonctionne sur base d'un syst�me de masque 
et peut �tre employ� pour �luder les questions trop personnelles.</p>
<br />

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Donn�es</div><br />
Liste des expressions � convertir.
<ul class='help'>
    <li class='help'> <b>Mots cl�s :</b> <br />Liste des masques � appliquer aux questions de l'utilisateur.<br />
                         Exemple : <i>Je vais vous</i></li>
    <li class='help'> <b>R�ponses :</b> <br />Liste des r�ponses potentielles, choisies de fa�on al�atoire. 
                         Utilisez (*) suivi du signe de ponctuation ad�quat,
                         pour afficher les termes repris dans le masque de la question.<br />
                         Exemple : <i>Pourquoi voulez-vous me(*)?</i></li>
</ul>

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Conversion</div>
<ul class='help'>
    <li class='help'> <b>De... :</b> <br />Liste des termes � convertir des questions de l'utilisateur.<br />
                         Exemple : <i>te</i></li>
    <li class='help'> <b>Vers... :</b> <br />Liste des termes convertis.<br />
                         Exemple : <i>me</i></li>
</ul>

<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Correction</div>
<ul class='help'>
    <li class='help'> <b>De... :</b> <br />Liste expressions � convertir apr�s correction des r�ponses.<br />
                         Exemple : <i>je t'ai</i></li>
    <li class='help'> <b>Vers... :</b> <br />Terme corrig�.<br />
                         Exemple : <i>tu m'as</i></li>
</ul>
");


define("_MD_CHATBOT_HOWTO_ELIZA_02",	"
<div style='font-weight:bold;text-decoration:underline;padding:5px;'>Exemple de configuration</div>
<ul class='help'>
    <li class='help'>Pour cr�er une r�ponse sens�e, il faut pr�voir tous les cas de figure.</li>
</ul>
<div align='center'>
       <table class='outer' style='background-color:white;width:60%;'>
       <tr>
       <th colspan='2'>Donn�es</th>
       </tr>
                      
       <tr>
           <th width='50%'>Expression</th>
           <th width='50%'>R�ponses</th>
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
    <li class='help'><b>User :</b> <u><b>Je vais</b></u> <u><b>te</b></u> reprendre la carte de cr�dit que <u><b>je t'avais</b></u> donn� !</li>
    <li class='help'><b>User :</b> Sache bien que <u><b>je vais</b></u> <u><b>te</b></u> reprendre la carte de cr�dit que <u><b>je t'avais</b></u> donn� !</li>
                             1. Le bot reconna�t l'expression,
                             et va chercher l'une des r�ponses de la colonne 'R�ponses'.<br />
                             2. Convertis les pronoms personnels et autres expressions :<br />
                             &nbsp;&nbsp;&nbsp;&nbsp;'te' - 'me' et 'je t'avais' - 'vous m'aviez'.
    <li class='help'><b>Bot :</b> Pourquoi voulez-vous <u>me rependre la carte de cr�dit que vous m'aviez donn� </u> ?</li>
    </ul>
");

define("_MD_CHATBOT_HOWTO_ELIZA_03",	"
<b><u>Astuces</u> :</b>
        <ul class='help'>
        <li class='help'>Utilisez expressions les plus simples possibles.<br />
                         Exemple : <i>Veux-tu</i> au lieu de <i>Veux-tu que</i></li>
        <li class='help'>Pr�voyez les formes singuli�res et pluri�les dans les expressions.<br />
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
<b>Les sujets de conversation repr�sentent les th�mes de discussion des bots.
Ces informations permettent de guider les utilisateurs dans les th�mes de discussion,
mais aussi d'affecter tel ou tel th�me en fonction des bots. </b>
<p />
<b><u>Status</u> :</b><p />
        <img src='../images/icon/online.gif' align='absmiddle' />
        <b>Actif :</b> Sujet de conversation actif,
        affich� dans la liste des sujets disponibles.<br />
        <img src='../images/icon/hidden.gif' align='absmiddle' />
        <b>Masqu� :</b> Sujet de conversation actif,
        mais invisible dans la liste des sujets disponibles.<br />
        <img src='../images/icon/offline.gif' align='absmiddle' />
        <b>Inactif :</b> Sujet de conversation inactif.
<p />
<b><u>Page li�e</u> :</b><p />
        URL de la ou les pages sur lequel le sujet de conversation est actif
        <u>quelque-soit le bot</u>.<p />
        <u>Exemples</u> :<ul>
        <li class='exemple'><b>modules/news/</b> : Sujet employ� par le bot sur l'ensemble du module 'news'</li>
        <li class='exemple'><b>modules/news/article.php?id=1</b> : Sujet employ� par le bot sur cette page pr�cise</li>
        <li class='exemple'><b>register.php</b> : Sujet employ� par le bot sur la page d'enregistrement de Xoops.</li>
   </ul>
   <font color='red'>Attention : Utiliser des urls relatives uniquement.</font> <p />

<b><u>Sujet de conversation</u> :</b>
   <ul class='help'>
        <li class='help'>Nom du sujet.</li>
   </ul>

<b><u>Description</u> :</b>
   <ul class='help'>
        <li class='help'>Description du sujet.
        Indiquez ici les principaux mots cl�s qui permettront aux utilisateurs de d�buter la conversation.</li>
   </ul>
");

// Bots
define("_MD_CHATBOT_HOWTO_BOTS",	"
<style type='text/css'>
.help ul { text-align: left; padding-left:50px; }
.help li { padding:5px; margin:5px;  list-style-type: disc;}
</style><br />
<b>Les bots permettent de donner une personnalit� sp�cifiue � l'interlocuteur.
Ils permettent aussi de d�limiter les th�mes abord�s, 
en fonction des sujets de discussion s�lectionn� par le bot.</b><br />
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
        <li class='help'>Image repr�sentative du bot.<br />
        <font color='red'>Attention : Le type de fichier utilis� par l'avatar d�termine aussi
        le type de fichier utilis� pour les emoticones/illustrations.</font></li>
   </ul>

<b><u>R�pertoire de stockage</u> :</b>
   <ul class='help'>
        <li class='help'>R�pertoire o� sont stock�es toutes les fichiers utilis�s par le bot : 
        images, medias (sons), fichiers .js contenant les donn�es relatives aux discussions.<br />
        <font color='red'>Attention : Le r�pertoire doit �tre ouvert en �criture !</font></li>
   </ul>

<b><u>Illustrations</u> :</b><br />
      Liste des fichiers utilis�s pour l'illustration visuelle et sonore de la page du bot,
      ainsi que les adresses mails pour la notification sur les rapports de conversation :
   <ul>
        <li>Image de fond de page</li>
        <li>Image de fond de la bo�te de dialogue</li>
        <li>Fichier son d'ambiance</li>
        <li>Son pour chaque frappe pour le mode 'machine � �crire'</li>
        <li>Mails pour les rapports de conversation. Ex: [mail1@monsite.com mail2@monsite.com] - plusieurs mail possibles s�par�es par un espace.</li>
   </ul>
   <font color='red'>Attention : Les fichiers doivent �tre pr�sents dans le r�pertoire de stockage du bot !<br />
   S�parer chaque chaque �l�ment par un '|'.</font> <p />

<b><u>Couleurs</u> :</b><br />
      Liste des couleurs utilis�es pour l'illustration visuelle de la page du bot :
   <ul>
        <li>Texte de la page. Ex: [black|#000]</li>
        <li>Fond de page
        <br />Ex:
        [white|#FFF]
        [no-repeat|repeat-x|repeat-y]
        [left|center|right|<i>xx</i>%|<i>xx</i>px]
        [top|middle|bottom|x%|<i>x</i>px] (white no-repeat top right)</li>
        <li>Texte bo�te de dialogue. Ex: [black|#000]</li>
        <li>Fond de bo�te de dialogue. Ex: [white|#FFF]</li>
        <li>Taille de la bordure, en pixels. Ex: [<i>xx</i>px]</li>
   </ul>
   <font color='red'>Attention : S�parer chaque chaque �l�ment par un '|'.</font> <p />

<b><u>Phrases d'accueil</u> :</b>
   <ul class='help'>
        <li class='help'>Phrases d'accueil choisies de fa�on al�atoires et qui s'affichent dans la bo�te de dialogue du bot.</li>
        <li class='help'>Possibilit� d'utiliser le tag {USERNAME} pour ins�rer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : S�parer chaque chaque �l�ment par un '|'.</font><p />

<b><u>Expressions personnalis�es</u> :</b>
   <ul class='help'>
        <li class='help'>Expressions qui s'ajoutent � une r�ponse de redirection,
        utilis�es uniquement lorsque le bot ne sait pas quoi r�pondre � une question.</li>
   </ul>
        <font color='red'>Attention : S�parer chaque chaque �l�ment par un '|'.</font><p />

<b><u>Phrases d'incompr�hension</u> :</b>
   <ul class='help'>
        <li class='help'>Expressions d'incompr�hension choisies de fa�on al�atoires
        lorsque que l'utilisateur n'entre pas de question dans la bo�te de dialogue.</li>
        <li class='help'>Possibilit� d'utiliser le tag {USERNAME} pour ins�rer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : S�parer chaque chaque �l�ment par un '|'.</font><p />

<b><u>Phrase de conclusion</u> :</b>
   <ul class='help'>
        <li class='help'>Phrases de conclusion choisies de fa�on al�atoires
        lorsque que le robot a fait le tour de toutes les r�ponses possibles et qu'il n'a plus rien � dire.</li>
        <li class='help'>Possibilit� d'utiliser le tag {USERNAME} pour ins�rer le nom de l'utilisateur.</li>
   </ul>
        <font color='red'>Attention : S�parer chaque chaque �l�ment par un '|'.</font><p />

<b><u>Sujets de conversation</u> :</b>
   <ul class='help'>
        <li class='help'>Liste des sujets de conversation disponibles.</li>
        <li class='help'>Le sujet '[ELIZA]Eliza Chat' reprend le mode Q/R Eliza.
        Il peut donc �tre activ� ou d�sactiv� pour le bot en cours.</li>
   </ul>
        <font color='red'>Attention : S�l�ction multiple. CTRL-Click pour  s�lectionner plusieurs sujets de conversation.</font><p />


");

?>