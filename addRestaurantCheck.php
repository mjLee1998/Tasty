<?php
session_start();

$postcode = $_POST["postcode"];
$addr1 = $_POST["address"];
$addr2 = $_POST["detailAddress"];
$addr3 = $_POST["extraAddress"];
$restaurantName = $_POST["restaurantName"];
$instaId = $_POST["instaId"];
$categori = $_POST["categori"];
$review = $_POST["review"];
$location = $_POST["location"];
// addr1과 addr3을 한개로 통합
$addr1 = $addr1.$addr3;


echo "우편번호: ".$postcode."<br>";
echo "주소: ".$addr1."<br>";
echo "상세주소: ".$addr2."<br>";
echo "식당 이름: ".$restaurantName."<br>";
echo "Instagram ID: ".$instaId."<br>";
echo "카테고리: ".$categori."<br>";
echo "리뷰: ".$review."<br>";
echo "좌표: ".$location."<br>";

include"inc/dbcon.php";

$sql = "insert into restaurants(restaurantName, categori, instaId, addr1,addr2, review, location) values ('$restaurantName', '$categori', '$instaId', '$addr1', '$addr2','$review', '$location');";

echo $sql;

// mysqli_query($dbcon,$sql);

mysqli_close($dbcon);

echo "
<script type=\"text/javascript\">
	location.href=\"https://localhost/tasty/complete.php\"
</script>
";
?>