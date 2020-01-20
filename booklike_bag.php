<?php
include("./dbconn.php");
?>

<?php
   $table = "book_like";
   $table1 = "book";
?>

<!DOCTYPE html>
<html>
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
<head>
   <title>Book Like List</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="javascript/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="./noeulbook.php">
        <img src="./books.png" width="30" height="30" class="d-inline-block align-top" alt=""> 노을책방</a>

        <div class = "navbar-item justify-content-end">
          <?php
        $user_id = $_SESSION['ss_user_id'];

        $sql = " select * from user where user_id = TRIM('$user_id') ";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

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

<div class = "back">
<h1>My Favorite Book List</h1>

<?php
$page_title = "Book Like Bag";

$user_id = $_SESSION['ss_user_id'];
$sql = "SELECT B.* from $table A 
    INNER JOIN $table1 B on A.isbn = B.isbn 
    where A.user_id = TRIM('$user_id') ";

$result = mysqli_query($conn, $sql);

?>
   <table class = "tds" width="800" border = "1" cellpadding="10">
      <tr align = "center">
         <th>책 이름</th>
         <th>저자</th>
         <th>책 정보</th>
         <th>isbn</th>
      </tr>
      <?php
      while($row = mysqli_fetch_array($result)){
         echo(
             "<tr>
                  <td>{$row['book_name']}</td>
                  <td>{$row['author']}</td>
                  <td>{$row['information']}</td>
                  <td>{$row['isbn']}</td>
             </tr>"
         );
      }
    mysqli_close($conn);
    ?>
    </table>

</div>
</body>
</html>