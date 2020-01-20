<?php
include("./dbconn.php");
?>

<html>
<head>
   <title>Login</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="javascript/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <!-- 로그인 세션이 있을 경우 로그인 화면 -->
<?php if(!isset($_SESSION['ss_user_id'])){ ?> 

   <form action="./login_check.php" method="post">
   <nav class = "navbar navbar-light bg-light">
   <a class = "navbar-brand">노을책방</a>
   <form class = "form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="ID" aria-label="ID">
      <input class="form-control mr-sm-2" type="search" placeholder="PASSWORD" aria-label="PASSWORD">
       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">login</button>
       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">register</button>
     </form>
   </nav>
   </form>

   <!-- 로그인 세션이 없을 경우 로그인 완료 화면 -->
<?php } else {?>
   <?php
   $user_id = $_SESSION['ss_user_id'];

   $sql = " select * from member where user_id = TRIM('$user_id') ";
   $result = mysqli_query($conn, $sql);
   $user = mysqli_fetch_assoc($result);

   mysqli_close($conn);
   ?>

   <nav class = "navbar navbar-light bg-light">
   <a class = "navbar-brand">노을책방</a>
   <form class = "form-inline">
      <a class = "nav-item" href ="#"><?php echo $user['user_id'] ?></a>
     </form>
   </nav>

<?php } ?>

</body>
</html>
