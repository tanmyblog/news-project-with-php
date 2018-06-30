<?php
	if(isset($_GET['idTL']))
		$idTL=$_GET['idTL'];

	$sql=mysqli_query($conn, "SELECT * FROM theloai WHERE idTL={$idTL}");
	while($row=mysqli_fetch_array($sql)){
?>
	<form name="form1" method="post" action="libs/process.php">

		<p>
			<label for="TenTL">Tên Thể Loại</label><br />
			<input type="text" name="TenTL" id="TenTL" value="<?php echo $row['TenTL']; ?>" required/>
		</p>
		<p>
			<label for="TenTL_KhongDau">Tên Không Dấu</label><br />
			<input type="text" name="TenTL_KhongDau" id="TenTL_KhongDau" value="<?php echo $row['TenTL_KhongDau']; ?>" required/>
		</p>
		<p>
			<label for="ThuTu">Thứ Tự</label><br />
			<input type="text" name="ThuTu" id="ThuTu" value="<?php echo $row['ThuTu']; ?>" required/>
		</p>
		<p>
			<label for="AnHien">Trạng Thái</label>
			<select name="AnHien" id="AnHien" >
				<option value="1" >Hiện</option>
				<option value="0" <?php if($row['AnHien'] == 0) echo "selected='selected'";?>>Ẩn</option>
			</select>
		</p>

		<p>
			<input type="hidden" name="idTL" value="<?php echo $idTL; ?>"/>
			<input type="submit" name="suaTL" id="them" value="Cập Nhật" />
		</p>

	</form>
<?php } ?>