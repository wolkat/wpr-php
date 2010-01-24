<?php

include "config.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID specified.");
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM artykuly WHERE id='$id' LIMIT 1";

$result = mysql_query($sql) or print ("Nie ma artykulów w tabeli artykuly.<br />" . $sql . "<br />" . mysql_error());

while($row = mysql_fetch_array($result)) {

    $date = date("m-d-Y", $row['timestamp']);

    $title = stripslashes($row['title']);
    $entry = stripslashes($row['entry']);
    $get_categories = mysql_query("SELECT * FROM kategorie WHERE `category_id` = $row[category]");
    $category = mysql_fetch_array($get_categories);
    ?>
 

            <div id= "content">
			<div id= "post">
				<h2><a href="journal.php?id=<?php echo $id; ?>"><strong><?php echo $title; ?></strong></a></h2>
			<div class="post-content"><p><?php echo $entry; ?></p></div>
				<h3><ul class="meta"><a href="category.php?category=<?php echo $row['category']; ?>"><?php echo $category['category_name']; ?></a> | <?php echo $date; ?></h3>
				</ul></div>
				<hr /></div>
				
		<?php
		$sql_prev = "SELECT * FROM artykuly WHERE id < '$id' ORDER BY id DESC LIMIT 1";
		$result_prev = mysql_query ($sql_prev) or print ("NIe ma poprzedniego elementu w tabeli artykuly.<br />" . $sql_prev . "<br />" . mysql_error());

		while ($row = mysql_fetch_array($result_prev)) {
    			$prev = $row['id'];
		}

		if (isset($prev)) {
    		// print a previous link
    			printf("<a href=\"journal.php?id=%s\">Poprzedni</a> -- ", $prev);
		}
		else {
    		// just print the word "previous"

    		print "Poprzedni -- ";
		}
		
		$sql_next = "SELECT * FROM artykuly WHERE id > '$id' ORDER BY id LIMIT 1";
		$result_next = mysql_query ($sql_next) or print ("Nie ma nastêpnego elementu w tabeli artykuly.<br />" . $sql_next . "<br />" . mysql_error());

		while ($row = mysql_fetch_array($result_next)) {
    			$next = $row['id'];
		}

		if (isset($next)) {
    		// print a next link
    		printf("<a href=\"journal.php?id=%s\">Nastêpny</a>", $next);
		}
		else {
    		// just print the word "next"

    			print "Nastêpny";
		}
		             
}
$commenttimestamp = strtotime("now");

$sql = "SELECT * FROM komentarze WHERE entry='$id' ORDER BY timestamp";
$result = mysql_query ($sql) or print ("Nie ma komentarzy w tabeli komentarze.<br />" . $sql . "<br />" . mysql_error());
while($row = mysql_fetch_array($result)) {
    $timestamp = date("m/d/Y H:i:s", $row['timestamp']);
    printf("<hr />");
    print("<p>" . stripslashes($row['comment']) . "</p>");
    printf("<p>-- <a href=\"%s\">%s</a> => %s</p>", stripslashes($row['url']), stripslashes($row['name']), $timestamp);
    printf("<hr />");
}
?>
<form method="post" action="process.php">

<p><input type="hidden" name="entry" id="entry" value="<?php echo $id; ?>" />

<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $commenttimestamp; ?>">

<strong><label for="name">Nick:</label></strong> <input type="text" name="name" id="name" size="25" /><br />

<strong><label for="email">E-mail:</label></strong> <input type="text" name="email" id="email" size="25" /><br />

<strong><label for="url">URL:</label></strong> <input type="text" name="url" id="url" size="25" value="http://" /><br />

<strong><label for="comment">Komentarz:</label></strong><br />
<textarea cols="25" rows="5" name="comment" id="comment"></textarea></p>

<p><input type="submit" name="submit_comment" id="submit_comment" value="Wrzucaj" /></p>

</form>