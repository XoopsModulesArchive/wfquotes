<?php
/*
* $Id: submit.php,v 1.1 2006/03/27 14:52:00 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

global $xoopsUser, $xoopsUser, $xoopsConfig;

if (!is_object($xoopsUser)) {
    redirect_header('index.php', 1, _NOPERM);

    exit();
}

global $wfsConfig;
foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

$op = 'form';

if (isset($_POST['post'])) {
    $op = 'post';
} elseif (isset($_POST['edit'])) {
    $op = 'edit';
}

switch ($op) {
    case 'post':
        $myts = MyTextSanitizer::getInstance();
        global $xoopsUser, $xoopsConfig;

        if (is_object($xoopsUser)) {
            $uid = $xoopsUser->uid();
        } else {
            $uid = 0;
        }
        if ((int)$_POST['catid']) {
        } else {
            echo (int)$_POST['catid'];
        }

        $cat = $myts->addSlashes($_POST['catID']);
        $quotext = $myts->addSlashes($_POST['quotext']);
        $author = $myts->addSlashes($_POST['author']);
        $reference = $myts->addSlashes($_POST['reference']);
        $uid = $xoopsUser->uid();
        $datesub = time();
        $submit = 0;

        $result = $xoopsDB->queryF('INSERT INTO ' . $xoopsDB->prefix('quotes') . " (catID, quotext, author, reference, uid, datesub, submit) VALUES ('$cat', '$quotext', '$author', '$reference', '$uid', '$datesub', '$submit')");

        if ($result) {
            $xoopsMailer = getMailer();

            $xoopsMailer->useMail();

            $xoopsMailer->setToEmails($xoopsConfig['adminmail']);

            $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);

            $xoopsMailer->setFromName($xoopsConfig['sitename']);

            $xoopsMailer->setSubject(_MD_NOTIFYSBJCT);

            $author = _MD_NOTIFYMSG;

            $author .= "\n\n" . _MD_TITLE . ': ' . $quotext;

            $author .= "\n" . _MD_POSTEDBY . ': ' . XoopsUser::getUnameFromId($uid);

            $author .= "\n" . _MD_DATE . ': ' . formatTimestamp(time(), 'm', $xoopsConfig['default_TZ']);

            $author .= "\n\n" . XOOPS_URL . '/modules/quotes/admin/submissions.php?op=allow&t=$quoteID&c=$catID';

            $xoopsMailer->setBody($author);

            $xoopsMailer->send();
        } else {
            redirect_header('submit.php', 2, _MD_ERRORSAVINGDB);
        }

        redirect_header('index.php', 2, _MD_SUBMITUSER);
        exit();
        break;
    case 'form':
    default:
        require XOOPS_ROOT_PATH . '/header.php';
        $result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('quotecats') . ' ORDER BY name');
        $options = '';
        while (false !== ($query_data = $GLOBALS['xoopsDB']->fetchBoth($result, MYSQL_ASSOC))) {
            $options .= '<option value="' . $query_data['catID'] . '">' . $query_data['name'] . '</option>';
        }

        $quotext = '';
        $author = '';
        $reference = '';
        $catid = 1;
        //$uid = 0;
        $noname = 0;
        $nohtml = 0;
        $nosmiley = 0;
        $notifypub = 1;
        require __DIR__ . '/include/storyform.inc.php';
        require XOOPS_ROOT_PATH . '/footer.php';
        break;
}
