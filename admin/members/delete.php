<?php

$u_idx = $_GET['u_idx'];

include '../inc/dbcon.php';

$sql = "delete from members where idx = $u_idx;";
echo $sql;

mysqli_query($dbcon, $sql);

mysqli_close($dbcon);

echo "
<script type =\"text/javascript\">
alert(\"정상처리 되었습니다.\");
location.href = \"memberList.php\";
</script>
";
?>
