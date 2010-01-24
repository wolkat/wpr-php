<?php
$mysql_host = 'sql.biuropb.nazwa.pl';
$mysql_user = 'biuropb_7';
$mysql_database = 'biuropb_7';
$mysql_password = 'PJWSTK$gdansk90';
$mysql_port = 3306;
$mysql_dsn = array(
   'phptype' => 'mysqli',
   'username' => 'biuropb_7',
   'password' => 'PJWSTK$gdansk90',
   'hostspec' => 'sql.biuropb.nazwa.pl',
   'database' => 'biuropb_7',
);

mysql_connect ($mysql_host, $mysql_user,$mysql_password) ;
mysql_select_db ($mysql_database);
?>