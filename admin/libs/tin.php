<form action="" method="get" name="form1">
	<p>
		<label for="theloai">Thể Loại</label>
		<select name="idTL" id="idTL" onchange="form1.submit()">
			<?php
				$query = mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
				$i = 1;
				while($row = mysqli_fetch_array($query)){
					if($i==1) {
						$idTL = $row['idTL']; $i=0;
					}
			?>
				<option value="<?php echo $row['idTL']; ?>" <?php if(isset($_GET['idTL']) && $_GET['idTL']==$row['idTL']){
					echo "selected='selected'";
					$idTL = $_GET['idTL'];
				} ?>><?php echo $row['TenTL']; ?></option>
			<?php } ?>
		</select>
		<input type="hidden" name="k" id="k" value="t">
	&nbsp;&nbsp;&nbsp;

	<label for="loaitin">Loại Tin</label>
	<select name="idLT" id="idLT" onchange="form1.submit()">
		<?php
			$idLT = 0;
			$query_lt = mysqli_query($conn, "SELECT * FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu");
			while($row_lt = mysqli_fetch_array($query_lt)){
				if($idLT==0){ $idLT = $row_lt['idLT']; }
		?>
			<option value="<?php echo $row_lt['idLT']; ?>" <?php if(isset($_GET['idLT']) && $_GET['idLT']==$row_lt['idLT']){
				echo "selected='selected'";
				$idLT = $_GET['idLT'];
			} ?>><?php echo $row_lt['Ten']; ?></option>
		<?php } ?>
	</select>
	</p>
</form>

<div class="container">
	<table>
		<thead>
			<tr>
				<th width="350">Tin</th>
				<th>Nổi Bật</th>
				<th>Lần Xem</th>
				<th>Trạng Thái</th>
				<th>Ngày Viết</th>
				<th><a href="index.php?k=tt&idTL=<?php echo $idTL; ?>&idLT=<?php echo $idLT; ?>">Thêm Tin</a></th>
			</tr>
		</thead>

		<tbody>
			<?php
				$query_t = mysqli_query($conn, "SELECT * FROM tin WHERE idLT=$idLT ORDER BY idTin DESC");
				while($row_t = mysqli_fetch_array($query_t)){
			?>
			<tr>
				<td width="350">
					<img src="../<?php echo $row_t['urlHinh']; ?>" width="50" height="50" alt="" style="float: left; margin-right: 5px;" />
					<a href="index.php?k=ts&idTL=<?php echo $idTL; ?>&idLT=<?php echo $idLT; ?>&idTin=<?php echo $row_t['idTin']; ?>"><?php echo $row_t['TieuDe']; ?></a>
				</td>
				<td><?php if($row_t['TinNoiBat']) echo "Nổi Bật"; else echo "Không"; ?></td>
				<td><?php echo $row_t['SoLanXem']; ?></td>
				<td><?php if($row_t['AnHien']) echo "Hiện"; else echo "Ẩn"; ?></td>
				<td><?php echo date("d-m-Y", strtotime($row_t['Ngay'])); ?></td>
				<td>
					<a href="index.php?k=ts&idTL=<?php echo $idTL; ?>&idLT=<?php echo $idLT; ?>&idTin=<?php echo $row_t['idTin']; ?>">Cập Nhật</a>
					<a href="libs/process.php?idTin=<?php echo $row_t['idTin']; ?>" onclick="return confirm('Bạn có chắc muốn xóa tin này chứ')">Xóa</a>
				</th>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>