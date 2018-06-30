<form name="form1" method="post" action="libs/process.php">
	<p>
		<label for="TenTL">Tên Thể Loại</label><br />
		<input type="text" name="TenTL" id="TenTL" required/>
	</p>
	<p>
		<label for="TenTL_KhongDau">Tên Không Dấu</label><br />
		<input type="text" name="TenTL_KhongDau" id="TenTL_KhongDau" required/>
	</p>
	<p>
		<label for="ThuTu">Thứ Tự</label><br />
		<input type="text" name="ThuTu" id="ThuTu" required/>
	</p>
	<p>
		<label for="AnHien">Trạng Thái</label>
		<select name="AnHien" id="AnHien">
			<option value="1">Hiện</option>
			<option value="0">Ẩn</option>
		</select>
	</p>
	
	<p>
		<input type="submit" name="themTL" id="them" value="Thêm" />
		<input type="reset" name="reset" id="reset" value="reset" />
	</p>
	
</form>
