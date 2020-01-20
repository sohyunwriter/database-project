<?php
include("./dbconn.php");

$user_id = $_SESSION['ss_user_id'];
$isbn = trim($_POST['isbn']);
?>
<html>
<head>
	<title>Manager Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 	<script src="javascript/script.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<h1>Manager Page</h1>

<h2>신규 세미나 등록</h2>

<form action="./admin_enroll.php" onsubmit="return fregisterform_submit(this);" method="post">
	<input type = 'hidden' name = 'isbn' value = "<?php echo $isbn?>">
	<table>
		<tr>
			<th>세미나 이름</th>
			<td><input type="text" name="seminar_name"></td>			
		</tr>
		<tr>
			<th>날짜</th>
			<td><input type = "text" name = "date"></td>
		</tr>
		<tr>
			<th>장소</th>
			<td><input type = "text" name = "place"></td>
		</tr>
		<tr>
			<th>최대 인원</th>
			<td><input type = "text" name = "maximum_num"></td>
		</tr>
		<tr>
			<th>세부 내용</th>
			<td><input type = "text" name = "information"></td>
		</tr>
		<tr>
			<th>isbn</th>
			<td><?php echo $isbn?></td>			
		</tr>
		<tr>
			<td colspan="2" class ="td_center"><input type ="submit" value="등록"><a href="./admin_booksearch.php">취소</a></td>
	</table>
</form>

<script>
	function fregisterform_submit(f) {
		if(f.seminar_name.value.length < 1 || f.date.value.length < 1|| f.place.value.length < 1 || f.maximum_num.value.length < 1 ){
			alert("fill all the blanks");
			return false;
		}

		return true;
	}
</script>

</body>
</html>