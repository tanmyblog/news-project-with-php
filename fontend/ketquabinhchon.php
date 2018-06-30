<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kết Quả Bình Chọn</title>
	</head>
	<body>
		<?php
			include("../config/connect.php");
			$sql = mysqli_query($conn, "SELECT * FROM binhchon");
			$row = mysqli_fetch_assoc($sql);
			$idBC = $row['idBC'];
			$mota = $row['MoTa'];

			/* Truy van lay tong binh chon */
			$sql = mysqli_query($conn, "SELECT SUM(SoLanChon) AS tongsobinhchon FROM phuongan WHERE idBC=$idBC");
			if($row = mysqli_fetch_assoc($sql)){
				$tongsobinhchon = $row['tongsobinhchon'];
			}
		?>
		<table width="450" border="1" celspdding="1">
			<tr>
				<td colspan="3" align="center" bgcolor="aqua"><?php echo $mota; ?></td>
			</tr>
			<?php
				$sql = mysqli_query($conn, "SELECT * FROM phuongan WHERE idBC=$idBC");
				while($result = mysqli_fetch_assoc($sql)){
					$rong = ($result['SoLanChon']/$tongsobinhchon)*150;
					$phantram = ($result['SoLanChon']/$tongsobinhchon)*100;
			?>
			<tr>
				<td width="150"><?php echo $result['MoTa']; ?></td>
				<td width="150">
					<table width="150">
						<tr>
							<td width="<?php echo $rong; ?>" bgcolor="red"></td>
							<td><?php echo round($phantram,2); ?>%</td>
						</tr>
					</table>
				</td>
				<td width="150">Số Lần Chọn: <?php echo $result['SoLanChon']; ?></td>
			</tr>
		<?php } ?>
			<tr>
				<td colspan="3" align="center">Tổng Số Bình Chọn: <?php echo $tongsobinhchon; ?></td>
			</tr>
		</table>
	</body>
</html>
