<?php
include("./dbconn.php");

$table = "book_seminar";
$name = trim($_POST['seminar_name']);
$date = trim($_POST['date']);
$place = trim($_POST['place']);
$maximum_num = trim($_POST['maximum_num']);
$information = trim($_POST['information']);
$isbn = trim($_POST['isbn']);
$sql = "select * from book where isbn = '$isbn'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$isbn = $row['isbn'];

$sql = "insert into $table(name, date, place, information, isbn, maximum_num) values";
$sql = $sql."('$name', '$date', '$place', '$information', '$isbn', '$maximum_num')";	

$result = mysqli_query($conn, $sql);

//after enrolled
if($result){
	mysqli_close($conn); // 데이터베이스 접속 종료

	echo "<script>alert('등록 완료 되었습니다.');</script>";
	echo"<script>location.replace('./admin_showlist.php');</script>";
	exit;
} else{
	echo"생성 실패 : " . mysqli_error($conn);
	mysqli_close($conn);
}
?>
