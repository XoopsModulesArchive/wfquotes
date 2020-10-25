<?php
/*
* $Id: wfquote_block.php,v 1.1 2006/03/27 14:51:59 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

function b_show_quote()
{
    global $xoopsDB, $myts;

    $block = [];

    $myts = MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('SELECT count(*) FROM ' . $xoopsDB->prefix('quotes'));

    [$total_rows] = $xoopsDB->fetchRow($result);

    $x = mt_rand(1, $total_rows);

    $result = $xoopsDB->query('SELECT quotext, author FROM ' . $xoopsDB->prefix('quotes') . ' WHERE quoteID=' . $x);

    [$quotext, $author] = $xoopsDB->fetchRow($result);

    $block['quotext'] = $myts->displayTarea($quotext);

    $block['author'] = htmlspecialchars($author, ENT_QUOTES | ENT_HTML5);

    $block['teaser'] = _MI_MOREQUOTES;

    return $block;
}
