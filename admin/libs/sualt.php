<?php
	if(isset($_GET['idLT'])){
		$idLT=$_GET['idLT'];
		$sql=mysqli_query($conn, "SELECT * FROM loaitin WHERE idLT={$_GET['idLT']}");
        $dlt=mysqli_fetch_array($sql);
?>
<form name="form2" method="post" action="libs/process.php">
    <p>
        <label for="theloai">Thể loại</label>
        <select name="idTL" id="idTL">
            <?php
                $kq=mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
                while($d=mysqli_fetch_array($kq)){
            ?>
            <option value="<?php echo $d['idTL'];?>" <?php if($d['idTL']==$dlt['idTL']) echo "selected='selected'"; ?>>
                <?php echo $d['TenTL'];?>
            </option>
            <?php }?>
        </select>
    </p>
    <?php
            
    ?>
    <p>
        <label for="TenTL">Tên Loại Tin</label><br />
        <input type="text" name="Ten" id="Ten" value="<?php echo $dlt['Ten']; ?>" required/>
    </p>
    <p>
        <label for="TenTL_KhongDau">Tên Không Dấu</label><br />
        <input type="text" name="Ten_KhongDau" id="Ten_KhongDau" value="<?php echo $dlt['Ten_KhongDau'];  ?>" required/>
    </p>
    <p>
        <label for="ThuTu">Thứ Tự</label><br />
        <input type="text" name="ThuTu" id="ThuTu" value="<?php echo $dlt['ThuTu'];  ?>"required/>
    </p>
    <p>
        <label for="AnHien">Trạng Thái</label>
        <select name="AnHien" id="AnHien">
            <option value="1">Hiện</option>
            <option value="0" <?php if($dlt['AnHien'] == 0) echo "selected='selected'"; ?> >Ẩn</option>
        </select>
    </p>

    <p>
        <input type="hidden" name="idLT" value="<?php echo $idLT;?>"/>
        <input type="submit" name="suaLT" id="suaLT" value="Cập Nhật" />
    </p>

</form>
<?php } ?>