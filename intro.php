<?php

session_start();

$s_id = isset($_SESSION['s_id']) ? $_SESSION['s_id'] : '';
$s_name = isset($_SESSION['s_name']) ? $_SESSION['s_name'] : '';

// echo "session ID : ".$s_id."/ name : ".$s_name;
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
	<link rel="stylesheet" href="style/intro.css">
</head>
<body>
<header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty"><a href="index.php">Tasty</a></h1>
        </div>
        <div class="menu">
        <ul>
            <?php if (!$s_id) { ?>
            <li class="login"><a href="./login/login.php">로그인</a></li>
            <li class="join"><a href="./members/join.php">회원가입</a></li>
            <?php } else { ?>
            <p id="hello">
              <?php echo $s_name; ?>님 &nbsp어서오세요
              <li class="logout"><a href="login/logout.php">로그아웃</a></li>
              <li class="members"><a href="members/members.php">멤버</a></li>
              <!-- <li><a href="members/edit.php">정보수정</a></li> -->
              <?php if ($s_id == 'admin') { ?>
              <li class="admin"><a href="admin/admin.php">관리자</a></li>
              <?php } ?>
              <?php } ?>
              <li class="intro"><a href="intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>
    <main style="width:300px; margin-left:30px; margin-bottom:50px; margin-top:50px;">
      <div class="introduce" style="margin-bottom:50px;">
        <h5 style="color:rgb(61, 63, 74)">페이지 소개</h5>
        <h6 style="color:rgb(61, 63, 74)">
          Tasty는 친구나 지인들과 맛집을 <br>공유하는 사이트입니다.<br><br> 메인 페이지로 이동하셔서 사용해보시고<br> 회원가입하셔서 직접 식당을 등록해보세요.
        </h6>
      </div>
      <div class="creater">
        <h5 style="color:rgb(61, 63, 74)">제작자</h5>
        <h6 style="color:rgb(61, 63, 74)">
          기획 : 이명진, 강유상<br>
          제작 : 이명진
        </h6>
      </div>
    </main>
    <footer style="width:300px; margin-left:30px;">
      <div class="url">
        <h6>
        <a href="https://github.com/mjLee1998" style="color:#38a69b;">https://github.com/mjLee1998</a>
        <a href="https://velog.io/@audwls172" style="color:#38a69b;">https://velog.io/@audwls172</a>
        </h6>
      </div>
    </footer>
</body>
</html>