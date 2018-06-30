<div id="nav-menu">
    <ul id="menu">
		<li><a href="index.php">Home</a></li>
		<?php
    		$query = mysqli_query($conn, "select * from theloai where AnHien=1 order by ThuTu");
    		while($row = mysqli_fetch_array($query)){
    			$idTL = $row['idTL'];
    	?>
		<li><a href="#"><?php echo $row['TenTL']; ?></a>
			<ul>
				<?php
					$query_lt = mysqli_query($conn, "select * from loaitin where idTL={$idTL} and AnHien=1 order by ThuTu");
					while ($row_lt = mysqli_fetch_array($query_lt)) {
				?>
				<li><a href="index.php?k=lt&idTL=<?php echo $idTL; ?>&idLT=<?php echo $row_lt['idLT']; ?>"><?php echo $row_lt['Ten']; ?></a></li>
				<?php } ?>
			</ul>
		</li>
		<?php } ?>
	</ul>
</div> <!-- Menu Chính -->