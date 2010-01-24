<?php
if (isset($_POST['submit_comment'])) {

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comment'])) {
        die("Nie wype³ni³eœ wszystkich pól!");
    }

    $entry = htmlspecialchars(strip_tags($_POST['entry']));
    $timestamp = htmlspecialchars(strip_tags($_POST['timestamp']));
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $url = htmlspecialchars(strip_tags($_POST['url']));
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $comment = nl2br($comment);

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $url = addslashes($url);
        $comment = addslashes($comment);
    }

    if (!eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
         die("Wprowadzi³eœ b³êdny format e-mail.");
    }

    include "config.php";

    $result = mysql_query("INSERT INTO komentarze (entry, timestamp, name, email, url, comment) VALUES ('$entry','$timestamp','$name','$email','$url','$comment')");

    header("Location: journal.php?id=" . $entry);
}
else {
    die("Error: Nie masz bezpoœredniego dostêpu do tej strony.");
}
?>