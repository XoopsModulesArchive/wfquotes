<?php
/*
* $Id: admin.php,v 1.1 2006/03/27 14:52:06 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//Main Admin Section

define('_AM_FAQMANINTRO', 'Bienvenido a la mesa de control de Quotes');

/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Crear');
define('_AM_YES', 'Sí');
define('_AM_NO', 'No');
define('_AM_DELETE', 'Borrar');
define('_AM_MODIFY', 'Modificar');
define('_AM_UPDATED', '¡La base de datos se actualizó correctamente!');
define('_AM_NOTUPDATED', '¡Hubo un error al actualizar la base de datos!');
define('_AM_CATCREATED', '¡La nueva categoría fue creada y salvada!');
define('_AM_CATMODIFY', '¡La categoría fue modificada y salvada!');
/*
* Lang defines for functions.php
*/
define('_AM_QUOTEADMINHEAD', 'Manejo de citas');
define('_AM_QUOTEADMINCATH', 'Manejo de categorías de citas');
define('_AM_QUOTENEWCAT', 'Índice de categorías de las citas');
define('_AM_QUOTENEWCATTXT', 'Crear, editar o borrar una categoría de citas. O volver al Índice de categorías de citas.');
define('_AM_QUOTENEWQUOTE', 'Índice de citas');
define('_AM_QUOTENEWQUOTETXT', 'Crear, editar o borrar una cita. O volver al Índice de citas.');
define('_AM_QUOTEVALIDATE', 'Autorizar nuevos envíos');
define('_AM_QUOTEVALTXT', 'Te permite borrar o autorizar las nuevas citas enviadas.');
/*
* Lang defines for Category.php
*/
define('_AM_QUOTERECOUNT', 'Contar otra vez las citas');
define('_AM_QUOTERECOUNTTXT', 'Te permite recontar el número de citas en cada categoría.');
define('_AM_CREATIN', 'Crear en');
define('_AM_CATNAME', 'Nombre de categoría');
define('_AM_CATDESCRIPT', 'Descripción de categoría');
define('_AM_NOCATTOEDIT', 'No hay categoría qué editar.');
define('_AM_MODIFYCAT', 'Modificar categoría');
define('_AM_DELCAT', 'Borrar categoría');
define('_AM_ADDCAT', 'Agregar categoría');
define('_AM_MODIFYTHISCAT', '¿Modificar esta categoría?');
define('_AM_DELETETHISCAT', '¿Borrar esta categoría?');
define('_AM_CATISDELETED', 'La categoría %s ha sido borrada');

/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Manejo de citas');
define('_AM_NOTCTREATEDACAT', '¡No puedes agregar una cita si no creas antes una categoría de citas!');
define('_AM_ADDQUOTE', 'Crear nueva cita');
define('_AM_GROUPPROMPT', 'Permitir acceso a:'); //updated 14/07/03
define('_AM_TOPICW', 'Peso:'); //updated 14/07/03
define('_AM_CREATEIN', 'Crear en');
define('_AM_QUOTETITLE', 'Cita:');
define('_AM_QUOTEBODY', 'Autor:');
define('_AM_SUMMARY', 'Referencia:');
define('_AM_MODIFYQUOTE', 'Editar cita');
define('_AM_MODIFYEXSITQUOTE', 'Editar cita');
define('_AM_MODIFYTHISQUOTE', 'Editar este cita');
define('_AM_DELQUOTE', 'Borrar cita');
define('_AM_DELTHISQUOTE', 'Borrar esta cita');
define('_AM_NOQUOTETOEDIT', 'No hay citas qué editar en la base de datos');
define('_AM_DELETETHISQUOTE', '¿Borrar esta cita?');
define('_AM_QUOTEISDELETED', 'La cita %s ha sido borrada');
define('_AM_QUOTECREATED', 'La cita fue creada y salvada correctamente');
define('_AM_QUOTENOTCREATED', 'ERROR: La cita NO se creó ni salvó');
define('_AM_QUOTEMODIFY', 'La cita fue modificada y salvada');
define('_AM_QUOTENOTMODIFY', 'ERROR: La cita NO se editó ni salvó');

define('_AM_SUBALLOW', 'Permitir');
define('_AM_SUBDELETE', 'Borrar');
define('_AM_SUBRETURN', 'Volver a mesa de control');
define('_AM_SUBRETURNTO', 'Volver a nuevos envíos');
define('_AM_AUTHOR', 'Autor');
define('_AM_PUBLISHED', 'Publicación');
define('_AM_SUBPREVIEW', 'La vista de control de Citas');
define('_AM_SUBADMINPREV', 'Esta es la vista previa de control de esta cita.');
define('_AM_DBUPDATED', 'La base de datos que contiene las citas ha sido actualizada');
define('_AM_NOFAQFOESUB', 'No hay cirtas nuevas qué actualizar'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'Envíos recientes'); //Updated 14/07/03

define('_AM_VISIBLE', 'Visible');
define('_DISABLEXCODES', 'Deshabilitar Xoops Codes');
/*
*  Copyright and Support.  Please do not remove this line as this is part of the only copyright agreement for using WF-FAQ
*/
define('_AM_VISITSUPPORT', 'Visita el sitio web de WF-Section para información, actualización y ayuda sobre su uso.<br> WF-Quote v1 Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Quotes</a>');
