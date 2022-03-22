<?php
include"./inc/dbcon.php";

$sql = "select * from restaurants;";
echo $sql;

$result = mysqli_query($dbcon,$sql);
$row = mysqli_num_rows($result);
echo "<br>";
echo $row;

$sql = "select R.* from (select @rownum:=@rownum+1 as row, A.* from restaurants A where (@rownum:=0)=0) R where row = 2;";
echo "<br>";
echo $sql;

$set = "set @rownum = 0;";
mysqli_query($dbcon,$set);
$result = mysqli_query($dbcon,$sql);
$row = mysqli_fetch_assoc($result);
echo "<br>";
echo $row["addr1"];


?>


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
	</script>
</body>
</html>