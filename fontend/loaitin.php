	<?php include("quangcao.php");
		if(isset($_GET['idTL'])) $idTL=$_GET['idTL'];
		$query = mysqli_query($conn, "select TenTL from theloai where idTL=$idTL and AnHien=1");
		$row = mysqli_fetch_array($query);
		if(isset($_GET['idLT']))
		{
			$idLT = $_GET['idLT'];
			$query_lt = mysqli_query($conn, "select Ten from loaitin where idLT=$idLT");
			$row_lt = mysqli_fetch_array($query_lt);
	?>
		<div class="tenloai"><?php echo $row['TenTL'] ?> - <span><?php echo $row_lt['Ten'];?></span></div>
	<?php

	// Lấy tin theo thể loại và phân trang
		$sb=5;
		$query_t = mysqli_query($conn, "select * from tin where idLT=$idLT");
		$count = mysqli_num_rows($query_t);
		$nums = ceil($count/$sb);
		if(isset($_GET['page'])){
			$page=$_GET['page'];	
		} else $page=1;
		$vt = ($page -1)*$sb;	
		
	$sl="select * from tin where idLT=$idLT and AnHien=1 order by idTin DESC limit $vt,$sb";

	$kqtin=mysqli_query($conn, $sl);
	while($dtin = mysqli_fetch_array($kqtin)){ 

	?>
	<div class="loaitin">
		<div class="lt_left"><img src="<?php echo $dtin['urlHinh'];?>" width="240" height="185"/></div>
		<div class="lt_right">
	        <h2><a href="index.php?k=ctt&idTin=<?php echo $dtin['idTin']; ?>"><?php echo $dtin['TieuDe'];?></a></h2>
	        <div class="tomtat"><?php echo $dtin['TomTat'];?></div>
		</div>
	</div>
	<?php }?>


	<div class="trang">

	<p>
		<?php
			for($i=1;$i<=$nums;$i++){
				if($page==$i) echo "<span style='padding:6px 12px;display:inline-block;background:#999;color:#333;margin: 0 4px 0 4px;text-decoration: none;'>".$i."</span> "; 
				else {
		?>
				<a href="index.php?k=lt&page=<?php echo $i;?>&idLT=<?php echo $idLT; ?>"><?php echo $i;?></a>
		<?php }}?>
	</p>

	</div>

	<?php }?>
</div> <!-- End Main2_1 -->