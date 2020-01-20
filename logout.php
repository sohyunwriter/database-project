<?php
session_start();
session_unset();
session_destroy(); // 세션해제함

if(!isset($_SESSION['ss_user_id'])){
   echo "<script>alert('logout succeed');</script>";
   echo "<script>location.replace('./noeulbook.php');</script>";
   exit;
}
?>