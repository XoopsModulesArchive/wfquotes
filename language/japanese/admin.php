<?php
/*
* $Id: admin.php,v 1.1 2006/03/27 14:52:04 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//Main Admin Section

define('_AM_QUOTEINTRO', 'Welcome to WF-Quote Control Panel');

/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Create');
define('_AM_YES', 'Yes');
define('_AM_NO', 'No');
define('_AM_DELETE', 'Delete');
define('_AM_MODIFY', 'Modify');
define('_AM_UPDATED', 'Database has been updated');
define('_AM_NOTUPDATED', 'There was an error updating the database!');
define('_AM_CATCREATED', 'New Category was created and saved!');
define('_AM_CATMODIFY', 'Category was modified and saved!');
/*
* Lang defines for functions.php
*/
define('_AM_QUOTEADMINHEAD', 'Quotes management');
define('_AM_QUOTEADMINCATH', 'Quotes category management');
define('_AM_QUOTENEWCAT', 'Quotes Category Index');
define('_AM_QUOTENEWCATTXT', 'Create, modify or delete a quotes\' category. Or return to main quotes category index.');
define('_AM_QUOTENEWQUOTE', 'Quotes index');
define('_AM_QUOTENEWQUOTETXT', 'Create, modify or delete a quote. Or return to main quotes index.');
define('_AM_QUOTEVALIDATE', 'Validate new submissions');
define('_AM_QUOTEVALTXT', 'Allows you to delete or validate new quotes submitted.');
/*
* Lang defines for Category.php
*/
define('_AM_QUOTERECOUNT', 'Recount quotes');
define('_AM_QUOTERECOUNTTXT', 'Allows you to recount the number of quotes in each category.');
define('_AM_CREATIN', 'Create in');
define('_AM_CATNAME', 'Category name');
define('_AM_CATDESCRIPT', 'Category description');
define('_AM_NOCATTOEDIT', 'There is no category to edit.');
define('_AM_MODIFYCAT', 'Modify category');
define('_AM_DELCAT', 'Delete category');
define('_AM_ADDCAT', 'Add category');
define('_AM_MODIFYTHISCAT', 'Modify this category?');
define('_AM_DELETETHISCAT', 'Delete this category?');
define('_AM_CATISDELETED', 'Category %s has been deleted');

/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Quotes Admin');
define('_AM_NOTCTREATEDACAT', 'You cannot add a quote until you create a quote category!');
define('_AM_ADDQUOTE', 'Create new quote');
define('_AM_GROUPPROMPT', 'Allow access to:'); //updated 14/07/03
define('_AM_TOPICW', 'Weight:'); //updated 14/07/03
define('_AM_CREATEIN', 'Create in');
define('_AM_QUOTETITLE', 'Quote');
define('_AM_QUOTEBODY', 'Author');
define('_AM_SUMMARY', 'Reference');
define('_AM_MODIFYQUOTE', 'Modify quote');
define('_AM_MODIFYEXSITQUOTE', 'Modify quote');
define('_AM_MODIFYTHISQUOTE', 'Modify this quote');
define('_AM_DELQUOTE', 'Delete quote');
define('_AM_DELTHISQUOTE', 'Delete this quote');
define('_AM_NOQUOTETOEDIT', 'No quote in database to modify');
define('_AM_DELETETHISQUOTE', 'Delete this quote?');
define('_AM_QUOTEISDELETED', 'Quote %s has been deleted');
define('_AM_QUOTECREATED', 'Quote was created and saved');
define('_AM_QUOTENOTCREATED', 'ERROR: Quote was NOT created and saved');
define('_AM_QUOTEMODIFY', 'Quote was modified and saved');
define('_AM_QUOTENOTMODIFY', 'ERROR: Quote was NOT modified and saved');

define('_AM_SUBALLOW', 'Allow');
define('_AM_SUBDELETE', 'Delete');
define('_AM_SUBRETURN', 'Return to Admin');
define('_AM_SUBRETURNTO', 'Return to new submissions');
define('_AM_AUTHOR', 'Author');
define('_AM_PUBLISHED', 'Published');
define('_AM_SUBPREVIEW', 'The Quotes Admin view');
define('_AM_SUBADMINPREV', 'This is the admin preview of this quote.');
define('_AM_DBUPDATED', 'Quotes database has been updated');
define('_AM_NOFAQFOESUB', 'There are no new quotes for validation'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'New submissions'); //Updated 14/07/03

/* hsalazar */
define('_AM_VISIBLE', 'Visible');
define('_DISABLEXCODES', 'Disable Xoops Codes');
/*
*  Copyright and Support.  Please do not remove this line as this is part of the only copyright agreement for using WF-Snippets
*/
define('_AM_VISITSUPPORT', 'Visit the WF-Section website for information, updates and help on its usage.<br> WF-Quotes v1 Hsalazar/Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Quotes</a>');
