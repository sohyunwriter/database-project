<?php
include("./dbconn.php");  // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.
?>

<html>
<head>
	<title>Noeul Book</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 	<script src="javascript/script.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php if(!isset($_SESSION['ss_user_id'])) { // 로그인 세션이 있을 경우 로그인 화면 ?>

<h1>로그인</h1>

	<form action="./login_check.php" method="post">
		<table>
			<tr>
				<th>아이디</th>
				<td><input type="text" name="mb_id"></td>
			</tr>
			<tr>
				<th>비밀번호</th>
				<td><input type="password" name="mb_password"></td>
			</tr>
			<tr>
				<td colspan="2" class="td_center">
					<input type="submit" value="로그인"> 
					<a href="./register.php">회원가입</a>
				</td>
			</tr>
		</table>
	</form>

<?php } else { // 로그인 세션이 없을 경우 로그인 완료 화면 ?>

<h1>로그인을 환영합니다.</h1>

	<?php
	$user_id = $_SESSION['ss_user_id'];

	$sql = " select * from user where user_id = TRIM('$user_id') ";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	mysqli_close($conn); // 데이터베이스 접속 종료
	?>
	<table>
		<tr>
			<th>아이디</th>
			<td><?php echo $user['user_id'] ?></td>
		</tr>
		<tr>
			<th>이름</th>
			<td><?php echo $user['name'] ?></td>
		</tr>
		<tr>
			<th>성별</th>
			<td><?php echo $user['gender'] ?></td>
		</tr>
		<tr>
			<td colspan="2" class="td_center">
				<a href="./register.php?mode=modify">회원정보수정</a>
				<a href="./logout.php">로그아웃</a>
			</td>
		</tr>
	</table>

<?php } ?>

</body>
</html>

