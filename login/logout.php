<?php

session_start();


unset($_SESSION["s_idx"]);
unset($_SESSION["s_name"]);
unset($_SESSION["s_id"]);

echo "
<script type=\"text/javascript\">
	alert(\"로그아웃 되었습니다.\");
	history.back();
	</script>
;"

?>