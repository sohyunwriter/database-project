<?php
include("./dbconn.php");

$table = "book_like";
$isbn = trim($_POST['isbn']);
$user_id = trim($_SESSION['ss_user_id']);

// 이미 좋아요한 책인지 확인
$sql = " SELECT * FROM $table WHERE user_id = '$user_id' and isbn = '$isbn' ";
$result = mysqli_query($conn, $sql);

if($result && mysqli_num_rows($result) > 0 ){
	echo "<script>alert('You already liked this book.');</script>";
	echo "<script>location.replace('./booklike_bag.php')</script>";
	exit;
}

//아닌 경우 intsert into 'book like' table 
$sql = "insert into $table values";
$sql = $sql."('$user_id', '$isbn')";	

$result = mysqli_query($conn, $sql);

//after enrolled
if($result){

	$sql = " UPDATE book SET like_count = like_count + 1 where isbn = '$isbn' ";
	$result2 = mysqli_query($conn, $sql);
	
	mysqli_close($conn); // 데이터베이스 접속 종료

	echo "<script>alert('관심 있는 책 표시 되었습니다.');</script>";
	echo"<script>location.replace('./booklike_bag.php');</script>";
	exit;
} else{
	echo"생성 실패 : " . mysqli_error($conn);
	mysqli_close($conn);
}
?>
