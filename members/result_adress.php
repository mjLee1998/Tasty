<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>주소 선택</title>
	<script type="text/javascript">
		function return_adress(a, b){
			opener.document.getElementById("postalCode").value = a
			opener.document.getElementById("addr1").value = b
			
			window.close();
		}
	</script>
</head>
<body>
	<p>
		입력하신 <span class="able">"역삼동"</span> 검색 결과입니다.
	</p>
	<hr>
	<p>	
		<a href="#" onclick="return_adress('12345', '서울 강남구 테헤란로 55길 46')">
			12345 서울 강남구 테헤란로 55길 46
		</a>
	</p>
	<p>	
		<a href="#" onclick="return_adress('12346', '서울 강남구 테헤란로 55길 56')">
			12346 서울 강남구 테헤란로 55길 56
		</a>
	</p>
	<p>	
		<a href="#" onclick="return_adress('12347', '서울 강남구 테헤란로 55길 66')">
			12347 서울 강남구 테헤란로 55길 66
		</a>
	</p>
</body>
</html>