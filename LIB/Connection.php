<?php


$host="localhost";
$usernameq="root";
$passwordq="jparkhotel88";
mysql_connect( $host,$usernameq,$passwordq) or die ("Cannot connect to Server. ERROR CODE 1");
$db="fbconnectdb";
mysql_select_db($db) or die("Cannot connect to Serve. ERROR CODE 2");
mysql_query("SET NAMES 'utf8'");
?>