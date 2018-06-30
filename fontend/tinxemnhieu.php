<div id="main1_2">
	<div id="tinxemnhieu">	
		<h4>TIN XEM NHIỀU</h4>
		<?php
			$query = mysqli_query($conn, "select * from tin where AnHien=1 order by SoLanXem DESC limit 0,10");
			while($row = mysqli_fetch_array($query)){
		?>
			<p><a href="index.php?k=ctt&idTin=<?php echo $row['idTin']; ?>"><?php echo $row['TieuDe']; ?></a></p>
		<?php } ?>
	</div><!-- Tin Xem Nhiều-->
</div>