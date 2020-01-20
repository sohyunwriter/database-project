<?php
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_password = "algoalgo22";
$mysql_db = "project";

$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password);
mysqli_select_db($conn, $mysql_db);
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

if(!$conn){
	die("연결 실패 : " . mysqli_connect_error());
}

session_start();
?>