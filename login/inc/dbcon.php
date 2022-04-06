<?php
$dbcon = mysqli_connect("localhost", "root", "", "tasty")
or die("접속에 실패했습니다.");
mysqli_set_charset($dbcon,"utf8");
?>