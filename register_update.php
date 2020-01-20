<?php
include("./dbconn.php");

$mode = $_POST['mode'];

if($mode != 'insert' && $mode != 'modify') { // 아무런 모드가 없다면 중단
	echo "<script>alert('mode 값이 제대로 넘어오지 않았습니다.');</script>";
	echo "<script>location.replace('./register.php');</script>";
	exit;
}

switch ($mode) {
    case 'insert' :
        $mb_id = trim($_POST['user_id']);
		$title = "회원가입";
        break;
    case 'modify' :
        $mb_id = trim($_SESSION['ss_user_id']);
		$title = "회원수정";
        break;
}

if($mode == "insert") { // 신규 등록 상태

$user_id          = trim($_POST['user_id']);
$user_password    = trim($_POST['user_password']);
$name             = trim($_POST['name']);
$gender           = trim($_POST['gender']);

if(!$user_id || !$user_password || !$name || !$gender){
	echo "<script>alert('data not go through');</script>";
	echo "<script>location.replace('./register.php);</script>";
	exit;
}

$sql = " SELECT SHA2('$user_password', 224) AS pass";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_password = $row['pass'];

	$sql = " SELECT * FROM user WHERE user_id = '$user_id' ";
	$result = mysqli_query($conn, $sql);

	if($result && mysqli_num_rows($result) > 0 ){
		echo "<script>alert('id already exists. new id plz');<script>";
		echo "<script>location.replace('./register.php');</script>";
		exit;
	}

	$sql = "insert into user values";
	$sql = $sql."('$user_id', '$user_password', '$name', '$gender')";	

	$result = mysqli_query($conn, $sql);
	
} else if ($mode == "modify") { // 회원 수정 상태
	$user_id = $_SESSION['ss_user_id'];
	$user_password_new    = trim($_POST['user_password_new']);

	$sql = " UPDATE user
				SET user_password = SHA2('$user_password_new', 224)
			 WHERE user_id = '$user_id' ";
	$result = mysqli_query($conn, $sql);
}

if($result){
	mysqli_close($conn); // 데이터베이스 접속 종료

	echo "<script>alert('".$title."이 완료 되었습니다.');</script>";
	echo"<script>location.replace('./noeulbook.php');</script>";
	exit;
} else{
	echo"생성 실패 : " . mysqli_error($conn);
	mysqli_close($conn);
}
?>
