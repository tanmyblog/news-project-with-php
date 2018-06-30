<?php
	// mysqli_connect ("host","username","password","database name");
	$conn = mysqli_connect("localhost","root","","tintuc") or die("Không thể kết nối đến Host");
	mysqli_set_charset($conn, "utf8");
?>