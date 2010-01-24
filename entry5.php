<?php
include "config.php";

$blog_postnumber = 5;

if(!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = (int)$_GET['page'];
}
$from = (($page * $blog_postnumber) - $blog_postnumber);

$sql = "SELECT * FROM artykuly ORDER BY timestamp DESC LIMIT $from, $blog_postnumber";

$result = mysql_query($sql) or print ("Nie ma artyku³ów w tabeli artykuly.<br />" . $sql . "<br />" . mysql_error());

while($row = mysql_fetch_array($result)) {

    $date = date("d-m-Y", $row['timestamp']);

    $title = stripslashes($row['title']);
    $entry = stripslashes($row['entry']);
    $id = $row['id'];
	$get_categories = mysql_query("SELECT * FROM kategorie WHERE `category_id` = $row[category]");
    $category = mysql_fetch_array($get_categories);
	if (strlen($entry) > 255) {
    $entry = substr($entry, 0, 255);
    $entry = "$entry... <br /><a href=\"journal.php?id=" . $id . "\">Czytaj dalej...</a>";
	}

    ?>
		
		<div id= "content">
			<div id= "post" style="width:600px;">
				<h2><a href="journal.php?id=<?php echo $id; ?>"><strong><?php echo $title; ?></strong></a></h2>
			<div class="post-content"><p><?php echo $entry; ?></p></div>
				<h3><ul class="meta"><a href="category.php?category=<?php echo $row['category']; ?>"><?php echo $category['category_name']; ?></a> <?php echo $date; ?>
				<?php
				$result2 = mysql_query ("SELECT id FROM komentarze WHERE entry='$id'");
				$num_rows = mysql_num_rows($result2);
				?>
				<a href="journal.php?id=<?php echo $id; ?>">(<?php echo $num_rows; ?>) komentarze</a>;
				</ul></h3>
			</div>
			<hr />
		</div>
		
	

    <?php
}

$total_results = mysql_fetch_array(mysql_query("SELECT COUNT(*) as num FROM artykuly"));
$total_pages = ceil($total_results['num'] / $blog_postnumber);
if ($page > 1) {
    $prev = ($page - 1);
    echo "<a href=\"journal.php?page=$prev\">&lt;&lt;  Nowsze</a> ";
}
for($i = 1; $i <= $total_pages; $i++) {
    if ($page == $i) {
        echo "$i ";
        }
		else {
           echo "<a href=\"journal.php?page=$i\">$i</a> ";
        }
}
if ($page < $total_pages) {
   $next = ($page + 1);
   echo "<a href=\"journal.php?page=$next\">Starsze &gt;&gt;</a>";
}
?>