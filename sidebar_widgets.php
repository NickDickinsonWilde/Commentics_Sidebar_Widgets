<?php
include "includes/db/details.php";
include "includes/db/connect.php";

function get_recent($mode="ul", $max=5) { 
    /*mode: ul returns them in an unorder list format [Default]
            ol returns them in an ordered list format
            p returns them in paragraph format separated by line breaks
      max: the maximum number to return.
    */
    ob_start();
    global $cmtx_mysql_table_prefix;
    echo "<h3>Recent Comments</h3>";
    switch ($mode) {
        case "ol": 
            echo "<ol>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ol>";
            break;
        case "p": 
            echo "<p>";
            $start = "";
            $end = "<br />";
            $clear = "</p>";
            break;
        case "ul":
        default:
            echo "<ul>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ul>";
        }

    $comments = mysql_query("SELECT * FROM `" . $cmtx_mysql_table_prefix . "comments` WHERE `is_approved` = '1' ORDER BY `dated` DESC LIMIT $max");
    while ($comment = mysql_fetch_array($comments)) {
        $page_query = mysql_query("SELECT * FROM `" . $cmtx_mysql_table_prefix . "pages` WHERE `id` = '" . $comment["page_id"] . "'");
        $page = mysql_fetch_assoc($page_query);
        echo "{$start}{$comment["name"]} on <a href='{$page["url"]}'>{$page["reference"]}</a> at ".date("g:ia (jS-M)", strtotime($comment["dated"])).$end;	
    }
    echo $clear;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function get_most_commented($mode="ul", $max=5) {
    /*mode: ul returns them in an unordered list format [Default]
            ol returns them in an ordered list format
            p returns them in paragraph format separated by line breaks
      max: the maximum number to return.
    */
    ob_start();
    global $cmtx_mysql_table_prefix;
    echo "<h3>Most Commented</h3>";
    switch ($mode) {
        case "ol": 
            echo "<ol>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ol>";
            break;
        case "p": 
            echo "<p>";
            $start = "";
            $end = "<br />";
            $clear = "</p>";
            break;
        case "ul":
        default:
            echo "<ul>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ul>";
        }
    $query = "SELECT `page_id`, COUNT(`page_id`) AS `total` FROM `" . $cmtx_mysql_table_prefix . "comments` WHERE `is_approved` = '1' GROUP BY `page_id` ORDER BY `total` DESC LIMIT {$max}";
    $comments = mysql_query($query);
    while ($comment = mysql_fetch_assoc($comments)) {
        $page_query = mysql_query("SELECT * FROM `" . $cmtx_mysql_table_prefix . "pages` WHERE `id` = '" . $comment["page_id"] . "'");
        $page = mysql_fetch_assoc($page_query);
        
        echo "{$start}<a href='{$page["url"]}'>{$page["reference"]}</a> ({$comment["total"]}){$end}";	
        }
    echo $clear;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
    
function get_top_posters($mode="ul", $max=5) {
    /*mode: ul returns them in an unorder list format [Default]
            ol returns them in an ordered list format
            p returns them in paragraph format separated by line breaks
      max: the maximum number to return.
    */
    ob_start();
    global $cmtx_mysql_table_prefix;
    echo "<h3>Top Posters</h3>";
    switch ($mode) {
        case "ol": 
            echo "<ol>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ol>";
            break;
        case "p": 
            echo "<p>";
            $start = "";
            $end = "<br />";
            $clear = "</p>";
            break;
        case "ul":
        default:
            echo "<ul>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ul>";
        }

    $names = mysql_query("SELECT `name`, COUNT(`name`) AS `total` FROM `" . $cmtx_mysql_table_prefix . "comments` WHERE `is_approved` = '1' GROUP BY `name` ORDER BY `total` DESC LIMIT 5");

    while ($name = mysql_fetch_assoc($names)) {
        echo "{$start}{$name["name"]}: {$name["total"]}{$end}";
        }

    echo $clear;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
    
function get_best_rated($mode="ul", $max=5) {
    /*mode: ul returns them in an unorder list format [Default]
            ol returns them in an ordered list format
            p returns them in paragraph format separated by line breaks
      max: the maximum number to return.
    */
    ob_start();
    global $cmtx_mysql_table_prefix;
    echo "<h3>Best Rated</h3>";
    switch ($mode) {
        case "ol": 
            echo "<ol>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ol>";
            break;
        case "p": 
            echo "<p>";
            $start = "";
            $end = "<br />";
            $clear = "</p>";
            break;
        case "ul":
        default:
            echo "<ul>";
            $start = "<li>";
            $end = "</li>";
            $clear = "</ul>";
        }

    $comments = mysql_query("SELECT `page_id`, AVG(`rating`) AS `average` FROM `" . $cmtx_mysql_table_prefix . "comments` WHERE `is_approved` = '1' AND `rating` != '0' GROUP BY `page_id` ORDER BY `average` DESC LIMIT {$max}");

    while ($comment = mysql_fetch_assoc($comments)) {
        $average = round($comment["average"] / 0.5) * 0.5;
        $page_query = mysql_query("SELECT * FROM `" . $cmtx_mysql_table_prefix . "pages` WHERE `id` = '" . $comment["page_id"] . "'");
        $page = mysql_fetch_assoc($page_query);
        echo "{$start}<a href='{$page["url"]}'>{$page["reference"]}</a> ({$average}/5){$end}";
        }
    echo $clear;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
?>