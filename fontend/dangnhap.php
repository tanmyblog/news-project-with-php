<?php  ob_start(); include("quangcao.php"); 

	$error=""; // khoi tao bien loi
	if(isset($_POST['login'])) {
		if(empty($_POST['uname']) || empty($_POST['psw'])){
			$error = "Tài khoản hoặc mật khẩu trống";
		} else {
			$uname = $_POST['uname'];
			$psw = md5($_POST['psw']);

			$uname	= mysqli_real_escape_string($conn, $uname);
			$psw	= mysqli_real_escape_string($conn, $psw);

			$query = mysqli_query($conn, "select * from users where Username='$uname' and Password='$psw' ");
			$row = mysqli_fetch_array($query);

			$count = mysqli_num_rows($query);
			if($count > 0) {
				$_SESSION['HoTen'] = $row['HoTen'];
				$_SESSION['Username'] = $row['Username'];
				$_SESSION['idUser'] = $row['idUser'];
				$_SESSION['idGroup'] = $row['idGroup'];
				$_SESSION['urlHinh'] = $row['urlHinh'];
				
				header("location:index.php");
			} else {
				$error = "Tài khoản hoặc mật khẩu sai";
			}
		}
	}
?>

<div id="dangky">
	<div id="id01" >
		<form class="login-form" action="" method="post">
			<div class="login-wrapper">
				<label><b>Tài Khoản</b></label>
				<input type="text" placeholder="Nhập Tài Khoản" name="uname" required>

				<label><b>Mật Khẩu</b></label>
				<input type="password" placeholder="Nhập Mật Khẩu" name="psw" required>

				<button type="submit" name="login">Đăng nhập</button>
				<span style="text-align: center; color: red"><?php echo $error; ?></span>
			</div>
		</form>
	</div>
</div>

</div>