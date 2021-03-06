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
	<link rel="stylesheet" href="style/howToUse.css">
</head>
<body>
<header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty"><a href="index.php" style="color:#38a69b; margin-bottom:10px;">Tasty</a></h1>
        </div>
        <div class="menu">
        <ul>
            <?php if (!$s_id) { ?>
            <li class="login"><a href="login/login.php">로그인</a></li>
            <li class="join"><a href="members/join.php">회원가입</a></li>
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
    <main>
			<article>
				<h5>Tasty 이용 방법</h5>
				Tasty는 맛집 공유 사이트입니다.<br><br>
        카테고리나 식당 이름을 이용하여 검색해보세요.<br><br>
        식당 이름이 겹치거나 잘못 입력하는 경우가 많아 정확한 주소를 검색해서 입력해주세요.<br><br>
				마커를 누르면 등록한 사람과 식당의 주소, 간단한 한줄평을 볼 수 있습니다.<br><br>
				메인 페이지로 가서 직접 식당 등록을 해보세요!!!<br><br>
				잘못 등록된 식당이 있다던가 문제가 있을 시, 인스타그램 @thing_lmj 로 DM주세요.
			</article>
    </main>
    <footer>
      
    </footer>
</body>
</html>