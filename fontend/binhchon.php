<div id="divbinhchon">
	<p class="binhchon">BÌNH CHỌN</p>

	<form id="form1" name="form1" method="get" action="fontend/xuly.php">

		<?php
			$query = mysqli_query($conn, "select * from binhchon where AnHien=1");
			$row=mysqli_fetch_array($query);
			echo "<p>".$row["MoTa"]."</p>";

			$query_pa=mysqli_query($conn, "select * from phuongan where idBC={$row['idBC']}");
			while($result =mysqli_fetch_array($query_pa)){ ?>
		<p>
			<input type="radio" name="idPA" value="<?php echo $result["idPA"]; ?>" id="idPA<?php echo $result["idPA"]; ?>" />
			<?php echo $result["MoTa"]; ?>
		</p>
		<?php } ?>
		<p>
			<input type="submit" name="binhchon" id="binhchon" value="Bình Chọn" />
			<a href="javascript:xemkq()">Kết Quả</a>
		</p>

	</form>

</div> <!-- End Bình chọn -->
