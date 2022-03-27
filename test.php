

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
?>
for($i = 1; $i <= $row; $i++){
	$sql = "select R.* from (select @rownum:=@rownum+1 as row, A.* from restaurants A where (@rownum:=0)=0) R where row = $i;";
	// echo $sql;
	$result = mysqli_query($dbcon,$sql);
	$row = mysqli_fetch_assoc($result);
	echo "<br>";
	echo $row['restaurantName'];
	echo "<br>";
}