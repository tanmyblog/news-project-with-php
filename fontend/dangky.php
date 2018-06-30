<?php include("quangcao.php"); 

if(!empty($_POST["register-user"])) {
	$ngaydk = date("Y-m-d h:i:s",time());
	/* Yêu cầu Xác thực Trường Bắt buộc */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
			$error_message = "Tất cả các trường không được bỏ trống";	break;
		}
	}
	/* Kiểm tra user có tồn tại không */
	if(!isset($error_message)) {
		if(mysqli_num_rows(mysqli_query($conn, "SELECT Username FROM users WHERE Username= '" .$_POST["uname"]. "' ")) > 0){ 
			$error_message = 'Tên tài khoản đã tồn tại<br>'; 
		}
	}
	/* Xác nhân mật khẩu nhập lại có khớp hay không */
	if(!isset($error_message)) {
		if($_POST['password'] != $_POST['re-password']){ 
			$error_message = 'Mật khẩu không khớp<br>'; 
		}
	}
	/* Kiểm tra email có hợp lệ không */
	if(!isset($error_message)) {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error_message = "Email không hợp lệ";
		}
	}
	/* Kiểm tra email có tồn tại hay không */
	if(!isset($error_message)) {
		if (mysqli_num_rows(mysqli_query($conn, "SELECT Email FROM users WHERE Email= '" .$_POST["email"]. "' ")) >0 ) {
			$error_message = "Email đã tồn tại";
		}
	}
	/* Kiểm tra chọn giới tính được chọn chưa */
	if(!isset($error_message)) {
		if(!isset($_POST["gioitinh"])) {
			$error_message = "Vui lòng chọn giới tính của bạn";
		}
	}
	/* Kiểm tra ngày sinh có hợp lệ không */
	if(!isset($error_message)) {
		if (!ereg("^[0-9]+/[0-9]+/[0-9]{2,4}", $_POST['ngaysinh']))
    	{
            $error_message = 'Ngày tháng năm sinh không hợp lệ';
        }
	}

	/* Kiểm tra xem các Điều khoản và Điều kiện được chấp nhận */
	if(!isset($error_message)) {
		if(!isset($_POST["terms"])) {
			$error_message = "Hãy đồng ý";
		}
	}
	if(!isset($error_message)) {
		if($_POST['gioitinh'] == 1) { $gt=1; } elseif ($_POST['gioitinh'] == 2) {$gt=2; } elseif ($_POST['gioitinh'] == 3) {$gt=0; }
		$ngaysinh = date("Y-m-d", $_POST['ngaysinh']);
		$query = "insert into users values(NULL, '{$_POST['hoten']}', '{$_POST['uname']}', '" . md5($_POST["password"]) . "', '{$_POST['diachi']}', '{$_POST['dienthoai']}', '{$_POST['email']}', '{$ngaydk}', 0, '{$ngaysinh}', '{$gt}', '', 1)";

		$result = mysqli_query($conn, $query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "Bạn đã đăng ký thành công!";	
			unset($_POST);
		} else {
			$error_message = "Xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại!";	
		}
	}
} ?>

<div id="dangky">
<form name="frmRegistration" method="post" action="">
	<table border="0" width="500" align="center" class="demo-table">

		<?php if(!empty($success_message)) { ?>	
			<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
		<?php } ?>

		<?php if(!empty($error_message)) { ?>	
			<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
		<?php } ?>

		<tr>
			<td>Tài Khoản</td>
			<td><input type="text" class="demoInputBox" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>"></td>
		</tr>
		
		<tr>
			<td>Họ Tên</td>
			<td><input type="text" class="demoInputBox" name="hoten" value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']; ?>"></td>
		</tr>

		<tr>
			<td>Mật Khẩu</td>
			<td><input type="password" class="demoInputBox" name="password" value=""></td>
		</tr>

		<tr>
			<td>Nhập Lại Mật Khẩu</td>
			<td><input type="password" class="demoInputBox" name="re-password" value=""></td>
		</tr>
		
		<tr>
			<td>Email</td>
			<td><input type="text" class="inputbox" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></td>
		</tr>
		
		<tr>
			<td>Địa Chỉ</td>
			<td><input type="text" class="inputbox" name="diachi" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']; ?>"></td>
		</tr>

		<tr>
			<td>Điện Thoại</td>
			<td><input type="text" class="inputbox" name="dienthoai" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']; ?>"></td>
		</tr>

		<tr>
			<td>Ngày Sinh</td>
			<td><input type="text" class="inputbox" name="ngaysinh" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']; ?>"></td>
		</tr>

		<tr>
			<td>Giới Tính</td>
			<td>
				<input type="checkbox" name="gioitinh" value="1" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh']=="1") { ?>checked<?php  } ?>> Nam
				<input type="checkbox" name="gioitinh" value="3" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh']=="3") { ?>checked<?php  } ?>> Nữ
				<input type="checkbox" name="gioitinh" value="2" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh']=="2") { ?>checked<?php  } ?>> Khác
			</td>
		</tr>

		<tr>
			<td colspan=2>
				<input type="checkbox" name="terms">I accept Terms and Conditions
				<input type="submit" name="register-user" value="Register" class="btnRegister">
			</td>
		</tr>
		
	</table>
</form>
</div>

</div>