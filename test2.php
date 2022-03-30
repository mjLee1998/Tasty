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
			
			$query = "select R.* from restaurants R";
			$statement = $pdo->prepare($query);
			$statement->execute();
			
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			var_dump($result);
			
			echo 'var positions = ' . json_encode($result) . ';';
			?>
			positions.forEach(pos => console.log(pos));
		</script>
	</body>

</html>