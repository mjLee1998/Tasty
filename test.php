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
				
					$result = mysqli_query($dbcon,$sql);
					$rows = mysqli_fetch_assoc($result);
					echo "<br>";
					echo $i;
					echo "<br>";
					echo "<br>";
				}
				
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
			var positions = [];
			var i;
			for(i = 1; i <= <?php echo $row ?>; i++){
				<?php
					$sql = "select R.* from (select @rownum:=@rownum+1 as row, A.* from restaurants A where (@rownum:=0)=0) R where row = $i;";
				
					$result = mysqli_query($dbcon,$sql);
					$rows = mysqli_fetch_assoc($result);
					echo "console.log($i)";
				?>
			}

		</script>
	</body>

</html>