<p>Chào mừng <b><?php echo $_SESSION['hoten']; ?></b> đến với trang quản trị</p>

<form method="post" action="libs/process.php">
	
	<input type="submit" name="logout" id="logout" value="Logout">

</form>

<div class="choduyet">
	<p style="text-align: center;"><i>Bài viết của bạn đang chờ Admin duyệt</i></p>
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
			$slt=mysqli_query($conn, "select * from tin where AnHien=0 and idUser={$_SESSION['id']} order by idTin DESC ");
			while($rows=mysqli_fetch_array($slt)){
		?>
			<tr id="<?php echo $rows["idTin"]; ?>">
				<td width="300">
					<img src="../<?php echo $rows['urlHinh']; ?>" alt="" width="50" height="50" style="float: left; margin-right: 5px;">
					<a href="index.php?k=ts&lang=<?php echo $lang; ?>&idTin=<?php echo $rows['idTin']; ?>"><?php echo $rows['TieuDe']; ?></a>
					<p><i><?php echo $rows['TieuDe_KhongDau']; ?></i></p>
				</td>
				<td><?php echo $rows['SoLanXem']; ?></td>
				<td><?php if($rows['TinNoiBat']) echo "Nổi Bật"; else echo "Không"; ?></td>
				<td><?php if($rows['AnHien']) echo "Đã duyệt"; else echo "Chưa duyệt"; ?></td>
				<td><?php echo date("d-m-Y",strtotime($rows['Ngay']));?></td>
				<td><a href="index.php?k=tsc&idTin=<?php echo $rows['idTin']; ?>" class="text a">Sửa</a></td>
			</tr>
	    <?php } ?>
	    </tbody>  
	</table>
</div>