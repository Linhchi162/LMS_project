<?php
  $mysqli = new mysqli("localhost","root","10012004","project_dbms");

  // Check connection
  if ($mysqli->connect_error) {
      die("Kết nối cơ sở dữ liệu thất bại: " . $mysqli->connect_error);
  }
?>