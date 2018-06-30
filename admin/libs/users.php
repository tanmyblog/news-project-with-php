<div class="container">
	<table>
		<thead>
			<tr>
				<th>UserID</th>
				<th>Họ Tên</th>
				<th>Username</th>
				<th>Điện Thoại</th>
				<th>Email</th>
				<th>Ngày Đăng Ký</th>
				<th>Quyền</th>
				<th>Tùy Chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = mysqli_query($conn, "SELECT * FROM users ");
				while($row = mysqli_fetch_array($query)) {
			?>
			<tr>
				<th style="text-align: center"><?php echo $row['idUser']; ?></th>
				<td><?php echo $row['HoTen']; ?></td>
				<td><?php echo $row['Username']; ?></td>
				<td><?php echo $row['Dienthoai']; ?></td>
				<td><?php echo $row['Email']; ?></td>
				<td><?php echo date("d-m-Y", strtotime($row['NgayDangKy'])); ?></td>
				<td><?php
					if($row['idGroup'] == 1){
						echo "Admin";
					} else {echo "Thành Viên";}
				?></td>
				<td>
					<a href="index.php?k=us&idUser=<?php echo $row['idUser']; ?>">Cập Nhật</a>
					<a href="libs/process.php?idUser=<?php echo $row['idUser']; ?>" onclick="return confirm('Bạn có chắc muốn xóa user này chứ')">Xóa</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>