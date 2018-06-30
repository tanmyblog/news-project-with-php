<div id="main1">
	<div id="main1_1">
		<div id="tinnoibat">
		<?php
			$query = mysqli_query($conn, "select * from tin where AnHien=1 and TinNoiBat=1 order by idTin DESC limit 0,4");
			$row = mysqli_fetch_array($query);
		?>
			<div id="top1">
				<img src="<?php echo $row['urlHinh'];?>" />
				<p><a href="index.php?k=ctt&idTin=<?php echo $row['idTin']; ?>"><?php echo $row['TieuDe']; ?></a></p>
				<?php echo $row['TomTat']; ?>
			</div> <!-- Tin Đầu Tiên -->

			<div id="top3">
			<?php
				while($row = mysqli_fetch_array($query)){
			?>
				<div>
					<img src="<?php echo $row['urlHinh'];?>" width="140" height="90" /><br />
					<a href="index.php?k=ctt&idTin=<?php echo $row['idTin']; ?>"><?php echo $row['TieuDe']; ?></a>
				</div>
			<?php } ?>
			</div> <!-- 3 Tin Tiếp Theo -->
			
		</div> <!-- Tin Nổi Bật -->
	</div>