<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css">
		span{color: red;}
		#u_id{margin-left:13px;}
	</style>
	<script type="text/javascript">
		function login_check(){
			var user_id = document.getElementById("u_id");
			var user_pwd = document.getElementById("u_pwd");

			if(user_id.value == ""){
				var err_txt = document.querySelector(".err_u_id");
				err_txt.innerHTML = "<em>아이디를 입력하세요.</em>"
				u_id.focus();
				return false;
			}
			var u_id_len = u_id.value.length;
			if (u_id_len < 4 || u_id_len > 12){
					var err_txt = document.querySelector(".err_u_id");
					err_txt.textContent = "아이디는 4~12글자만 입력할 수 있습니다."
					u_id.focus();
					return false;
			}
			if(pwd.value == ""){
				var err_txt = document.querySelector(".err_pwd");
				err_txt.innerHTML = "<em>비밀번호를 입력하세요.</em>"
				pwd.focus();
				return false;
			}
			var pwd_len = pwd.value.length;
			if (pwd_len < 4 || pwd_len > 15){
					var err_txt = document.querySelector(".err_pwd");
					err_txt.textContent = "비밀번호는 4~15글자만 입력할 수 있습니다."
					pwd.focus();
					return false;
			}
		}
	</script>
</head>
<body>
	<form name="login_form" action="logincheck.php" method="post" onsubmit="return login_check()">

		<fieldset>
			<legend>로그인</legend>
			<p>
				<label for="u_id">아이디</label>
				<input type="text" name="u_id" id="u_id" autofocus>
				<br>
				<span class="err_u_id"></span>
			</p>
			<p>
				<label for="pwd">비밀번호</label>
				<input type="password" name="pwd" id="pwd">
				<br>
				<span class="err_pwd"></span>
			</p>
			<!-- <p>
				<label for="rem_id">아이디 저장</label>
				<input type="checkbox" name="rem_id" id="rem_id">
				<span class="warn"></span>
				<label for="auto_login">자동 로그인</label>
				<input type="checkbox" name="auto_login" id="auto_login">
			</p> -->
			<p>
				<button type="submit"  id="login">로그인</button>
				<button onclick="history.back()">이전으로</button>
			</p>
		</fieldset>

	</form>
	</body>
	</html>