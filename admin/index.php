<?php
/*
* $Id: index.php,v 1.1 2006/03/27 14:51:59 mikhail Exp $
* Module: Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include 'admin_header.php';

$myts = MyTextSanitizer::getInstance();

$op = '';

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

/**
 * Check to see if any categories have been created
 * if true continue script
 * if false warns user that no categories have been created.
 */
$result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('quotecats') . ' ORDER BY name');
if ('0' == $GLOBALS['xoopsDB']->getRowsNum($result)) {
    redirect_header('category.php', '1', _AM_NOTCTREATEDACAT);

    exit();
}

/*
* Function to edit and modify Topics
*/

function edittopic($quoteID = '')
{
    /*
    * Clear all variable before we start
    */

    $quotext = '';

    $author = '';

    $reference = '';

    $groupid = '';

    //		$weight = 1;

    $catid = 0;

    $oldid = 0;

    $visible = 0;

    $nohtml = 0;

    $nosmiley = 0;

    $noxcodes = 0;

    global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $nohtml, $nosmiley, $noxcodes, $visible;

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    /*
    * checks to see if we are modifying a quote
    */

    if ($modify) {
        /*
        * Get quote info from database
        */

        $result = $xoopsDB->query('SELECT quoteID, catID, quotext, author, reference, groupid, visible, nohtml, nosmiley, noxcodes FROM ' . $xoopsDB->prefix('quotes') . " WHERE quoteID = '$quoteID'");

        [$quoteID, $catID, $quotext, $author, $reference, $groupid, $visible, $nohtml, $nosmiley, $noxcodes] = $xoopsDB->fetchRow($result);

        $oldid = $catID;

        /*
        * If no quotes are found, tell user and exit
        */

        if (0 == $xoopsDB->getRowsNum($result)) {
            redirect_header('index.php', 1, _AM_NOQUOTETOEDIT);

            exit();
        }

        $sform = new XoopsThemeForm(_AM_MODIFYEXSITQUOTE, 'op', xoops_getenv('PHP_SELF'));
    } else {
        $sform = new XoopsThemeForm(_AM_ADDQUOTE, 'op', xoops_getenv('PHP_SELF'));
    }

    if ($modify) {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, getGroupIda($groupid), 5, true));
    } else {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, true, 5, true));
    }

    /*
    * Get information for pulldown menu using XoopsTree.
    * First var is the database table
    * Second var is the unique field ID for the categories
    * Last one is not set as we do not have sub menus in WF-FAQ
    */

    $mytree = new XoopsTree($xoopsDB->prefix('quotecats'), 'catid', '0');

    /*
    * Get the mytree pulldown object for use with XoopsForm class
    */

    ob_start();

    $sform->addElement(new XoopsFormHidden('catid', $catid));

    $mytree->makeMySelBox('name', $catid);

    $sform->addElement(new XoopsFormLabel(_AM_CREATEIN, ob_get_contents()));

    ob_end_clean();

    /*
    * Set the user textboxs using XoopsForm Class for user input
    */

    //		$sform->addElement(new XoopsFormText(_AM_TOPICW, 'weight', 4, 4, $weight));

    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_QUOTETITLE, 'quotext', $quotext, 15, 60), true);

    if (is_numeric($author)) {
        $authorinput = '';
    } else {
        $authorinput = $author;
    }

    $sform->addElement(new XoopsFormText(_AM_QUOTEBODY, 'authorinput', 50, 80, $authorinput));

    ob_start();

    getuserForm((int)$author);

    $sform->addElement(new XoopsFormLabel(_AM_AUTHOR, ob_get_contents()));

    ob_end_clean();

    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_SUMMARY, 'reference', $reference, 7, 60));

    /*

    /* Para que la cita pueda definirse como visible o no visible */

    $visible_checkbox = new XoopsFormCheckBox('' . _AM_VISIBLE . '', 'visible', $visible);

    $visible_checkbox->addOption(1, '' . _AM_YES . '');

    $sform->addElement($visible_checkbox);

    /* Para agregar las opciones respecto a formatación */

    $option_tray = new XoopsFormElementTray(_OPTIONS, '<br>');

    $nohtml_checkbox = new XoopsFormCheckBox('', 'nohtml', $nohtml);

    $nohtml_checkbox->addOption(1, _DISABLEHTML);

    $option_tray->addElement($nohtml_checkbox);

    $smiley_checkbox = new XoopsFormCheckBox('', 'nosmiley', $nosmiley);

    $smiley_checkbox->addOption(1, _DISABLESMILEY);

    $option_tray->addElement($smiley_checkbox);

    $xcodes_checkbox = new XoopsFormCheckBox('', 'noxcodes', $noxcodes);

    $xcodes_checkbox->addOption(1, _DISABLEXCODES);

    $option_tray->addElement($xcodes_checkbox);

    $sform->addElement($option_tray);

    /* XoopsFormHidden, pass on 'unseen' var's'
    */

    $sform->addElement(new XoopsFormHidden('quoteID', $quoteID));

    $sform->addElement(new XoopsFormHidden('modify', $modify));

    $sform->addElement(new XoopsFormHidden('oldid', $oldid));

    /*
    * XoopsForm Class Buttons
    */

    $button_tray = new XoopsFormElementTray('', '');

    $hidden = new XoopsFormHidden('op', 'save');

    $button_tray->addElement($hidden);

    /*
    * Switch to show different buttons for either when creating or modifying a FAQ.
    */

    if (!$modify) {
        $button_tray->addElement(new XoopsFormButton('', 'create', _AM_CREATE, 'submit'));
    } else {
        $button_tray->addElement(new XoopsFormButton('', 'update', _AM_MODIFY, 'submit'));
    }

    $sform->addElement($button_tray);

    $sform->display();

    unset($hidden);

    /*
   *End of XoopsForm
   */
}

/*
* end function
*/

switch ($op) {
    case 'edit':
        xoops_cp_header();
        $modify = 1;
        quotelinks();
        edittopic($quoteID);
        break;
    case 'mod':
        xoops_cp_header();
        $modify = 1;
        quotelinks();
        edittopic($_POST['quoteID']);
        break;
    case 'del':
        global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;

        if ($confirm) {
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('quotes') . " WHERE quoteID = $quoteID");

            redirect_header('index.php', 1, sprintf(_AM_QUOTEISDELETED, $quotext));

            exit();
        }  
            if (!$subm) {
                $quoteID = $_POST['quoteID'];
            } else {
                $quoteID = $t;
            }
            $result = $xoopsDB->query('SELECT catID, quotext FROM ' . $xoopsDB->prefix('quotes') . " WHERE quoteID = $quoteID");
            [$catID, $quotext] = $xoopsDB->fetchRow($result);

            xoops_cp_header();
            echo "<table width='100%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";
            echo "<div class='confirmMsg'>";
            echo '<h4>';
            echo '' . _AM_DELETETHISQUOTE . "</font></h4>$quotext<br><br>";
            echo '<table><tr><td>';
            echo myTextForm('index.php?op=del&quoteID=' . $quoteID . "&confirm=1&quotext=$quotext", _AM_YES);
            echo '</td><td>';
            echo myTextForm('category.php?op=default', _AM_NO);
            echo '</td></tr></table>';
            echo '</div><br><br>';
            echo '</td></tr></table>';
            xoops_cp_footer();

        exit();
        break;
    case 'save':
        global $xoopsUser, $xoopsDB;

        //$cat = $myts->addSlashes($_POST['catid']);

        if (isset($_POST['catid'])) {
            $cat = $_POST['catid'];
        }

        $groupid = saveaccess($_POST['groupid']);
        $quotext = $myts->addSlashes($_POST['quotext']);

        echo $_POST['author'];

        if ('-1' == $_POST['author']) {
            $author = $myts->addSlashes($_POST['authorinput']);
        } else {
            $author = $myts->addSlashes($_POST['author']);
        }

        $reference = $myts->addSlashes($_POST['reference']);
        $visible = $_POST['visible'];
        $nohtml = $_POST['nohtml'];
        $nosmiley = $_POST['nosmiley'];
        $noxcodes = $_POST['noxcodes'];
        $quoteID = $myts->addSlashes($_POST['quoteID']);
        $oldid = $myts->addSlashes($_POST['oldid']);
        $quotext = str_replace('"', '&quot;', $quotext);

        // Define variables
        $error = 0;
        $word = null;
        $uid = $xoopsUser->uid();
        $submit = 1;
        $date = time();
        if (!$_POST['modify']) {
            if ($xoopsDB->query(
                'INSERT INTO '
                . $xoopsDB->prefix('quotes')
                . " (catID, quotext, author, reference, uid, datesub, submit, visible, nohtml, nosmiley, noxcodes, groupid) VALUES ('$cat', '$quotext', '$author', '$reference', '$uid', '$date', '$submit', '$visible', '$nohtml', '$nosmiley', '$noxcodes', '$groupid')"
            )) {
                redirect_header('index.php', '1', _AM_QUOTECREATED);
            } else {
                redirect_header('index.php', '1', _AM_QUOTENOTCREATED);
            }
        } else {
            if ($xoopsDB->query(
                'UPDATE ' . $xoopsDB->prefix('quotes') . " SET quotext = '$quotext', author = '$author', reference = '$reference',  visible = '$visible', nohtml = '$nohtml', nosmiley = '$nosmiley', noxcodes = '$noxcodes', groupid = '$groupid', catID = '$cat' WHERE quoteID = $quoteID"
            )) {
                if ($cat != $oldid) {
                    $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('quotecats') . " SET total = total - 1 WHERE catID = '$oldid'");

                    $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('quotecats') . " SET total = total + 1 WHERE catID = '$cat'");
                }

                redirect_header('index.php', '1', _AM_QUOTEMODIFY);
            } else {
                redirect_header('index.php', '1', _AM_QUOTENOTMODIFY);
            }
        }
        exit();
        break;
    case 'default':
    default:

        xoops_cp_header();

        global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;
        echo '<div><h3>' . _AM_TOPICSADMIN . '</h3></div>';

        quotelinks();

        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('quotes') . '');
        $check = $xoopsDB->getRowsNum($result);
        if ($check >= 1) {
            $mytree = new XoopsTree($xoopsDB->prefix('quotes'), 'quoteID', '0');

            $sform = new XoopsThemeForm(_AM_MODIFYQUOTE, 'storyform', xoops_getenv('PHP_SELF'));

            //Modify Category

            ob_start();

            $sform->addElement(new XoopsFormHidden('quoteID', ''));

            $mytree->makeMySelBox('quotext', 'quoteID');

            $sform->addElement(new XoopsFormLabel(_AM_MODIFYTHISQUOTE, ob_get_contents()));

            ob_end_clean();

            $button_tray = new XoopsFormElementTray('', '');

            $hidden = new XoopsFormHidden('modify', 1);

            $hidden = new XoopsFormHidden('op', 'mod');

            $button_tray->addElement($hidden);

            $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_MODIFY, 'submit'));

            $sform->addElement($button_tray);

            $sform->display();

            //Delete Category

            $mytree2 = new XoopsTree($xoopsDB->prefix('quotes'), 'quoteID', '0');

            $dform = new XoopsThemeForm(_AM_DELQUOTE, 'storyform', xoops_getenv('PHP_SELF'));

            ob_start();

            $dform->addElement(new XoopsFormHidden('quoteID', ''));

            $mytree2->makeMySelBox('quotext', 'quoteID');

            $dform->addElement(new XoopsFormLabel(_AM_DELTHISQUOTE, ob_get_contents()));

            ob_end_clean();

            $button_tray = new XoopsFormElementTray('', '');

            $hidden = new XoopsFormHidden('modify', 1);

            $hidden = new XoopsFormHidden('op', 'del');

            $button_tray->addElement($hidden);

            $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_DELETE, 'submit'));

            $dform->addElement($button_tray);

            $dform->display();
        }
        edittopic();
        break;
}
quotefooter();
xoops_cp_footer();
