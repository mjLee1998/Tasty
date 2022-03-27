

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>
		<script>
			var positions = [];
			</script>
</body>

</html>
<?php

session_start();
include"./inc/dbcon.php";

$sql = "select * from restaurants;";

$result = mysqli_query($dbcon,$sql);
$row = mysqli_num_rows($result);
echo $row;
echo "<br>";


$set = "set @rownum = 0;";
mysqli_query($dbcon,$set);
$result = mysqli_query($dbcon,$sql);
echo "<br>";
for($i = 1; $i <= $row; $i=$i+1){
	$sql = "select R.* from (select @rownum:=@rownum+1 as row, A.* from restaurants A where (@rownum:=0)=0) R where row = $i;";
	// echo $sql;
	$result = mysqli_query($dbcon,$sql);
	$rows = mysqli_fetch_assoc($result);
	echo "<br>";
	echo $i;

	echo "<br>";
	echo "{index: 1, title: '올래곱창', latlng: new kakao.maps.LatLng($row['location'] ?>), content: '<div class=".
		"overlaybox".
		">' + '<div class=".
		"boxtitle".
		">$row[".
		"restaurantName".
		"]?></div>' +'    <div class=".
		"first".
		">' + '<div class=".
		"triangle".
		"></div>' +'<div class=".
		"categori".
		">$row[".
		"categori".
		"]?></div>' +'    </div>' +'    <div class=".
		"instaId".
		">$row[".
		"instaId".
		"]?></div>' +'    <ul class=".
		"information".
		">' +'        <li class=".
		"address".
		">' +'            <div class=".
		"addr".
		">주소</div>' +'            <div class=".
		"addr1".
		">$row[".
		"addr1".
		"]?></div>' +'            <div class=".
		"addr2".
		">$row[".
		"addr2".
		"]?></div>' +'        </li>' +'        <li class=".
		"review".
		">' +'            <div class=".
		"review1".
		">한줄평</div>' +'            <div class=".
		"review2".
		">$row[".
		"review".
		"]?></div>' +'        </li>' +'    </ul>' +'</div>'}";
}
	?>