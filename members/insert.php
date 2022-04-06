<?php
$u_name = $_GET['u_name'];
$u_id = $_GET['u_id'];
$pwd = $_GET['pwd'];
$repwd = $_GET['repwd'];
$mobile = $_GET['mobile'];
$email_id = $_GET['email_id'];
$email_dns = $_GET['email_dns'];
$email = $email_id . '@' . $email_dns;
$birth = $_GET['birth'];
$instaId = $_GET['instaId'];
$postalCode = $_GET['postcode'];
$addr1 = $_GET['address'];
$addr2 = $_GET['detailAddress'];
$addr3 = $_GET['extraAddress'];
$agree = $_GET['agree'];
$addr1 = $addr1 . $addr3;

$reg_date = date('Y-m-d');

echo '이름 : ' . $u_name . '<br>';
echo '아이디 : ' . $u_id . '<br>';
echo '비밀번호 : ' . $pwd . '<br>';
echo '비밀번호 확인 : ' . $repwd . '<br>';
echo '전화번호 : ' . $mobile . '<br>';
echo '이메일 : ' . $email_id . '@' . $email_dns . '<br>';
echo '생년월일 : ' . $birth . '<br>';
echo '인스타ID : ' . $instaId . '<br>';
echo '우편번호 : ' . $postalCode . '<br>';
echo '기본주소 : ' . $addr1 . '<br>';
echo '상세주소 : ' . $addr2 . '<br>';
echo '가입일 : ' . $reg_date . '<br>';
echo '동의 :' . $agree . '<br>';

include 'inc/dbcon.php';

$sql = "insert into members(u_name, u_id, pwd, birth, postalCode, addr1, addr2, email, mobile, reg_date, instaId) values ('$u_name', '$u_id', '$pwd', '$birth', '$postalCode', '$addr1', '$addr2', '$email', '$mobile', '$reg_date', '$instaId');";
// $sql = "insert into members(u_name, u_id, pwd, birth, postalCode, addr1, addr2, email, mobile, reg_date) values ('".$u_name."', '".$u_id."', '".$pwd."', '".$birth."', '".$postalCode."', '".$addr1."', '".$addr2."', '".$email."', '".$mobile."', '".$reg_date."');";

echo $sql;

mysqli_query($dbcon, $sql);

mysqli_close($dbcon);

// header('location: https://localhost/website/members/welcome.php');

echo "
<script type=\"text/javascript\">
	location.href=\"welcome.php\"
</script>
";

// <script type="text/javascript">
// 	location.href="https://localhost/website/members/welcome.php"
// </script>

?>
