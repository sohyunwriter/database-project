<?php
include("./dbconn.php");

$table = "seminar_enroll";
$book_seminar_id = trim($_POST['book_seminar_id']);
$user_id = trim($_SESSION['ss_user_id']);

// 이미 등록한 book_seminar_id 인지 확인
$sql = " SELECT * FROM $table WHERE user_id = '$user_id' and book_seminar_id = '$book_seminar_id' ";
$result = mysqli_query($conn, $sql);

if($result && mysqli_num_rows($result) > 0 ){
	echo "<script>alert('You already enrolled this book seminar.');</script>";
	echo "<script>location.replace('./seminar_bag.php')</script>";
	exit;
}

//정원이 꽉 찼는지 확인
$sql = " SELECT * FROM book_seminar where book_seminar_id = '$book_seminar_id' ";
$result = mysqli_query($conn, $sql);

if($result && mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);
	if($row['maximum_num'] - $row['enroll_num'] <= 0 ){
		echo "<script>alert('This seminar is already full.');</script>";
		echo "<script>location.replace('./seminar.php');</script>";
		exit;
}
}

//아닌 경우 intsert into 'enroll' table 
$sql = "insert into $table values";
$sql = $sql."('$user_id', '$book_seminar_id')";	

$result = mysqli_query($conn, $sql);

//after enrolled
if($result){

	$sql = " UPDATE book_seminar SET enroll_num = enroll_num + 1 where book_seminar_id = '$book_seminar_id'";
	$result2 = mysqli_query($conn, $sql);
	
	mysqli_close($conn); // 데이터베이스 접속 종료

	echo "<script>alert('신청 완료 되었습니다.');</script>";
	echo"<script>location.replace('./seminar_bag.php');</script>";
	exit;
} else{
	echo"생성 실패 : " . mysqli_error($conn);
	mysqli_close($conn);
}
?>
