<form name="form2" method="post" action="libs/process.php">
    <p>
        <label for="theloai">Thể loại</label>
        <select name="idTL" id="idTL">
            <?php
                $kq=mysqli_query($conn, "SELECT * FROM theloai ORDER BY ThuTu");
                while($d=mysqli_fetch_array($kq)){
            ?>
            <option value="<?php echo $d['idTL'];?>"  <?php if(isset($_GET['idTL'])&&$_GET['idTL']==$d['idTL']){echo "selected='selected'";$idTL=$_GET['idTL'];}?>><?php echo $d['TenTL'];?></option>
            <?php }?>
        </select>
    </p>
    <p>
        <label for="TenTL">Tên Loại Tin</label><br />
        <input type="text" name="Ten" id="Ten" required/>
    </p>
    <p>
        <label for="TenTL_KhongDau">Tên Không Dấu</label><br />
        <input type="text" name="Ten_KhongDau" id="Ten_KhongDau" required/>
    </p>
    <p>
        <label for="ThuTu">Thứ Tự</label><br />
        <input type="text" name="ThuTu" id="ThuTu" required/>
    </p>
    <p>
        <label for="AnHien">Trạng Thái</label>
        <select name="AnHien" id="AnHien">
            <option value="1">Hiện</option>
            <option value="0">Ẩn</option>
        </select>
    </p>

    <p>
        <input type="submit" name="themLT" id="themlt" value="Thêm" />
        <input type="reset" name="reset" id="reset" value="reset" />
    </p>

</form>