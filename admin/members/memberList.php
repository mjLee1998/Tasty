<?php

include "../inc/admin_session.php";
include "../inc/dbcon.php";

$sql = "select * from members;";
$result = mysqli_query($dbcon,$sql);

// $array = mysqli_fetch_array($result);

// paging: 전체 데이터 수
$num = mysqli_num_rows($result);
// echo $num;

// paging: 한 페이지 당 데이터 개수
$list_num = 5;

// 한 블럭 당 페이지 수
$page_num = 3;

// 현재 페이지
$page = isset($_GET["page"])? $_GET["page"] : 1;

//전체 페이지 수 = 전체 데이터 / 페이지 당 데이터 개수, ceil : 올림값, floor : 내림값, round : 반올림
$total_page = ceil($num / $list_num);

// paging : 전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수
$total_block = ceil($total_page / $page_num);

// paging : 현재 블럭 번호 = ceil(헌재 페이지 / 블러당 페이지)
$now_block = ceil($page / $page_num);

// paging : 블럭 당 시작 페이지 번호 = (해당 글의 블럭 번호 - 1)* 블럭 당 페이지 수 + 1
$s_pageNum = ($now_block - 1) * $page_num + 1;
// 데이터가 0개인 경우
if($s_pageNum <=0){
	$s_pageNum = 1;
};


// paging : 블럭 당 마지막 페이지 번호 = 해당 글의 블럭 번호 * 블럭 당 페이지 수
$e_pageNum = $now_block * $page_num;
// 마지막 번호가 전체 페이지 수를 넘지 않도록
if($e_pageNum > $total_page){
	$e_pageNum = $total_page;
};



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원 목록</title>
		<link rel="stylesheet" href="../../style/memberList.css">
    <script type="text/javascript">
			function del_check(idx){
            var i = confirm("정말 삭제하시겠습니까? 삭제한 아이디는 사용하실 수 없습니다.");
            if(i == true){
              location.href = "delete.php?u_idx="+idx;
            }; 
        };
    </script>
</head>
<body>
<header>
      <div class="header">
        <div class="logo">
          <h1 class="tasty"><a href="../../index.php" style="color:#38a69b; margin-bottom:10px;">Tasty</a></h1>
        </div>
        <div class="menu">
        <ul>
            <p id="hello">
              <?php echo $s_name; ?>님 &nbsp어서오세요
              <li class="logout"><a href="../../login/logout.php">로그아웃</a></li>
              <li class="members"><a href="../../members/members.php">멤버</a></li>
              <!-- <li><a href="members/edit.php">정보수정</a></li> -->
              <?php if($s_id == "admin"){ ?>
              <li class="admin"><a href="../admin.php">관리자</a></li>
              <?php }; ?>
              <li class="intro"><a href="../../intro.php">소개</a></li>
            </p>
          </ul>
        </div>
      </div>
    </header>
<h2>멤버 관리</h2>
	<p>
	</p>
	<hr>
	<p>총 <?php echo $num; ?>명</p>
	<table border = "1">
		<tr>
			<td>번호</td>
			<td>이름</td>
			<td>아이디</td>
			<td>생년월일</td>
			<td>주소</td>
			<td>이메일</td>
			<td>전화번호</td>
			<td>가입일</td>
			<td>instaId</td>
			<td>수정</td>
			<td>삭제</td>
		</tr>
		<?php
		// $i = 1;
		// 	while($array = mysqli_fetch_array($result)){
		// paging : 시작번호 = (현재 페이지 번호 - 1) * 페이지 당 데이터 수 (데이터베이스 기준이라 +1 안함)
		$start = ($page-1) * $list_num;

		// paging : 쿼리 작성
		$sql = "select * from members limit $start, $list_num";

		// paging: 쿼리 전송
		$result = mysqli_query($dbcon, $sql);

		//paging : 글 번호
		$cnt = $start + 1;

		// paging : 회원 정보 가져오기
		while($array = mysqli_fetch_array($result)){
			?>


		<tr>
			<td><?php echo $cnt; ?></td>
			<td><?php echo $array["u_name"]; ?></td>
			<td><?php echo $array["u_id"]; ?></td>
			<td><?php echo $array["birth"]; ?></td>
			<td><?php echo $array["postalCode"]." ".$array["addr1"]." ".$array["addr2"]; ?></td>
			<td><?php echo $array["email"]; ?></td>
			<td><?php echo $array["mobile"]; ?></td>
			<td><?php echo $array["reg_date"]; ?></td>
			<td><?php echo $array["instaId"]; ?></td>
			<td><a href="memberEdit.php?u_idx=<?php echo $array["idx"]; ?>">수정</a></td>
			<td><a href="#" onclick="del_check(<?php echo $array["idx"]; ?>)">삭제</a></td>
		</tr>
		<?php 
			$cnt++;
			};
		?>
	</table>
	<p class="pager">
		<?php

		//paging : 이전 블럭
		if($page <= 1){ ?>
			<!-- <a href="list.php?page=<?php echo $page = 1; ?>">이전</a> -->
		<?php } else { ?>
			<a href="memberList.php?page=<?php echo ($page-1); ?>">이전</a>
		<?php
		};
		?>
		



		
		<?php
		// pager: 페이지 번호
		for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){ ?>
		<a href="memberList.php?page=<?php echo $print_page;?>"><?php echo $print_page; ?></a>
		<?php
		};
		?>

		<?php
	if($page >= $total_page){ ?>
			<!-- <a href="list.php?page=<?php echo $total_page; ?>">다음</a> -->
		<?php } else { ?>
			<a href="memberList.php?page=<?php echo ($page+1); ?>">다음</a>
		<?php
		};
		?>
	</p>
</body>
</html>