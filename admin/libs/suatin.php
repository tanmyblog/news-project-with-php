<?php if(isset($_GET['idTin'])) { $idTin = $_GET['idTin'];

	$query = mysqli_query($conn, "SELECT * FROM tin WHERE idTin=$idTin");
	$row = mysqli_fetch_array($query);
?>
<form action="" method="get" name="form1">
	<p>
		<label for="theloai">Thể Loại</label>
		<select name="idTL" id="idTL" onchange="form1.submit()">
		<?php 
			$query_tl = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
			$idTL = 0;
			while($row_tl = mysqli_fetch_array($query_tl)) {
				if($idTL == 0){
					$idTL = $row_tl['idTL'];
				}
		?>
			<option value="<?php echo $row_tl['idTL']; ?>" <?php
				if(isset($_GET['idTL']) && $_GET['idTL'] == $row_tl['idTL']) {
					echo "selected='selected'";
					$idTL = $_GET['idTL'];
				}
			?>><?php echo $row_tl['TenTL']; ?></option>
		<?php } ?>
		</select>
		<input type="hidden" name="k" id="k" value="ts" />
	</p>
</form>
<form action="libs/process.php" method="post" enctype="multipart/form-data" name="form2" id="form2">
	<p>
		<label for="loaitin">Loại Tin</label>
		<select name="idLT" id="idLT">
		<?php
			$query_lt = mysqli_query($conn, "SELECT * FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu");
			while($row_lt = mysqli_fetch_array($query_lt)){
		?>
			<option value="<?php echo $row_lt['idLT']; ?>" <?php
				if(isset($_GET['idLT']) && $_GET['idLT'] == $row_lt['idLT']){
					echo "selected='selected'";
					$idLT = $_GET['idLT'];
				}
			?>><?php echo $row_lt['Ten']; ?></option>
		</select>
		<?php } ?>
	</p>

	<p>
		<label for="TieuDe">Tiêu Đề</label> <br />
		<input type="text" name="TieuDe" id="TieuDe" value="<?php echo $row['TieuDe']; ?>" />
	</p>

	<p>
		<label for="TieuDe_KhongDau">Tiêu Đề Không Dấu</label> <br />
		<input type="text" name="TieuDe_KhongDau" id="TieuDe_KhongDau" value="<?php echo $row['TieuDe_KhongDau']; ?>">
	</p>

	<p>
		<label for="TomTat">Tóm Tắt</label> <br />
		<textarea name="TomTat" id="TomTat" cols="138" rows="4"><?php echo $row['TomTat']; ?></textarea>
	</p>

	<p>
		<label for="ChonAnh">Chọn Ảnh</label>
		<input type="file" name="ufile" id="ufile"> <img src="../<?php echo $row['urlHinh']; ?>" width="100" alt="">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
	</p>

	<p>
		<label for="NoiDung">Nội Dung</label>
		<textarea name="Content" id="Content"><?php echo $row['Content']; ?></textarea>
		<script>CKEDITOR.replace('Content');</script>
	</p>

	<p>
		<label for="AnHien">Trạng Thái</label>
		<select name="AnHien" id="AnHien">
			<option value="0">Ẩn</option>
			<option value="1" <?php if($row['AnHien']) echo "selected='selected'";  ?>>Hiện</option>
		</select>

		&nbsp;&nbsp;&nbsp;

		<input type="checkbox" name="TinNoiBat" id="TinNoiBat" <?php echo "checked='checked'"; ?> ?>
		<label for="TinNoiBat">Tin Nổi Bật</label>
	</p>

	<p>
		<input type="hidden" name="idTL" value="<?php echo $idTL;?>"/>
	    <input type="hidden" name="idTin" value="<?php echo $row['idTin'];?>"/>
	    <input type="submit" name="suatin" id="suatin" value="Cập Nhật" />
	</p>
</form>

<?php } ?>