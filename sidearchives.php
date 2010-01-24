<?php
include "config.php";

$result = mysql_query("SELECT FROM_UNIXTIME(timestamp, '%M %Y') AS get_month, COUNT(*) AS entries FROM artykuly GROUP BY get_month");

while ($row = mysql_fetch_array($result)) {
    $get_month = $row['get_month'];
	$entries = $row['entries'];

    echo "<a href=\"journal.php?archiwum=1&month=" . $get_month . "\">" . $get_month ."</a> (" . $entries . ")<br />";
}

?>