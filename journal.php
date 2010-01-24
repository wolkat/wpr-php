<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; />
<title>BlogPHP</title>

</head>
<body>
<div id="container">
<?php
include "header.php";

if (isset($_GET['archiwum'])) include "archives.php";
else if (isset($_GET['id'])) include "entry.php"; 
else if (!isset($_GET['id'])) include "entry5.php"; 
else if (isset($_GET['submit'])) include "submit.php";


include "sidebar.php";
?>
</div>
</body>
</html>