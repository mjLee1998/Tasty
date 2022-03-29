<?php
$j = 2;
for($i = 0; $i < 4; $i++){
	echo $j;
	$j++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<script>
		<?php $o = 0 ?>
		for(i = 0; i < 3; i++){
			console.log(<?php echo $o ?>);
			<?php $o = $o+1; ?>
			console.log(<?php echo $o ?>);
		};
		console.log(<?php echo $o ?>);
	</script>
		<?php
			echo $o;
			$o = $o+1;
			echo $o;
			$o = $o+1;
			echo $o;
			$o = $o+1;
			echo $o;
		?>
</body>
</html>