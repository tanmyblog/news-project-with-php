	<div id="tinmoi">
	<?php

	// Truy vấn lấy thể loại
		$query = mysqli_query($conn, "select * from theloai where AnHien=1 order by ThuTu");
		while($row = mysqli_fetch_array($query)){
	?>
		<div class="theloai">
			<?php echo $row['TenTL'];

			// Truy vấn lấy loại tin theo thể loại
				$query_lt = mysqli_query($conn, "select * from loaitin where idTL={$row['idTL']} and AnHien=1 order by ThuTu");
				while($row_lt = mysqli_fetch_array($query_lt)){
			?>
			<a href="index.php?k=lt&idTL=<?php echo $row['idTL']; ?>&idLT=<?php echo $row_lt['idLT']; ?>"><?php echo $row_lt['Ten']; ?></a>
			<?php } ?>
		</div>

		<?php

		// Truy vấn lấy tin theo loại tin
			$query_t = mysqli_query($conn, "select * from tin where idLT in (select idLT from loaitin where idTL={$row['idTL']} and AnHien=1) and AnHien=1 order by idTin DESC limit 0,6");
			$row_t = mysqli_fetch_array($query_t);
		?>
		<div class="tinmoinhat">
			<a href="index.php?k=ctt&idTin=<?php echo $row_t['idTin']; ?>"><?php echo $row_t['TieuDe']; ?></a>
			<p><img src="<?php echo $row_t['urlHinh'];?>" width="80" height="80" align="left" /><?php echo $row_t['TomTat']; ?></p>
		</div>

		<!-- tinmoinhat -->
		<div class="tinmoitieptheo">
		<?php
			while($row_t = mysqli_fetch_array($query_t)){
		?>
			<p><a href="index.php?k=ctt&idTin=<?php echo $row_t['idTin']; ?>"><?php echo $row_t['TieuDe']; ?></a></p>
		<?php } ?>
		</div>
	<?php } ?>
	</div>
</div> <!-- End Main2_1 -->