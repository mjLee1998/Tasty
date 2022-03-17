<?php

$u_id = $_POST["input_id"];
// echo $u_id;

include"../inc/dbcon.php";

$sql = "select u_id from members where u_id='$u_id';";

$result = mysqli_query($dbcon,$sql);

// mysqli_fetch_row
// $row = mysqli_fetch_row($result);
// echo $row[0];

// mysqli_retch_array
// $array = mysqli_fetch_array($result);
// echo $array["u_name"];

// mysqli_num_rows 
// echo mysqli_num_rows($result);
$num = mysqli_num_rows($result);
$num;

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>검색 결과</title>
	<style>
		.bld{font-size:14px; font-weight:bold;}
		a:hover{color:green;}
		.able{color:blue;}
		.disable{color:red;}
	</style>
	<?php if(!$num){ ?>
	<script type="text/javascript">
			function return_id(){
				opener.document.getElementById("u_id").value = "<?php echo $u_id;?>";
				window.close();
			}
	</script>
	<?php	} ?>
</head>
<body>
	<p>
		입력하신 <span class="bld">"<?php echo $u_id;?>"</span> 은 사용할 수
		<!-- <?php
			if(!$num){
				echo "<span class=\"able\">있는</span>";
			} else {
				echo "<span class=\"disable\">없는</span>";
			}
		?> 아이디입니다. -->
		<?php if(!$num){ ?>
			<span class="able">있는</span> 아이디입니다.
			<br><br>
			<a href="#" onclick="return_id()">[사용하기]</a>
			<?php	} else { ?>
				<span class="disable">없는</span> 아이디입니다.
				<br><br>
				<?php	} ?>
		
		<a href="#" onclick="history.back()">[다시 검색]</a>
	</p>
</body>
</html>