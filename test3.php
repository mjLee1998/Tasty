<?php
				
				include"./inc/dbcon.php";
				
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
			//마커를 담을 배열
			var positions = [];

			//num_rows()의 수만큼 각 행의 정보를 가져와서 마커에 정보를 담기
				<?php
					$query = "select R.* from restaurants R";
					
					$result = mysqli_query($dbcon,$query);
					while($row = mysqli_fetch_assoc($result)){

						$test[] = $row; 
						echo 'var positions = ' . json_encode($test) . ';';
					};
					

			?>
			
			
			var markers = [];
			for(i = 0; i < positions.length; i++){
				var loc = positions[i].location;
				var [lat, lng] = loc.split(',');
				lat = Number(lat);
				lng = Number(lng);
				
				var marker = {
					index : positions[i].idx,
					title : positions[i].restaurantName,
					latlng : new kakao.maps.LatLng(lat, lng),
				content : '<div class="overlaybox">' +
				'    <div class="boxtitle">'+positions[i].restaurantName+'</div>' +
				'    <div class="first">' +
				'        <div class="triangle"></div>' +
				'        <div class="categori">'+positions[i].categori+'</div>' +
				'    </div>' +
				'    <div class="instaId">'+positions[i].instaId+'</div>' +
				'    <ul class="information">' +
				'        <li class="address">' +
				'            <div class="addr">주소</div>' +
				'            <div class="addr1">'+positions[i].addr1+'</div>' +
				'            <div class="addr2">'+positions[i].addr2+'</div>' +
				'        </li>' +
				'        <li class="review">' +
				'            <div class="review1">한줄평</div>' +
				'            <div class="review2">'+positions[i].review+'</div>' +
				'        </li>' +
				'    </ul>' +
				'</div>'
			};
				markers.push(marker);
			}
			console.log(markers);
		</script>
	</body>

</html>