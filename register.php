<?php
include("./dbconn.php");

if(isset($_SESSION['ss_user_id']) && $_GET['mode'] == 'modify'){
	$user_id = $_SESSION['ss_user_id'];

	$sql = " SELECT * FROM user WHERE user_id = '$user_id' ";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	$password = trim($user['user_password']);

	$mode = "modify";
	$title = "회원 정보 수정";
	$modify_user_info = "readonly";
} else {
	$mode = "insert";
	$title = "회원가입";
	$modify_user_info = '';
}
?>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 	<script src="javascript/script.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php if($mode == "insert") {  ?>
	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="./noeulbook.php">
    		<img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

</nav>	

<h1><?php echo $title ?></h1>

<form action="./register_update.php" onsubmit="return fregisterform_submit(this);" method="post">
	<input type = "hidden" name = "mode" value="<?php echo $mode ?>">

	<table>
		<tr>
			<th>아이디</th>
			<td><input type="text" name="user_id"></td>			
		</tr>
		<tr>
			<th>비밀번호</th>
			<td><input type = "password" name = "user_password"></td>
		</tr>
		<tr>
			<th>비밀번호 확인</th>
			<td><input type = "password" name = "user_password_re"></td>
		</tr>
		<tr>
			<th>이름</th>
			<td><input type = "text" name = "name"></td>
		</tr>
		<tr>
			<th>성별</th>
			<td><input type = "radio" name = "gender" value = "남성">남성 <input type = "radio" name = "gender" value = "여성">여성 </td>
		</tr>
		<tr>
			<td><input type ="submit" value="회원가입"></td>
			<td><button><a href="./noeulbook.php">취소</a></button></td>
	</table>
</form>
<?php } else {  ?>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="./noeulbook.php">
    		<img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

    		<div class = "navbar-item justify-content-end">
    			<?php
				$user_id = $_SESSION['ss_user_id'];

				$sql = " select * from user where user_id = TRIM('$user_id') ";
				$result = mysqli_query($conn, $sql);
				$user = mysqli_fetch_assoc($result);

				mysqli_close($conn); // 데이터베이스 접속 종료
				?>
			<table>
				<tr>
					<td style = "padding : 10px"><?php echo $user['name'] ?></td>
					<td style = "padding : 10px"><?php echo $user['user_id'] ?></td>
					<td style = "padding : 10px"><a href="./register.php?mode=modify">회원정보수정</a></td>
					<td style = "padding : 10px"><a href="./logout.php">로그아웃</a></td>
				</tr>
			</table>
		</div>
</nav>	
<h1><?php echo $title ?></h1>
<form action="./register_update.php" onsubmit="return fmodifyform_submit(this);" method="post">
	<input type = "hidden" name = "mode" value="<?php echo $mode ?>">

	<table>
		<tr>
			<th>현재 비밀번호</th>
			<td><input type = "password" name = "user_password"></td>
		</tr>
		<tr>
			<th>새 비밀번호</th>
			<td><input type = "password" name = "user_password_new"></td>
		</tr>
		<tr>
			<th>새 비밀번호 확인</th>
			<td><input type = "password" name = "user_password_new_re"></td>
		</tr>
		<tr>
			<td><input type ="submit" value="회원 정보 수정"></td>
			<td><button><a href="./noeulbook.php">취소</a></button></td>
	</table>
</form>

<?php } ?>
<script>
	function fregisterform_submit(f) {
		if(f.user_id.value.length < 1 || f.name.value.length < 1|| f.gender.value.length < 1 || f.user_password.value.length < 1 || f.user_password_re.value.length < 1 ){
			alert("모든 칸을 채워주세요.");
			return false;
		}

		if(f.user_password.value != f.user_password_re.value){
			alert("비밀번호를 일치해서 입력해주세요.");
			return false;
		}

		return true;
	}

	function fmodifyform_submit(f) {
		if(f.user_password.value.length < 1 || f.user_password_new.value.length < 1|| f.user_password_new_re.value.length < 1 ){
			alert("모든 칸을 채워주세요.");
			return false;
		}

		if(f.user_password_new.value != f.user_password_new_re.value){
			alert("비밀번호를 일치해서 입력해주세요.");
			return false;
		}

		if(!($password === f.user_password.value)){
			alert("기존 패스워드가 틀립니다.");
			return false;
		}
		
		return true;
	}
</script>

</body>
</html>