<?php
include "config.php";

$result1 = mysql_query("SELECT * FROM kategorie ORDER BY category_name ASC");

while($row = mysql_fetch_array($result1)) {

    $result2 = mysql_query("SELECT COUNT(`id`) AS entries FROM artykuly WHERE category = $row[category_id]");
    $num_entries = mysql_fetch_array($result2);

    echo '<a href="category.php?category=' . $row['category_id'] . '">' . $row['category_name'] . '</a> (' . $num_entries['entries'] . ')<br />';

}
?>