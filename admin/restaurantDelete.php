<?php

$idx = $_GET["idx"];
include "../inc/dbcon.php";

$sql = "delete from restaurants where idx = $idx;";
echo $sql;

mysqli_query($dbcon,$sql);

mysqli_close($dbcon);

// echo "
// <script type =\"text/javascript\">
// alert(\"정상처리 되었습니다.\");
// location.href = \"restaurantslist.php\";
// </script>
// "
?>