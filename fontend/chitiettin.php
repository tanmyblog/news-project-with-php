<?php include("quangcao.php");?>
<div class="chitiettin">
	<?php if(isset($_GET['idTin'])) $idTin = $_GET['idTin'];

	$sql = mysqli_query($conn, "UPDATE `tin` SET `SoLanXem`=SoLanXem+1 WHERE idTin={$idTin} ");

	$query = mysqli_query($conn, "select * from tin where idTin=$idTin");
	$row = mysqli_fetch_array($query); ?>
	<div class="tieude" ><h1><?php echo $row['TieuDe']; ?></h1></div>
	<div class="ngay"><?php echo date("d-m-Y",strtotime($row['Ngay']));?></div>
	<div class="content"><?php echo $row['Content']; ?></div>
	<div class="tinlienquan">
		<h2>Bài viết liên quan</h2>
		<ul>
			<?php
			$query= mysqli_query($conn, "select * from tin where idTin < $idTin and idLT={$row['idLT']} and AnHien=1 order by idTin DESC limit 0,5");
			while($row = mysqli_fetch_array($query)) { ?>
			<li><a href="index.php?k=ctt&idTin=<?php echo $row['idTin']; ?>"><?php echo $row['TieuDe']; ?></a></li>
			<?php } ?>
		</ul>
	</div> <!-- Bài liên quan -->

	<div class="binhluantin">
		<h2>Bình luận tin</h2>
		<?php
		if(!isset($_SESSION['idUser'])){
			echo "Bạn cần đăng nhật mới có thể bình luận";
		} else { ?>
		<div class="form-comment">
			<form action="fontend/xuly.php" method="post">
				<textarea name="noidung" id="noidung_cm" rows="3" placeholder="Nhận xét của bạn... "></textarea><br />
				<input type="hidden" name="idTin" value="<?php echo $idTin; ?>" />
				<input type="hidden" name="idUser" value="<?php echo $_SESSION['idUser'] ?>">
				<input type="submit" name="sm_comment" value="Gửi" />
				<input type="reset" name=
				"xoa" value="Xóa" />
			</form>
		</div> <!-- End comment form -->
		<?php } ?>

		<div class="list-comment">
			<?php $query_cm = mysqli_query($conn, "select * from bandocykien where idTin=$idTin");
			$count = mysqli_num_rows($query_cm);
			if($count == 0) {
				echo "<div class='comment_null'>Bài viết chưa có bình luận nào</div>";
			} else {
				while($d=mysqli_fetch_array($query_cm)){

					$query_us = mysqli_query($conn, "select * from users where idUser={$d['idUser']}");
					$row_us = mysqli_fetch_array($query_us);
			?>

					<div class="conment">
						<p class="thongtin">
							<font style='font-weight: bold; color: blue'><?php echo $row_us['HoTen']; ?></font> - <?php echo date('d-m-Y', strtotime($d['Ngay'])); ?><br />
							<?php echo $d['NoiDung']; ?>
						</p>
					</div>

					<?php } } ?>
				</div> <!-- End list-comment -->

			</div> <!-- Bình luận tin -->

		</div>

	</div>