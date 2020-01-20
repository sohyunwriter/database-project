<?php
include("./dbconn.php");

$user_id = trim($_POST['user_id']);
$user_password = trim($_POST['user_password']);

if(!$user_id || !$user_password){
	echo "<script>alert('fill all the blank');</script>";
	echo "<script>location.replace('./noeulbook.php');</script>";
	mysqli_close($conn);
	exit;
}

$sql = " SELECT * FROM user WHERE user_id = '$user_id' ";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$sql = " SELECT SHA2('$user_password', 224) AS pass ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$password = $row['pass'];

if(!$user['user_id'] || !($password === $user['user_password'])){
	echo "<script>alert('wrong id or password');</script>";
	echo "<script>location.replace('./noeulbook.php');</script>";
	mysqli_close($conn);
	exit;
}

$_SESSION['ss_user_id'] = $user_id;

if(isset($_SESSION['ss_user_id'])){
	if($user['user_id'] == 'admin' && ($password === $user['user_password'])){
		echo "<script>alert('welcome manager');</script>";
		echo "<script>location.replace('./noeulbook.php');</script>";
		mysqli_close($conn);
		exit;
	}	
	echo "<script>alert('login succeed');</script>";
	echo "<script>location.replace('./noeulbook.php');</script>";
}
mysqli_close($conn);
?>