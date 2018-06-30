<div class="container">
<?php
    if(isset($_GET['idUser'])){ $idUser=$_GET['idUser'];
?>
<form method="post" action="libs/process.php">
    <table width="60%">
        <thead>
            <tr>
                <th colspan="4">Cập Nhật Thông Tin User</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql =mysqli_query($conn, "SELECT * FROM users where idUser=$idUser");
            while($row = mysqli_fetch_array($sql)){
        ?>
            <tr>
                <th>IdUser</th>
                <td><input type="text" id="idUser" name="idUser" value="<?php echo $row['idUser']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Họ Tên</th>
                <td><input type="text" id="hoten" name="hoten" value="<?php echo $row['HoTen']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><input type="text" id="uname" name="uname" value="<?php echo $row['Username']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" id="pass" name="pass" value="<?php echo $row['Password']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Địa Chỉ</th>
                <td><input type="text" id="diachi" name="diachi" value="<?php echo $row['DiaChi']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Điện Thoại</th>
                <td><input type="text" id="dienthoai" name="dienthoai" value="<?php echo $row['Dienthoai']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>" required="required" /></td>
            </tr>
            <tr>
                <th>Ngày Sinh</th>
                <td><input type="text" id="ngaysinh" name="ngaysinh" value="<?php echo date('d-m-Y',strtotime($row['NgaySinh']));?>" required="required" /></td>
            </tr>
            <tr>
                <th>Giới Tính</th>
                <td>
                    <?php
                        if($row["GioiTinh"] == 1) {
                            $nam=1;
                        } elseif($row['GioiTinh'] == 0) {
                            $nu=0;
                        } else { $khac=2; }
                    ?>
                    <input type="radio" name="gioitinh" value="1" <?php if(isset($nam)) { ?>checked<?php  } ?> > Nam
                    <input type="radio" name="gioitinh" value="3" <?php if(isset($nu)) { ?>checked<?php  } ?> > Nữ
                    <input type="radio" name="gioitinh" value="2" <?php if(isset($khac)) { ?>checked<?php  } ?> > Khác
                </td>
            </tr>           
            <tr>
                <th>Quyền</th>
                <td>
                    <?php
                        if($row["idGroup"] == 1) {
                            $admin=1;
                        } else {
                            $thanhvien=0;
                        }
                    ?>
                    <input type="radio" name="idgroup" value="1" <?php if(isset($admin)) { ?>checked<?php  } ?> /> Admin
                    <input type="radio" name="idgroup" value="0" <?php if(isset($thanhvien)) { ?>checked<?php  } ?> /> Thành Viên
                </td>
            </tr>
    <?php } ?>
        </tbody>  
    </table>

    <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
    <input type="submit" name="capnhatuser" value="Cập Nhật">

</form>

<?php } ?>
</div>