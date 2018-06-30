<script type="text/javascript" src="ckeditor/ckeditor.js" ></script>

<form name="form1" method="get" action="">
	<p>
		<label for="theloai">Thể loại</label>
		<select name="idTL" id="idTL" onChange="form1.submit()">
			<?php
			include('../connect.php');
			$query = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
			$i=1;
			while($row = mysqli_fetch_array($query)){
				if($i==1){
					$idTL=$row['idTL'];
					$i=0;
				}
			?>
			<option value="<?php echo $row['idTL'];?>" <?php
				if(isset($_GET['idTL']) && $_GET['idTL'] == $row['idTL']){
					echo "selected='selected'";
					$idTL=$_GET['idTL'];
				} ?>><?php echo $row['TenTL'];?></option>
			<?php }?>
		</select>
		<input type="hidden" name="k" id="k" value="tt"/> <!-- Giữ lại giá trị cho trang chủ khi submit form -->
	</p>
</form>
<form name="form2" method="post" enctype="multipart/form-data" action="libs/process.php">
	<p>
		<label for="loaitin">Loại Tin</label>
		<select name="idLT" id="idLT" >
			<?php    
			$idLT=0;    /* gán idLT = 0 và kiểm tra nếu từ thể loại trên chưa có idLT=0 thì k có kq in ra, chứ k báo lỗi */
			$query_lt = mysqli_query($conn, "SELECT * FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu");
			while($row_lt = mysqli_fetch_array($query_lt)){
				if($idLT==0){
					$idLT = $dlt['idLT'];
				}
			?>
			<option value="<?php echo $row_lt['idLT']; ?>" <?php
				if(isset($_GET['idLT']) && $_GET['idLT'] == $row_lt['idLT']){
					echo " selected='selected'";
					$idLT=$_GET['idLT'];
				} ?>><?php echo $row_lt['Ten']; ?>
			</option>
			<?php } ?>
		</select>
	</p>

	<p>
		<label>Tiêu Đề</label>
		<input type="text" name="TieuDe" id="TieuDe" required>
	</p>

	<p>
		<label>Tiêu Đề Không Dấu </label>
		<input type="text" name="TieuDe_KhongDau" id="TieuDe_KhongDau" required>
	</p>
	<p>
		<label for="TomTat">Tóm Tắt</label>
		<textarea name="TomTat" id="TomTat" cols="138" rows="4"></textarea>
	</p>

	<p>
		<label for="uf">Chọn Ảnh </label>
		<input type="file" name="uf" id="uf" />
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
	</p>

	<p>
		<label>Nội Dung</label>
		<textarea name="Content" id="Content"></textarea>
		<script>CKEDITOR.replace('Content');</script> 
	</p>
	<p>
		<label for="AnHien">Trạng Thái</label>
		<select name="AnHien" id="AnHien">
			<option value="0">Ẩn</option>
		</select>
		&nbsp;
		<label for="TinNoiBat">Nổi Bật</label>
		<select name="TinNoiBat" id="TinNoiBat">
			<option value="1">Nổi Bật</option>
			<option value="0">Không</option>
		</select>
	</p>

	<p>
		<input type="hidden" name="idTL" value="<?php echo $idTL;?>" />
		<input type="hidden" name="idLT" value="<?php echo $idLT;?>" />
		<input type="submit" name="themtin" id="themtin" value="Thêm" />
	</p>

</form>