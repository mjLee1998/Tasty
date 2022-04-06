<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>아이디 중복 검색</title>
	<style type=text/css>
		span{color:#f00}
	</style>
	<script type=text/javascript>
		function check_id (){
			var input_id = document.getElementById("input_id");

			if(input_id.value == ""){
				var err_txt = document.querySelector(".err_id");
				err_txt.textContent = "아이디를 입력하세요."
				input_id.focus();
				return false;
			}
			var uid_len = input_id.value.length;
			if (uid_len < 4 || uid_len > 12){
				var err_txt = document.querySelector(".err_id");
				err_txt.textContent = "아이디는 4~12글자만 입력할 수 있습니다."
				input_id.focus();
				return false;
			}
		}
	</script>
</head>
<body>
	<form action="resultId.php" name="seachId_form" method="post" onsubmit="return check_id()">
		<fieldset>
			<legend>아이디 입력</legend>
			<p>
				<label for="">아이디</label>
				<input type="text" name="input_id" id="input_id" autofocus>
				<button type="submit">검색</button><br>
				<span class="err_id"></span>
			</p>
			
		</fieldset>
	</form>
</body>
</html>