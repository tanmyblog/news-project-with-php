<form action="" method="get" name="form1">
	<p>
		<label for="theloai">Thể Loại</label>
		<select name="idTL" id="idTL" onchange="form1.submit()">
			<?php
				$query = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
				$i = 1;
				while($row = mysqli_fetch_array($query)) {
					if($i == 1) {
						$idTL = $row['idTL']; $i = 0;
					}
			?>
				<option value="<?php echo $row['idTL']; ?>" <?php
					if(isset($_GET['idTL']) && $_GET['idTL'] == $row['idTL']){
						echo "selected='selected'";
						$idTL = $_GET['idTL'];
					}
				?>><?php echo $row['TenTL']; ?></option>
			<?php } ?>
		</select>
		<input type="hidden" name="k" id="k" value="tt" />
	</p>
</form>

<form action="libs/process.php" method="post" enctype="multipart/form-data" name="form2">
	<p>
		<label for="loaitin">Loại Tin</label>
		<select name="idLT" id="idLT">
			<?php
				$idLT = 0;
				$query_lt = mysqli_query($conn, "SELECT * FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu");
				while($row_lt = mysqli_fetch_array($query_lt)){
					if($idLT == 0){
						$idLT = $row_lt['idLT'];
					}
			?>
				<option value="<?php echo $row_lt['idLT']; ?>" <?php
					if(isset($_GET['idLT']) && $_GET['idLT'] == $row_lt['idLT']) {
						echo "selected='selected'";
						$idLT = $_GET['idLT'];
					}
				?>><?php echo $row_lt['Ten']; ?></option>
			<?php } ?>
		</select>
	</p>

	<p>
		<label for="TieuDe">Tiêu Đề</label> <br />
		<input type="text" name="TieuDe" id="TieuDe" required />
	</p>

	<p>
		<label for="TieuDe_KhongDau">Tiêu Đề Không Dấu</label> <br />
		<input type="text" name="TieuDe_KhongDau" id="TieuDe_KhongDau" required />
	</p>

	<p>
		<label for="TomTat">Tóm Tắt</label> <br />
		<textarea name="TomTat" id="TomTat" cols="138" rows="4"></textarea>
	</p>

	<p>
		<label for="ChonAnh">Chọn Ảnh</label>
		<input type="file" name="uf" id="uf" />
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	</p>

	<p>
		<label for="NoiDung">Nội Dung</label>
		<textarea name="Content" id="Content"></textarea>
		<script>CKEDITOR.replace('Content');</script>
	</p>

	<p>
		<label for="AnHien">Trạng Thái</label>
		<select name="AnHien" id="AnHien">
			<option value="1">Hiện</option>
			<option value="0">Ẩn</option>
		</select>

		&nbsp;

		<input type="checkbox" name="TinNoiBat" id="TinNoiBat">
		<label for="TinNoiBat">Tin Nổi Bật</label>
	</p>

	<p>
		<input type="hidden" name="idTL" id="idTL" value="<?php echo $idTL; ?>" />
		<input type="hidden" name="idLT" id="idLT" value="<?php echo $idLT; ?>" />
		<input type="submit" name="themtin" id="themtin" value="Thêm" />
	</p>
</form>