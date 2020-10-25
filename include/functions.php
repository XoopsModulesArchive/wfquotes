<?php

/*
* $Id: functions.php,v 1.1 2006/03/27 14:52:01 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 12 July 2005
* Author: Catzwolf
* Licence: GNU
*/
require_once XOOPS_ROOT_PATH . '/include/groupaccess.php';

function generatecjump()
{
    global $PHP_SELF, $tbprefix, $xoopsDB;

    $result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('quotecats') . '');

    if (1 == $xoopsDB->fetchRow($result)) {
        return '&nbsp;';
    }

    $html = '<form method="post">';

    $html .= '<select name="cjump" onchange="jumpMenu(this)">';

    $html .= '<option value="index.php">Category Jump:</option>';

    $html .= '<option value="index.php">--------</option>';

    while (false !== ($query_data = $GLOBALS['xoopsDB']->fetchBoth($result))) {
        $html .= '<option value="index.php?op=cat&c=' . $query_data['catID'] . '">' . $query_data['name'] . '</option>';
    }

    $html .= '</select>';

    $html .= '</form>';

    return $html;
}

function quotelinks()
{
    echo "<table width='100%' border='0' cellspacing='1' cellpadding='2' class = outer>";

    echo "<tr><th class = 'bg3' colspan = '3'>" . _AM_QUOTEADMINHEAD . '</th></tr>';

    echo '<tr>';

    echo " <td class = 'even'><a href='index.php?op=default'>" . _AM_QUOTENEWQUOTE . '</a></td>';

    echo " <td class = 'odd'>" . _AM_QUOTENEWQUOTETXT . '</td>';

    echo '</tr>';

    echo '<tr>';

    echo " <td width='24%' class = 'even'><a href='category.php?op=default'>" . _AM_QUOTENEWCAT . '</a></td>';

    echo " <td class = 'odd'>" . _AM_QUOTENEWCATTXT . '</td>';

    echo '</tr>';

    echo '<tr>';

    echo "<td class = 'even'><a href='submissions.php?op=cat'>" . _AM_QUOTEVALIDATE . '</a></td>';

    echo "<td class = 'odd'>" . _AM_QUOTEVALTXT . '</td>';

    echo '</tr>';

    echo '</table>';
}

function quotefooter()
{
    echo "<br><div style='text-align:center'>" . _AM_VISITSUPPORT . '</div>';
}

function countByCategory($c = 0)
{
    global $xoopsUser, $xoopsConfig, $xoopsDB;

    $count = 0;

    $sql = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('quotes') . " WHERE submit ='1' and catID = '$c'");

    while (false !== ($myrow = $xoopsDB->fetchArray($sql))) {
        if ('1' == checkAccess($myrow['groupid'])) {
            $count++;
        }
    }

    return $count;
}

//updates rating data in itemtable for a given item
function updaterating($sel_id)
{
    global $xoopsDB;

    $query = 'select rating FROM ' . $xoopsDB->prefix('quotes_votedata') . ' WHERE lid = ' . $sel_id . '';

    $voteresult = $xoopsDB->query($query);

    $votesDB = $xoopsDB->getRowsNum($voteresult);

    $totalrating = 0;

    while (list($rating) = $xoopsDB->fetchRow($voteresult)) {
        $totalrating += $rating;
    }

    $finalrating = $totalrating / $votesDB;

    $finalrating = number_format($finalrating, 4);

    $sql = sprintf('UPDATE %s SET rating = %u, votes = %u WHERE quoteID = %u', $xoopsDB->prefix('quotes'), $finalrating, $votesDB, $sel_id);

    $xoopsDB->query($sql);
}

function getuserForm($user)
{
    global $xoopsDB, $xoopsConfig;

    echo "<select name='author'>";

    echo "<option value='-1'>------</option>";

    $result = $xoopsDB->query('SELECT uid, uname FROM ' . $xoopsDB->prefix('users') . ' ORDER BY uname');

    while (list($uid, $uname) = $xoopsDB->fetchRow($result)) {
        if ($uid == $user) {
            $opt_selected = "selected='selected'";
        } else {
            $opt_selected = '';
        }

        echo "<option value='" . $uid . "' $opt_selected>" . $uname . '</option>';
    }

    echo '</select></div>';
}

/**
 * getLinkedUnameFromId()
 *
 * @param int $userid Userid of author etc
 * @param int $name   :  0 Use Usenamer 1 Use realname
 * @return int|mixed|string
 */
function getLinkedUnameFromId($userid = 0, $name = 0)
{
    if (!is_numeric($userid)) {
        return $userid;
    }

    $userid = (int)$userid;

    if ($userid > 0) {
        $memberHandler = xoops_getHandler('member');

        $user = $memberHandler->getUser($userid);

        if (is_object($user)) {
            $ts = MyTextSanitizer::getInstance();

            $username = $user->getVar('uname');

            $usernameu = $user->getVar('name');

            if (($name) && !empty($usernameu)) {
                $username = $user->getVar('name');
            }

            $linkeduser = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $userid . "'>" . $ts->htmlSpecialChars($username) . '</a>';

            return $linkeduser;
        }
    }

    return $GLOBALS['xoopsConfig']['anonymous'];
}
