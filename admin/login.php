<?php session_start(); ob_start(); include("libs/connect.php");

	$error=""; // Khởi tạo biến chứa lỗi
	if (isset($_POST['login'])) {
		if (empty($_POST['uname']) || empty($_POST['psw']))
		{
			$error = "Username hoặc Password trống";
		}
		else
		{
			// Gán username và password sang biến
			$username=$_POST['uname'];
			$password=md5($_POST['psw']);

			// Bảo mật csdl khỏi injection
			$username = stripslashes($username); /* Loại bỏ các dấu /\ */
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($conn, $username); /* loại bỏ các dấu '' */
			$password = mysqli_real_escape_string($conn, $password);

			$query = mysqli_query($conn, "select * from users where Password='$password' and Username='$username'");
			$row = mysqli_fetch_array($query);

			$rows = mysqli_num_rows($query);

			/* Nếu tồn tại username thì bất đầu đăng nhập và tạo session chuyển sang trang index.php */
			if ($rows > 0)
			{
				$_SESSION['hoten'] = $row['HoTen'];
				$_SESSION['id'] = $row['idUser'];
				$_SESSION['capdo'] = $row['idGroup'];

				header("location: index.php");
			}
			else
			{
				$error = "Username hoặc Password không đúng";
			}

		}
	}

if(isset($_SESSION['hoten'])) header("location:index.php");
?>
<!DOCTYPE html>
<html>
	<title>Đăng nhập hệ thống CMS</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
	<style>
		* {font-family: "Saira", Sans-serif}
		body{background: #d5dae5; }

		/* CSS Form */
		.login-wrapper {padding: 16px;}
		.login-form {
			background: #fefefe;
			border: 1px solid #888; /* viền của form */
			margin: 5% auto;
			width: 30%; /* ĐỘ Rộng Của Form */
		}

		/* CSS text box */
		input[type=text], input[type=password] {
		    width: 100%;
		    padding: 12px 20px; /* tăng thêm độ rộng cho top-bottm và left-right */
		    margin: 8px 0; /* khoản cách top-bottm và left-right */
		    display: inline-block;
		    border: 1px solid #ccc;
		    box-sizing: border-box;
		}

		/* CSS button */
		button {
		    background-color: #4CAF50; /* Màu nền nút đăng nhập */
		    color: #fff;
		    padding: 10px 20px; /* tăng thêm độ rộng cho top-bottm và left-right */
		    margin: 8px 0;	/* khoản cách top-bottm và left-right */
		    border: none;
		    cursor: pointer;
		    width: 100%;
		    font-size: 14px;
		}

		button:hover {
		    opacity: 0.9;
		}

	</style>
<body>

<div class="login-wrapper">

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
	
</body>
</html>