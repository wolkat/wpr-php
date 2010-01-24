<?php
include "config.php";

$result = mysql_query("SELECT timestamp, id, title FROM artykuly ORDER BY id DESC");

while($row = mysql_fetch_array($result)) {
    $date  = date("l F d Y",$row['timestamp']);
    $id = $row['id'];
    $title = strip_tags(stripslashes($row['title']));

    if (mb_strlen($title) >= 20) {
        $title = substr($title, 0, 20);
        $title = $title . "...";
    }
    print("<a href=\"update.php?id=" . $id . "\">" . $date . " -- " . $title . "</a><br />");
}

mysql_close();

?>