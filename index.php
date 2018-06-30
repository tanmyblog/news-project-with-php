<?php session_start(); ob_start(); include("config/connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>News</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div id="container">

		<div id="header"></div> <!-- Header Banner Top -->

		<?php include("fontend/menu.php");

		if(!isset($_GET['k'])){
			include("fontend/tinnoibat.php");
			include("fontend/tinxemnhieu.php");
			include("fontend/main1_3.php");
			include("fontend/quangcao.php");
			include("fontend/tinmoi.php");
		} else {
			switch ($_GET['k']) {
				case  "lt": include("fontend/loaitin.php"); 	break;
				case "ctt": include("fontend/chitiettin.php"); 	break;
				case  "dk":	include("fontend/dangky.php");		break;
				case  "dn":	include("fontend/dangnhap.php");	break;
			}
		}
		?>

			<div id="main2_2">
				<?php
					include("fontend/account.php");
					include("fontend/timkiem.php");
					include("fontend/binhchon.php");
					include("fontend/ads.php");
				?>
			</div><!-- End Main2_2 -->

		</div> <!-- End Main 2-->

		<?php include("fontend/footer.php"); ?>

	</div> <!-- End Container-->

	<!-- script binh chon -->
	<script language="javascript">
		function xemkq(){
			x=window.open('','','status=yes,menubar=no');
			x.location='fontend/ketquabinhchon.php';
			x.resizeTo(500,250);
		}
	</script>

</body>
</html>
