<?php
DEFINE('HOST', 'localhost');
DEFINE('USER', 'lmsnyder04');
DEFINE('PASS', 'youngstownYSU2525!!');
DEFINE('DB', 'lmsnyder04_beauty');

$link = @mysqli_connect(HOST, USER, PASS, DB) or die('The following error occurred: '.mysqli_connect_error());
mysqli_set_charset($link, 'utf8');
?>
