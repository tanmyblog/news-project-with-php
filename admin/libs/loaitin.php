<form action="" method="get" name="form1">
	<p>
		<label for="theloai">Thể Loại</label>
		<select name="idTL" id="idTL" onchange="form1.submit()">
			<?php
				$query = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
				$i = 1;
				while($row = mysqli_fetch_array($query)){
					if($i==1){
						$idTL = $row['idTL'];
						$i=0;
					}
			?>
				<option value="<?php echo $row['idTL']; ?>" <?php if(isset($_GET['idTL'])&&$_GET['idTL']==$row['idTL']){
					echo "selected='selected'";
					$idTL = $_GET['idTL'];
				} ?>><?php echo $row['TenTL']; ?></option>
			<?php } ?>
		</select>
		<input type="hidden" name="k" id="k" value="lt" />
	</p>
</form>

<div class="container">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Tên Loại Tin</th>
				<th>Tên Không Dấu</th>
				<th>Trạng Thái</th>
				<th><a href="index.php?k=ltt&idTL=<?php echo $idTL; ?>">Thêm Loại Tin</a></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = mysqli_query($conn, "SELECT * FROM loaitin WHERE idTL={$idTL} ORDER BY ThuTu");
				while($row = mysqli_fetch_array($query)){
			?>
			<tr>
				<td><?php echo $row['idLT']; ?></td>
				<td><?php echo $row['Ten']; ?></td>
				<td><?php echo $row['Ten_KhongDau']; ?></td>
				<td><?php if($row['AnHien']) echo "Hiện"; else echo "Ẩn"; ?></td>
				<td>
					<a href="index.php?k=lts&idLT=<?php echo $row['idLT']; ?>">Cập Nhật</a>
					<a href="libs/process.php&idLT=<?php echo $row['idLT']; ?>" onclick="return confirm('Bạn có chắc xóa loại tin này chứ?')">Xóa</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>