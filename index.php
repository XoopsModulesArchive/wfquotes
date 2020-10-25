<?php
/*
* $Id: index.php,v 1.1 2006/03/27 14:52:00 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';
require XOOPS_ROOT_PATH . '/modules/wfquotes/include/functions.php';

$myts = MyTextSanitizer::getInstance();

global $xoopsUser, $xoopsDB, $xoopsConfig;

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

$PHP_SELF = $_SERVER['PHP_SELF'];

switch ($op) {
    case 'cat':
        $GLOBALS['xoopsOption']['template_main'] = 'quotes_category.html';
        $sql = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('quotecats') . " WHERE catID = $c ");
        $cat_info = $xoopsDB->fetchArray($sql);
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('quotes') . " WHERE catID = '$c' and submit ='1' ORDER BY quoteID");
        $totalcat = $xoopsDB->getRowsNum($sql);
        $totaltopics = $xoopsDB->getRowsNum($result);

        $category = [];
        $topics = [];

        if (0 == $totalcat) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOSELECTCAT);

            exit();
        }
        if (0 == $totaltopics) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOTOPICS);

            exit();
        }
        $category['catid'] = $cat_info['catID'];
        $category['name'] = htmlspecialchars($cat_info['name'], ENT_QUOTES | ENT_HTML5);
        $category['catlink'] = "[ <a href='javascript:history.go(-1)'>" . _MD_RETURN . "</a><b> | </b><a href='./index.php'>" . _MD_RETURN2INDEX . '</a> ]';
        $category['description'] = htmlspecialchars($cat_info['description'], ENT_QUOTES | ENT_HTML5);
        //$category['cjump'] = generatecjump();

        while (false !== ($cat_data = $xoopsDB->fetchArray($result))) {
            if (checkAccess($cat_data['groupid'])) {
                $topics['reference'] = $myts->displayTarea($cat_data['reference']);

                //Note: Function  getlinkedUnameFromID, this will automatically put a link to the user for you.

                $topics['author'] = $myts->displayTarea(getLinkedUnameFromId($cat_data['author'], 0));

                $topics['quotext'] = $myts->displayTarea($cat_data['quotext']);

                $topics['quotext'] = mb_substr($topics['quotext'], 0, 60) . '...';

                $topics['datesub'] = formatTimestamp($cat_data['datesub'], 'D, d-M-Y');

                $topics['quoteID'] = $cat_data['quoteID'];

                $topics['poster'] = getLinkedUnameFromId($cat_data['uid'], 0);

                $topics['counter'] = $cat_data['counter'];

                $xoopsTpl->append('topics', ['id' => $cat_data['quoteID'], 'quotext' => $topics['quotext'], 'author' => $topics['author'], 'reference' => $topics['reference'], 'poster' => $topics['poster'], 'datesub' => $topics['datesub'], 'counter' => $topics['counter']]);
            }
        }
        $xoopsTpl->assign(['lang_categorytag' => _MD_CATEGORY, 'lang_topicsindex' => _MD_MAINPTOPICSINDEX, 'lang_quotext' => _MD_MAINPTITLE, 'lang_reference' => _MD_MAINPSUMMARY, 'lang_author' => _MD_MAINPAUTHOR, 'lang_submitted' => _MD_MAINPSUBMITTED, 'lang_hits' => _MD_MAINPHITS]);
        $xoopsTpl->assign('category', $category);
        $data = '';
        break;
    case 'view':
        $GLOBALS['xoopsOption']['template_main'] = 'quotes_quote.html';

        global $xoopsUser, $xoopsDB, $myts;
        /*
        * Myts must be declared before its use, normally right at the start of the page (see above) and set it global
        */
        /*
        * Myts has depreciated functions such as displayTarea, makeTareaData4Edit and should be replaced with the newer functions.
        */
        if (1 == $nohtml) {
            $html = 0;
        } else {
            $html = 1;
        }
        if (1 == $nosmiley) {
            $smiley = 0;
        } else {
            $smiley = 1;
        }
        if (1 == $noxcodes) {
            $xcodes = 1;
        }

        $quotesa = [];
        /*
        * Update counter if not admin or author, prevents false counts on Quote
        */
        if (!($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid()))) {
            $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('quotes') . " SET counter=counter+1 WHERE quoteID = '$t' ");
        }
        /*
        * Hi :-) Your problem with the rating system was here, your query and list where out.  As you selected * (all from the database) you then needed to include all fields from
        * the database.  As you did not, this cause a miss match and then caused your errors here.
        */
        $result = $xoopsDB->queryF('SELECT quoteID, catID, quotext, author, reference, uid, submit, datesub, counter, weight, groupid, rating, votes FROM ' . $xoopsDB->prefix('quotes') . " WHERE quoteID = '$t' and submit = '1' order by datesub");
        [$quoteID, $catID, $quotext, $author, $reference, $uid, $submit, $datesub, $counter, $weight, $groupid, $rating, $votes] = $xoopsDB->fetchRow($result);

        $result2 = $xoopsDB->query('SELECT name FROM ' . $xoopsDB->prefix('quotecats') . " WHERE catID = '$catID'");
        [$cat] = $xoopsDB->fetchRow($result2);
        /*
        *
        * This line filters $author throu $myts and this is why Xoops shows html, smilies and xcode
        *
        * From my understanding, you do not need to appy this to everything.  if you apply myts when submitting the data
        * (that where it is cleaned) then you only need to apply this to where html, Xcodes or smilies can be used here.
        *
        */
        //$author = htmlspecialchars($author);
        $quotesa['author'] = getLinkedUnameFromId($author, 0);
        $quotesa['datesub'] = formatTimestamp($datesub, 'D, d-M-Y, H:i');
        $quotesa['counter'] = $counter;
        $quotext = $myts->displayTarea($quotext);
        $quotesa['quotext'] = $quotext;
        $reference = $myts->displayTarea($reference);
        $quotesa['reference'] = $reference;
        if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
            $quotesa['adminlink'] = " [ <a href='" . XOOPS_URL . '/modules/wfquotes/admin/index.php?op=edit&amp;quoteID=' . $t . "'>" . _EDIT . "</a> | <a href='" . XOOPS_URL . '/modules/wfquotes/admin/index.php?op=del&amp;t=' . $t . "&amp;subm=1'>" . _DELETE . '</a> ] ';
        }
        $quotesa['ratequote'] = "<a href='ratefile.php?lid=" . $t . "'>" . _MD_RATETHISQUOTE . '</a>';
        $quotesa['rating'] = '<b>' . sprintf(_MD_RATINGA, number_format($rating, 2)) . '</b>';
        $quotesa['votes'] = '<b>[' . sprintf(_MD_NUMVOTES, $votes) . ']</b>';
        //$faqsa['printer'] = "index.php?op=print&t=".$t;
        $faqsa['cjump'] = generatecjump();
        $quotesa['catlink'] = "[ <a href='javascript:history.go(-1)'>" . _MD_BACK2CAT . "</a><b> | </b><a href='./index.php'>" . _MD_RETURN2INDEX . '</a> ]';

        $quotesa['poster'] = getLinkedUnameFromId($uid, 0, '');

        $xoopsTpl->assign('quotepage', $quotesa);
        $xoopsTpl->assign(['lang_quote' => _MD_QUOTE, 'lang_publish' => _MD_PUBLISH, 'lang_posted' => _MD_POSTED, 'lang_read' => _MD_READ, 'lang_times' => _MD_TIMES, 'lang_articleheading' => '<span style="font-size: 14px;">' . $quotext . '</span>']);

        require XOOPS_ROOT_PATH . '/include/comment_view.php';
        break;
    case 'default':
    default:

        global $xoopsUser, $xoopsConfig, $xoopsDB;

        $index = [];

        $GLOBALS['xoopsOption']['template_main'] = 'quotes_index.html';
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('quotecats') . ' ORDER BY name');
        $total = $xoopsDB->getRowsNum($result);
        if (0 == $total) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOCATADDED);

            exit();
        }
        while (false !== ($query_data = $xoopsDB->fetchArray($result))) {
            if (checkAccess($query_data['groupid'])) {
                $query_data['name'] = htmlspecialchars($query_data['name'], ENT_QUOTES | ENT_HTML5);

                $query_data['description'] = htmlspecialchars($query_data['description'], ENT_QUOTES | ENT_HTML5);

                $total = countByCategory($query_data['catID']);

                $xoopsTpl->append('indexpage', ['id' => $query_data['catID'], 'description' => $query_data['description'], 'category' => $query_data['name'], 'total' => $total]);
            }
        }
        $xoopsTpl->assign(['lang_category' => _MD_MAININDEXCAT, 'lang_description' => _MD_MAININDEXDESC, 'lang_total' => _MD_MAININDEXTOTAL, 'lang_indextext' => _MD_MAININDEX, 'lang_articleheading' => '<h4>' . sprintf(_MD_WELCOMETOSEC, _MD_CAPTION, $xoopsConfig['sitename']) . '</h4>']);
}

require XOOPS_ROOT_PATH . '/footer.php';
