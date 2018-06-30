<?php session_start(); ob_start();
	include("../config/connect.php");

	/* Xu ly dang xuat */
	if(isset($_POST['logout']))
	{
		unset($_SESSION['HoTen']);
		unset($_SESSION['Username']);
		unset($_SESSION['idUser']);
		unset($_SESSION['idGroup']);
		unset($_SESSION['urlHinh']);
		header("location:".$_SERVER['HTTP_REFERER']);
	}

	/* Xy ly comment */
	if(isset($_POST['sm_comment'])){
		$ngay=date("Y-m-d h:i:s",time());
		$sl="INSERT INTO bandocykien VALUES(NULL, {$_POST['idTin']}, '$ngay', '{$_POST['noidung']}', {$_POST['idUser']})";
		if(mysqli_query($conn, $sl))
		{
			header("location:".$_SERVER['HTTP_REFERER']);
		}	else echo $sl;
	}

	/* Xu ly binh chon */
	if(isset($_GET['idPA']) && $_GET['idPA']!='')
	{
		$idPA=$_GET['idPA'];
		$query="UPDATE phuongan SET SoLanChon = SoLanChon+1 WHERE idPA=$idPA";

		if(mysqli_query($conn, $query))
		{
			echo "<script language='javascript'>";
			echo "x=window.open('','','status=yes,menubar=no');";
			echo "x.location='ketquabinhchon.php';";
			echo "x.resizeTo(500,250);";
			echo "location.href='".$_SERVER['HTTP_REFERER']."';";
	    echo "</script>";
		}
	}
	else
	{
		echo "<script language='javascript'>";
		echo "alert('Bạn chưa chọn phương án');";
		echo "location.href='".$_SERVER['HTTP_REFERER']."';";
		echo "</script>";
	}
?>
