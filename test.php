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
				?>


<!DOCTYPE html>
<html lang="en">
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
	<button id="start_ajax">서버와 통신시작</button>

		<script>
	$("#start_ajax").click(function(){
    $.ajax({
            
						type : "GET",
						url : "ajax.js",
						dataType : "text",
						error : function(){
								alert('통신실패!!');
						},
						success : function(data){
								alert("통신데이터 값 : " + data) ;
								$("#dataArea").html(data) ;
						}
				});
		});
		</script>
		<script>
			var positions = [];
			var i = 1;
			<?php $i = 1; ?>
			for(i = 1; i <= <?php echo $row ?>; i++){
				<?php
					$set = "set @rownum = 0;";
					mysqli_query($dbcon,$set);
					$sql = "select R.* from (select @rownum:=@rownum+1 as row, A.* from restaurants A where (@rownum:=0)=0) R where row = ".$i.";";
					
					$result = mysqli_query($dbcon,$sql);
					$rows = mysqli_fetch_assoc($result);
					$i++;
				?>
				console.log(<?php echo $i ?>);
				var marker =  {
						index: i,
            title: '<?php echo $rows["restaurantName"] ?>',
            latlng: new kakao.maps.LatLng(<?php echo $rows['location'] ?>),
            content: '<div class="overlaybox">' +
            '    <div class="boxtitle"><?php echo $rows["restaurantName"]?></div>' +
            '    <div class="first">' +
            '        <div class="triangle"></div>' +
            '        <div class="categori"><?php echo $rows["categori"]?></div>' +
            '    </div>' +
            '    <div class="instaId"><?php echo $rows["instaId"]?></div>' +
            '    <ul class="information">' +
            '        <li class="address">' +
            '            <div class="addr">주소</div>' +
            '            <div class="addr1"><?php echo $rows["addr1"]?></div>' +
            '            <div class="addr2"><?php echo $rows["addr2"]?></div>' +
            '        </li>' +
            '        <li class="review">' +
            '            <div class="review1">한줄평</div>' +
            '            <div class="review2"><?php echo $rows["review"]?></div>' +
            '        </li>' +
            '    </ul>' +
            '</div>'
          };


				positions.push(marker);
				console.log(positions);
			}
		</script>
	</body>

</html>