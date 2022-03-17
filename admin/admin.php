<?php

include "inc/admin_session.php"
// session_start();

// $s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
// $s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
// echo "session ID : ".$s_id."/ name : ".$s_name;

// if(!$s_id || !$s_id != "admin") {
// echo "
// <script type=\"text/javascript\">
// 	alert(\"관리자 로그인이 필요합니다.\");
// 	location.href=\"../index.php\"
// </script>
// ";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css"> 
		body{font-size:16px}
		a{text-decoration:none; color:blue;}
		a:hover{color:green;}
	</style>
	<script type="text/javascript">

	</script>
</head>
<body>
	<h2>*관리자*</h2>
	<p>관리자 문서입니다.</p>
	<p>"<?php echo $s_name; ?>"님, 안녕하세요.</p>
	<p>
				<a href="/website/admin/admin.php">홈으로</a>
				<!-- <a href="../board/board_list.php">게시판 관리</a> -->
				<a href="#none">게시판 관리</a>
				<a href="members/list.php">회원 관리</a>
				<a href="../login/logout.php">로그아웃</a>
			</p>
</body>
</html>