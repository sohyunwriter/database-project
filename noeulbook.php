<?php
include("./dbconn.php");  // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.
?>

<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 	<script src="javascript/script.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css?ver=2">
</head>
<body>
<?php if(!isset($_SESSION['ss_user_id'])) {  ?>
	<form action="./login_check.php" method="post">
	<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="./noeulbook.php">
    		<img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

    		<div class = "navbar-item justify-content-end">
    			<table>
    				<tr>
    					<td>id</td>
    					<td>password</td>
    				</tr>	
    				<tr>
    					<td><input type = "text" name = "user_id" ></td>
    					<td><input type = "password" name = "user_password"  ></td>
    					<td><input type = "submit" value = "login"></td>
    				</tr>
    				<tr>
	    				<td colspan = "3" class = "ustify-content-end"><a href = "./register.php?mode=insert">회원 등록이 안 되어 있다면?</a></td>
    				</tr>
    			</table></div>
	</nav>
	
	<div class = "graybar" style = "background-color: #F5F5F5">
		<h1 style = "padding-top : 40px; width : 100%; text-align : center;">Let's join book seminar</h1>
		<input type = "text" name = "search_name" style = "width : 60%; height : 40px; margin-top : 15px; margin-left: 20%; margin-bottom: 90px " placeholder="To use website, first login please">
		<input type = "submit" value = "search" style = "height : 40px;">
	</div>
	</form>
<?php } else {  ?>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="./noeulbook.php">
    		<img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

    		<div class = "navbar-item justify-content-end">
    			<?php
				$user_id = $_SESSION['ss_user_id'];

				$sql = " select * from user where user_id = TRIM('$user_id') ";
				$user_result = mysqli_query($conn, $sql);
				$user = mysqli_fetch_assoc($user_result);

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

<?php  if($user['user_id'] == 'admin'){ ?>
<div class = "graybar" style = "background-color: #F5F5F5; padding-bottom : 10px;">
		<h1 style = "padding-top : 40px; width : 100%; text-align : center;">Let's join book seminar</h1>
		
		<form action="./admin_booksearch.php" method="get">
			<select style = "height : 40px; margin-top : 15px; margin-left: 20%; " name = "search_all">
				<option value = "">검색 조건</option>
				<option value = "책">책</option>
			</select>
			<input type = "text" name = "search_name" style = "width : 60%; height : 40px; margin-top : 50px; margin-left: 1px; margin-bottom: 20px " placeholder="Search book and make new book seminar">
			<input type = "submit" value = "search" style = " height : 40px;">
		</form>
		<table style = "margin-left : 20%;">
			<tr>
				<td width="300" border = "1" cellpadding="3"><a href="./bookrank.php">top 10 books</a></td>
				<td width="300" border = "1" cellpadding="3"><a href="./admin_showlist.php">세미나 목록</a></td>
			</tr>
		</table>
</div>

<?php } else { ?>

<div class = "graybar" style = "background-color: #F5F5F5; padding-bottom : 10px;">
		<h1 style = "padding-top : 40px; width : 100%; text-align : center;">Let's join book seminar</h1>
		<form action="./booksearch.php" method="get">
			<select style = "height : 40px; margin-top : 15px; margin-left: 20%; " name = "search_all">
				<option value = "">검색 조건</option>
				<option value = "책">책</option>
				<option value = "북세미나">북세미나</option>
			</select>
			<input type = "text" name = "search_name" style = "width : 60%; height : 40px; margin-top : 50px; margin-left: 1px; margin-bottom: 20px " placeholder="Search book or book seminar">
			<input type = "submit" value = "search" style = " height : 40px;">
		
		</form>
		<table style = "margin-left : 20%;">
			<tr>
				<td width="300" border = "1" cellpadding="3"><a href="./seminar.php">세미나 신청</a></td>
				<td width="300" border = "1" cellpadding="3"><a href="./bookrank.php">top 10 books</a></td>
				<td width="300" border = "1" cellpadding="3"><a href="./seminar_bag.php">내 세미나 목록</a></td>
                <td width="300" border = "1" cellpadding="3"><a href="./booklike_bag.php">관심 책 목록</a></td>
			</tr>
		</table>
</div>

<?php } ?>
<?php } ?>
</body>
</html>