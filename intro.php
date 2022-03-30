<?php

session_start();

$s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
$s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
// echo "session ID : ".$s_id."/ name : ".$s_name;
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style/default.css">
</head>
<body>
<header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty">Tasty</h1>
        </div>
        <div class="menu">
          <ul>
            <?php
					if(!$s_id){?>
            <li><a href="./login/login.php">로그인</a></li>
            <li><a href="./members/join.php">회원가입</a></li>
            <?php } else { ?>
            <p id="hello">
              <?php echo $s_name; ?>님, 안녕하세요.
              <li><a href="login/logout.php">로그아웃</a></li>
              <li><a href="members/members.php">멤버</a></li>
              <li><a href="members/edit.php">정보수정</a></li>
              <?php if($s_id == "admin"){ ?>
              <li><a href="admin/admin.php">관리자</a></li>
              <?php }; ?>
              <?php }; ?>
              <li><a href="intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>
</body>
</html>