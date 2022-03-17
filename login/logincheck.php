<?php
session_start();

$u_id = $_POST["u_id"];
$pwd = $_POST["pwd"];
$rem_id = $_POST["rem_id"];
$auto_login = $_POST["auto_login"];

echo "아이디: ".$u_id."<br>";
echo "비밀번호: ".$pwd."<br>";

include"../inc/dbcon.php";

$sql = "select idx, u_name, u_id, pwd from members where u_id='$u_id';";

$result = mysqli_query($dbcon,$sql);
$num = mysqli_num_rows($result);


if(!$num){
	echo "
	<script type=\"text/javascript\">
		alert(\"일치하는 아이디가 없습니다.\");
		history.back();
	</script>
	";
	exit;
} else {
	$array = mysqli_fetch_array($result);
	// $g_idx = $array["idx"];
	// $g_u_name = $array["u_name"];
	// $g_u_id = $array["u_id"];
	$g_pwd = $array["pwd"];
	if($pwd != $g_pwd){
		echo "
	<script type=\"text/javascript\">
		alert(\"비밀번호가 일치하지 않습니다.\");
		history.back();
	</script>
	";
	exit;
	} else {
		$_SESSION["s_idx"] = $array["idx"];
		$_SESSION["s_name"] = $array["u_name"];
		$_SESSION["s_id"] = $array["u_id"];
		mysqli_close($dbcon);
		echo "
		<script type=\"text/javascript\">
			location.href = \"../index.php\";
		</script>
		";
		};
};

exit;

?>

<!-- <script type="text/javascript">
	function frem_id(){
		document.write("아이디 저장: ");
		if("<?php echo $rem_id;?>" != "on"){
			document.write("off")
		} else {
			document.write("on")
		}
	};
</script>
<script>
	function fauto_login(){
		document.write("자동 로그인: ")
		if("<?php echo $auto_login;?>" != "on"){
			document.write("off")
		} else {
			document.write("on")
		}
	};
	frem_id();
	fauto_login();
</script> -->