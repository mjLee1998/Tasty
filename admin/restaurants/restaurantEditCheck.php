<?php

session_start();
$idx = $_POST['idx'];
echo $idx;
$restaurantName = $_POST['restaurantName'];
$instaId = $_POST['instaId'];
$categori = $_POST['categori'];
$addr1 = $_POST['address'];
$addr2 = $_POST['detailAddress'];
$addr3 = $_POST['extraAddress'];
$addr1 = $addr1 . $addr3;

echo '식당 이름 : ' . $restaurantName . '<br>';
echo 'Instagram ID : ' . $instaId . '<br>';
echo '카테고리 : ' . $categori . '<br>';
echo '기본주소 : ' . $addr1 . '<br>';
echo '상세주소 : ' . $addr2 . '<br>';

include 'inc/dbcon.php';

$sql = "update restaurants set restaurantName = '$restaurantName', instaId = '$instaId', categori = '$categori', addr1 = '$addr1', addr2 = '$addr2' where idx = $idx;";

echo $sql;

mysqli_query($dbcon, $sql);

mysqli_close($dbcon);

// header('location: https://localhost/website/members/welcome.php');

echo "
<script type=\"text/javascript\">
	alert(\"정보가 수정되었습니다.\");
	location.href=\"https://localhost/tasty/admin/restaurantsList.php\"
</script>
";

// <script type="text/javascript">
// 	location.href="https://localhost/website/members/welcome.php"
// </script>

?>
