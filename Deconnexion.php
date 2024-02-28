<?php
  session_start();
  $_SESSION["login"]="false";
  $_SESSION["user_id"]=" ";
  header("location:/");
?>