<?php
				
				session_start();
				include"./inc/dbcon.php";
				
				$sql = "select * from restaurants;";
				
				$result = mysqli_query($dbcon,$sql);
				$row = mysqli_num_rows($result);
				
				
				$set = "set @rownum = 0;";
				mysqli_query($dbcon,$set);
				$result = mysqli_query($dbcon,$sql);

				mysqli_close($dbcon);
				?>


<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<script
		type="text/javascript"
		src="//dapi.kakao.com/v2/maps/sdk.js?appkey=26fdf226a690f77f33e7a8f67ee40ac1"
		></script>
		<script src="jquery-3.6.0.min.js"></script>
	</head>
	<body>

		<script>
			var positions = [1,2,4];
		<?php
			$dsn = "mysql:host = localhost; dbname = tasty; charset = UTF8";
			$pdo = new PDO($dsn, "root", "");
			if($pdo){
				echo "console.log('연결 성공');";
			};
			
			$statement = $pdo->prepare("select R.* from restaurants R LIMIT :kkk");
			$statement -> bindValue('kkk',$row,PDO::PARAM_INT);
			
			$statement->execute();
			$rows = $statement->fetchAll();
			echo 'var postitions = ' . json_encode($rows) . ';';
			?>
			positions.forEach(pos => console.log(pos));
		</script>
	</body>

</html>