<div id="account">
	<p class="title_account">Tài Khoản</p>
	<?php
		if(isset($_SESSION['Username'])){ ?>
			
			<div class="imgavatar">
			    <img src="<?php echo $_SESSION['urlHinh']; ?>" alt="No Avatar" class="avatar">
			    <p style="color: blue;font-weight: bold"><?php echo $_SESSION['HoTen']; ?></p>
		    	<a href='admin/login.php' target='_blank'>Gửi Tin</a>
			</div>
			<div>
				<form method="post" action="fontend/xuly.php">
					<input type="submit" name="logout" id="logout" value="Đăng xuất">
				</form>
			</div>

	<?php }else{ ?>
	
		<a href="index.php?k=dk" class="btn-sign sign-up">Đăng ký</a>
		<a href="index.php?k=dn" class="btn-sign">Đăng nhập</a>
	
	<?php }	?>

</div>