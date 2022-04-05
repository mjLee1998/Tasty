<?php

include 'inc/admin_session.php'; ?>

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
	<link rel="stylesheet" href="../style/admin.css">
</head>
<body>
<header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty"><a href="../index.php" style="color:#38a69b; margin-bottom:10px;">Tasty</a></h1>
        </div>
        <div class="menu">
        <ul>
            <p id="hello">
              <?php echo $s_name; ?>님 &nbsp어서오세요
              <li class="logout"><a href="../login/logout.php">로그아웃</a></li>
              <li class="members"><a href="../members/members.php">멤버</a></li>
              <!-- <li><a href="members/edit.php">정보수정</a></li> -->
              <?php if ($s_id == 'admin') { ?>
              <!-- <li class="admin"><a href="admin/admin.php">관리자</a></li> -->
              <?php } ?>
              <li class="intro"><a href="../intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>
		<main>
			<h4>관리자</h4>
			<p>
				<a href="members/memberList.php">멤버 관리</a>
				<a href="restaurantsList.php">식당 관리</a>
			</p>
		</main>
	</body>
</html>