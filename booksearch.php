<?php
include("./dbconn.php");  

$things = "%".trim($_GET['search_name'])."%";

if($_GET['search_all'] == "책"){
	$table ="book";
	$sql = " SELECT * FROM $table WHERE book_name LIKE '$things' ";
} else {
	$table ="book_seminar";
	$sql = " SELECT * FROM $table WHERE name LIKE '$things' ";
}

?>

<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 	<script src="javascript/script.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css?ver=2">
</head>
<style>
.back {
        padding: 40px;
        background-image: url( "/background.png" );
        background-size : cover;
        text-align : center;
}

p {
        padding: 30px;
        font-size: 50px;
        font-weight: bold;
        text-align: center;
        background-color: #ffffff;
        opacity: 0.5;
      }

.tds{
        width : 98%;
        border-style : solid;
        border-top-width : 1px;
        border-top-color: #000000;
        margin:20px;
        font-size:20px;
        text-align: center;
      }
</style>
<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="./noeulbook.php">
    		<img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

    		<div class = "navbar-item justify-content-end">
    			<?php
				$user_id = $_SESSION['ss_user_id'];

				$user_sql = " select * from user where user_id = TRIM('$user_id') ";
				$user_result = mysqli_query($conn, $user_sql);
				$user = mysqli_fetch_assoc($user_result);

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
<?php 
$result = mysqli_query($conn, $sql);
?>
<?php if($table == "book") {  ?>
    <table class = "tds" width="800" border = "1" cellpadding="10">
      <tr align = "center">
         <th>책 이름</th>
         <th>저자</th>
         <th>책 정보</th>
         <th>isbn</th>
         <th>관심 책 담기</th>
      </tr>
      <?php
	  if ($result) {
		  while($row = mysqli_fetch_array($result)){
			 echo(
				 "<tr>
					  <form action='./book_like.php' method = 'post'>
					  <td>{$row['book_name']}</td>
					  <td>{$row['author']}</td>
					  <td>{$row['information']}</td>
					  <td>{$row['isbn']}</td>
					  <input type = 'hidden' name = 'isbn' value ='{$row['isbn']}'>
					  <td> <input type = 'submit' value = 'like'></td>
					  </form>
				 </tr>"
			 );
		  }
	  }
	  mysqli_close($conn);
	  ?>
    </table>
<?php } else {  ?>
<div class = "back">
	<table class = "tds" width="800" border = "1" cellpadding="10">
		<tr align = "center">
		 <th>Seminar ID</th> 
		 <th>세미나명</th>
		 <th>날짜</th>
		 <th>장소</th>
         <th>신청 가능 인원</th>
         <th>현재 신청 인원</th>
		 <th>세미나 신청</th>
		 <?php
		 if ($result) {
			 while($row = mysqli_fetch_array($result)){
			   echo(
				   "<tr>
					  <form action='./enroll.php' method = 'post'>
					  <td>{$row['book_seminar_id']}</td>
					  <td>{$row['name']}</td>
					  <td>{$row['date']}</td>
					  <td>{$row['place']}</td>
					  <td>{$row['maximum_num']}</td>
					  <td>{$row['enroll_num']}</td>
					  <input type='hidden' name = 'book_seminar_id' value='{$row['book_seminar_id']}'>
					  <td> <input type = 'submit' value = 'enroll'></td>
				  </form>
				   </tr>"
				   );

			 }
		 }
         mysqli_close($conn);
		 ?>
      
    </table>
</div>
<?php } ?>
</body>
</html>