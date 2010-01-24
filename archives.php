<?php
include "config.php";

if ($_GET['archiwum']=='1') {
	if (!isset($_GET['month'])) {
		die("Error: Niepoprawny miesiac.");
	}
	else {
		$month = htmlentities(strip_tags($_GET['month']));
	}

	$result = mysql_query("SELECT timestamp, id, title FROM artykuly WHERE FROM_UNIXTIME(`timestamp`, '%M %Y') = '" . mysql_real_escape_string($month) . "' ORDER BY id DESC");

	while ($row = mysql_fetch_array($result)) {
		$date = date("m-d-Y", $row['timestamp']);
		$id = $row['id'];
		$title = stripslashes($row['title']);


?>

    <p><?php echo $date; ?><br /><a href="journal.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></p>
    <?php
	}
}
else if ($_GET[archiwum]=='2'){

	$result = mysql_query("SELECT timestamp, id, title FROM artykuly ORDER BY timestamp DESC");

	while ($row = mysql_fetch_array($result)) {
		$date = date("m-d-Y", $row['timestamp']);
		$id = $row['id'];
		$title = stripslashes($row['title']);
		?>
	<p><?php echo $date; ?><br /><a href="journal.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></p>
<?php
}
else echo "<p>Error: Niepoprawna wartosc archiwum.</p>";
}

?>