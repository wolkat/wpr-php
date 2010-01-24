<?php
include "config.php";

if (!isset($_GET['category'])) {
    die("B³êdna nazwa kategorii.");
}
else {
    $category = (int)$_GET['category'];
}

$result = mysql_query("SELECT timestamp, id, title FROM artykuly WHERE category = $category ORDER BY id DESC");

$num = mysql_num_rows($result);

$get_category = mysql_query("SELECT * FROM kategorie WHERE category_id = $category");
$get_category2 = mysql_fetch_array($get_category);

echo "<h1>$num obiekt(y)/ów w kategorii &quot;$get_category2[category_name]&quot;.</h1>";

while($row = mysql_fetch_array($result)) {
    $date = date("m/d/Y", $row['timestamp']);
    $id = $row['id'];
    $title = stripslashes($row['title']);

    ?>

    <p><?php echo $date; ?><br /><a href="journal.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></p>
    <?php
}

?>