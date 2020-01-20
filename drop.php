<?php
include("./dbconn.php");

$table = "seminar_enroll";
$table1 = "book_seminar";

$book_seminar_id = trim($_POST['book_seminar_id']);

$user_id = trim($_SESSION['ss_user_id']);

//seminar_enroll에서 삭제
$sql = " DELETE FROM $table WHERE user_id = '$user_id' and book_seminar_id = '$book_seminar_id' ";
$result = mysqli_query($conn, $sql);

//book_seminar 갱신
$sql = " UPDATE $table1 SET enroll_num = enroll_num - 1 WHERE book_seminar_id = '$book_seminar_id' ";
$result = mysqli_query($conn, $sql);

// $sql = " UPDATE $table1 SET enroll_num = enroll_num - 1 WHERE book_seminar_id = '$book_seminar_id' ";
// $result = mysqli_query($conn, $sql);

//after process
if($result){

	mysqli_close($conn); // 데이터베이스 접속 종료

	echo "<script>alert('해당 세미나 신청 취소되었습니다.');</script>";
	echo"<script>location.replace('./seminar_bag.php');</script>";
	exit;
} else{
	echo"생성 실패 : " . mysqli_error($conn);
	mysqli_close($conn);
}
?>
