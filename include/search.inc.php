<?php
/*
* $Id: search.inc.php,v 1.1 2006/03/27 14:52:01 mikhail Exp $
* Module: WF-Quote
* Version: v1.00
* Release Date: 15 August 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

function quote_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    $ret = [];

    if (0 != $userid) {
        return $ret;
    }

    $sql = 'SELECT quoteID, quotext, author, uid, datesub FROM ' . $xoopsDB->prefix('quotes') . ' WHERE submit=1 ';

    // because count() returns 1 even if a supplied variable

    // is not an array, we must check if $querryarray is really an array

    $count = count($queryarray);

    if ($count > 0 && is_array($queryarray)) {
        $sql .= "AND ((quotext LIKE '%$queryarray[0]%' OR author LIKE '%$queryarray[0]%')";

        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";

            $sql .= "(quotext LIKE '%$queryarray[$i]%' OR author LIKE '%$queryarray[$i]%')";
        }

        $sql .= ') ';
    }

    $sql .= 'ORDER BY quoteID DESC';

    $result = $xoopsDB->query($sql, $limit, $offset);

    $i = 0;

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[$i]['image'] = 'images/question2.gif';

        $ret[$i]['link'] = 'index.php?op=view&t=' . $myrow['quoteID'];

        $ret[$i]['quotext'] = $myrow['quotext'];

        $ret[$i]['time'] = $myrow['datesub'];

        $ret[$i]['uid'] = $myrow['uid'];

        $i++;
    }

    return $ret;
}
