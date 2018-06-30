<p>Chào mừng <b><?php echo $_SESSION['hoten']; ?></b> đến với trang quản trị</p>

<form method="post" action="libs/process.php">
	
	<input type="submit" name="logout" id="logout" value="Logout">

</form>

<div class="choduyet">
	<p style="text-align: center;">Bài viết đang chờ bạn duyệt</p>
	<table>
		<thead>
			<tr>
				<th scope="col" width="150" class="text">Tin</th>
				<th scope="col" class="text">Lần Xem</th>
				<th scope="col" class="text">Nổi Bật</th>
				<th scope="col" class="text">Trạng Thái</th>
				<th scope="col" class="text">Ngày Viết</th>
				<th scope="col">Tùy Chọn</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				$slt = mysqli_query($conn, "SELECT * FROM tin WHERE AnHien=0 ORDER BY idTin DESC");
				while($rows = mysqli_fetch_array($slt)){
			?>
			<tr id="<?php echo $rows["idTin"]; ?>">
				<td width="550">
					<img src="../<?php echo $rows['urlHinh']; ?>" alt="" width="50" height="50" style="float: left; margin-right: 5px;">
					<a href="index.php?k=ts&lang=<?php echo $lang; ?>&idTin=<?php echo $rows['idTin']; ?>"><?php echo $rows['TieuDe']; ?></a>
				</td>
				<td><?php echo $rows['SoLanXem']; ?></td>
				<td><?php if($rows['TinNoiBat']) echo "Nổi Bật"; else echo "Không"; ?></td>
				<td><?php if($rows['AnHien']) echo "Hiện"; else echo "Ẩn"; ?></td>
				<td><?php echo date("d-m-Y",strtotime($rows['Ngay']));?></td>
				<td>
					<a href="index.php?k=ts&idTin=<?php echo $rows['idTin']; ?>" class="text a">Xem</a> - 
					<a href="libs/process.php?idTin=<?php echo $rows['idTin']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa tin tức này chứ?')">Xóa</a>
				</td>
			</tr>
			<?php } ?>

		</tbody> 
	</table>
</div>

