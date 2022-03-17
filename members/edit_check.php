<?php

session_start();
$s_idx = $_SESSION["s_idx"];
echo $s_idx;

$pwd = $_POST["pwd"];
$birth = $_POST["birth"];
$repwd = $_POST["repwd"];
$mobile = $_POST["mobile"];
$email = $_POST["email_id"]."@".$_POST["email_dns"];
$postalCode = $_POST["postalCode"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];

echo "비밀번호 : ".$pwd."<br>";
echo "생년월일 : ".$birth."<br>";
echo "우편번호 : ".$postalCode."<br>";
echo "기본주소 : ".$addr1."<br>";
echo "상세주소 : ".$addr2."<br>";
echo "이메일 : ".$email."<br>";
echo "전화번호 : ".$mobile."<br>";

// $dbcon = mysqli_connect("localhost", "root", "", "front") or die("접속에 실패했습니다.");
// mysqli_set_charset($dbcon,"utf8");


include "../inc/dbcon.php";

// $sql = "insert into members(u_name, u_id, pwd, birth, postalCode, addr1, addr2, email, mobile, reg_date) values ('$u_name', '$u_id', '$pwd', '$birth', '$postalCode', '$addr1', '$addr2', '$email', '$mobile', '$reg_date');";
if(!$pwd){
	$sql = "update members set birth = '$birth', postalCode = '$postalCode', addr1 = '$addr1', addr2 = '$addr2', email = '$email', mobile = '$mobile' where idx = $s_idx;";
} else {
	$sql = "update members set pwd = '$pwd', birth = '$birth', postalCode = '$postalCode', addr1 = '$addr1', addr2 = '$addr2', email = '$email', mobile = '$mobile' where idx = $s_idx;";
}
echo $sql;

mysqli_query($dbcon,$sql);

mysqli_close($dbcon);

// header('location: https://localhost/website/members/welcome.php');

echo "
<script type=\"text/javascript\">
	alert(\"정보가 수정되었습니다.\");
	location.href=\"https://localhost/website/members/edit.php\"
</script>
";

// <script type="text/javascript">
// 	location.href="https://localhost/website/members/welcome.php"
// </script>

	?>