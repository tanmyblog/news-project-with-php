<div class="container">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Tên Thể Loại</th>
				<th>Tên Không Dấu</th>
				<th>Trạng Thái</th>
				<th><a href="index.php?k=tlt">Thêm Thể Loại</a></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				$query = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
				while($row = mysqli_fetch_array($query)){
			?>
			<tr>
				<td><?php echo $row['idTL']; ?></td>
				<td><?php echo $row['TenTL']; ?></td>
				<td><?php echo $row['TenTL_KhongDau']; ?></td>
				<td><?php if($row['AnHien']) echo "Hiện"; else echo "Ẩn"; ?></td>
				<td>
					<a href="index.php?k=tls&idTL=<?php echo $row['idTL']; ?>">Cập Nhật</a>
					<a href="libs/process.php?idTL=<?php echo $row['idTL']; ?>" onclick="return confirm('Bạn có chắc xóa thể loại này chứ')">Xóa</a>
				</td>
			</tr>
			<?php } ?>

		</tbody>
	</table>
</div>