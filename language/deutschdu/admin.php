<?php
/*
* $Id: xoops_version.php v 1.0 15 July 2005 Catwolf Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//Main Admin Section
define('_AM_QUOTEINTRO', 'Willkommen zur WF-Quote-Administration');
/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Erstellen');
define('_AM_YES', 'Ja');
define('_AM_NO', 'Nein');
define('_AM_DELETE', 'L&ouml;schen');
define('_AM_MODIFY', '&Auml;ndern');
define('_AM_UPDATED', 'Die Datenbank wurde erfolgreich aktualisiert');
define('_AM_NOTUPDATED', 'Es ist ein Fehler bei der Aktualisierung der Datenbank aufgetreten!');
define('_AM_CATCREATED', 'Neue Kategorie wurde erstellt und gesichert!');
define('_AM_CATMODIFY', 'Kategorie wurde ge&auml;ndert und gesichert!');
/*
* Lang defines for functions.php
*/
define('_AM_QUOTEADMINHEAD', 'Zitatmanagement');
define('_AM_QUOTEADMINCATH', 'Zitatkategoriemanagement');
define('_AM_QUOTENEWCAT', 'Zitatkategorie &Uuml;bersicht');
define('_AM_QUOTENEWCATTXT', 'Erstellen/&Auml;ndern oder L&ouml;schen einer Zitatkategorie oder R&uuml;ckkehr zur Zitatkategorie &Uuml;bersicht.');
define('_AM_QUOTENEWQUOTE', 'Zitat&uuml;bersicht');
define('_AM_QUOTENEWQUOTETXT', 'Erstellen/&Auml;ndern oder L&ouml;schen eines Zitats oder R&uuml;ckkehr zur Zitathaupt&uuml;bersicht.');
define('_AM_QUOTEVALIDATE', 'Neue Einsendungen &uuml;berpr&uuml;fen');
define('_AM_QUOTEVALTXT', 'Erlaubt dir neu eingeschickte Zitate zu l&ouml;schen oder zu &uuml;berpr&uuml;fen.');
/*
* Lang defines for Category.php
*/
define('_AM_QUOTERECOUNT', 'Zitate neu z&auml;hlen');
define('_AM_QUOTERECOUNTTXT', 'Erlaubt dir die Anzahl der Zitate in jeder Kategorie neu zu z&auml;hlen.');
define('_AM_CREATIN', 'Erstellen in');
define('_AM_CATNAME', 'Kategoriename');
define('_AM_CATDESCRIPT', 'Kategoriebeschreibung');
define('_AM_NOCATTOEDIT', 'Es liegt keine Kategorie zum &Auml;ndern vor.');
define('_AM_MODIFYCAT', 'Kategorie &auml;ndern');
define('_AM_DELCAT', 'Kategorie l&ouml;schen');
define('_AM_ADDCAT', 'Kategorie hinzuf&uuml;gen');
define('_AM_MODIFYTHISCAT', 'Diese Kategorie &auml;ndern?');
define('_AM_DELETETHISCAT', 'Diese Kategorie l&ouml;schen?');
define('_AM_CATISDELETED', 'Kategorie %s wurde gel&ouml;scht');
/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'WF-Quotes Administration');
define('_AM_NOTCTREATEDACAT', 'Du musst erst eine Kategorie erstellen, bevor du Zitate hinzuf&uuml;gst!');
define('_AM_ADDQUOTE', 'Neues Zitat erstellen');
define('_AM_GROUPPROMPT', 'Zugriff erlauben:'); //updated 14/07/03
define('_AM_TOPICW', 'Position:'); //updated 14/07/03
define('_AM_CREATEIN', 'Erstellen in');
define('_AM_QUOTETITLE', 'Zitat');
define('_AM_QUOTEBODY', 'Autor');
define('_AM_SUMMARY', 'Quelle');
define('_AM_MODIFYQUOTE', 'Zitat &auml;ndern');
define('_AM_MODIFYEXSITQUOTE', 'Zitat &auml;ndern');
define('_AM_MODIFYTHISQUOTE', 'Diese Zitat &auml;ndern');
define('_AM_DELQUOTE', 'Zitat l&ouml;schen');
define('_AM_DELTHISQUOTE', 'Dieses Zitat l&ouml;schen');
define('_AM_NOQUOTETOEDIT', 'Es liegen in der Datenbank keine Zitate vor die ge&auml;ndert werden k&ouml;nnen');
define('_AM_DELETETHISQUOTE', 'Dieses Zitat l&ouml;schen?');
define('_AM_QUOTEISDELETED', 'Zitat %s wurde gel&ouml;scht');
define('_AM_QUOTECREATED', 'Zitat wurde erstellt und gesichert');
define('_AM_QUOTENOTCREATED', 'FEHLER: Zitat wurde NICHT erstellt und gesichert');
define('_AM_QUOTEMODIFY', 'Zitat wurde ge&auml;ndert und gesichert');
define('_AM_QUOTENOTMODIFY', 'FEHLER: Zitat wurde NICHT ge&auml;ndert und gesichert');
define('_AM_SUBALLOW', 'Erlauben');
define('_AM_SUBDELETE', 'L&ouml;schen');
define('_AM_SUBRETURN', 'Zur&uuml;ck zur Administration');
define('_AM_SUBRETURNTO', 'Zur&uuml;ck zu neuen Einsendungen');
define('_AM_AUTHOR', 'Autor');
define('_AM_PUBLISHED', 'Ver&ouml;ffentlicht');
define('_AM_SUBPREVIEW', 'Die WF-Quotes Adminansicht');
define('_AM_SUBADMINPREV', 'Dies ist die Adminvorschau dieses Zitats.');
define('_AM_DBUPDATED', 'Die Zitatdatenbank wurde aktualisiert');
define('_AM_NOFAQFOESUB', 'Es liegen keine neuen Zitate zur &Uuml;berpr&uuml;fung vor'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'Neue Einsendungen'); //Updated 14/07/03
/* hsalazar */
define('_AM_VISIBLE', 'Sichtbar');
define('_DISABLEXCODES', 'Xoops Codes deaktivieren');
/*
* Copyright and Support. Please do not remove this line as this is part of the only copyright agreement for using WF-Snippets
*/
define('_AM_VISITSUPPORT', 'Besuche die WF-Section Website f&uuml;r mehr Informationen/Updates oder Hilfen f&uuml;r die Benutzung.<br> WF-Quotes v1 Hsalazar/Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Quotes</a>');
