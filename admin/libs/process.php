<?php session_start(); ob_start(); include("connect.php");

/* Xử lý thêm thể loại mới */
if(isset($_POST['themTL']))
{
    $sql = "insert into theloai values (NULL, '{$_POST['TenTL']}', '{$_POST['TenTL_KhongDau']}', {$_POST['ThuTu']}, {$_POST['AnHien']}) ";
    if(mysqli_query($conn, $sql) == true){
        header("location:../index.php?k=tl");
    } else { echo $sql; }
}

/* Xử lý sửa thể loại */
if(isset($_POST['suaTL']))
{
    $sl = "UPDATE `theloai` SET `TenTL` = '{$_POST['TenTL']}' , `TenTL_KhongDau` = '{$_POST['TenTL_KhongDau']}', `ThuTu` = {$_POST['ThuTu']}, `AnHien`={$_POST['AnHien']} WHERE idTL = {$_POST['idTL']} ";
    if(mysqli_query($conn, $sl) == true){
        header("location:../index.php?k=tl");
    }
    else { echo $sl; }
}

/* Xử lý xóa thể loại */
if(isset($_GET['idTL'])) {
    $idTL = trim($_GET['idTL']);
    $sql = "DELETE FROM theloai WHERE idTL in ($idTL)";
    $resultset = mysqli_query($conn, $sql);
    if($resultset == true){
        header("location:".$_SERVER['HTTP_REFERER']);
    } else { echo "error :".$resultset; }
}

/* Xử lý thêm loại tin */
if(isset($_POST['themLT']))
{
    $sql="insert into loaitin values (NULL, '{$_POST['Ten']}', '{$_POST['Ten_KhongDau']}', {$_POST['ThuTu']}, {$_POST['AnHien']}, {$_POST['idTL']} )";
    if(mysqli_query($conn, $sql) == true)
    {
        header("location:../index.php?idTL=".$_POST['idTL']."&k=lt");
    }
    else echo $sql;
}

/* Xử lý sửa loại tin */
if(isset($_POST['suaLT']))
{
    $sl="UPDATE `loaitin` SET `Ten`='{$_POST['Ten']}', `Ten_KhongDau`='{$_POST['Ten_KhongDau']}', `ThuTu`={$_POST['ThuTu']},  `AnHien`={$_POST['AnHien']},  `idTL`= {$_POST['idTL']} WHERE idLT={$_POST['idLT']}";
    if(mysqli_query($conn, $sl) == true)
    {
        header("location:../index.php?idTL=".$_POST['idTL']."&k=lt");
    }
    else echo $sl;
}

/* Xử lý xóa loại tin */
if(isset($_GET['idLT'])) {
    $idLT = trim($_GET['idLT']);
    $sql = "DELETE FROM loaitin WHERE idLT in ($idLT)";
    $resultset = mysqli_query($conn, $sql);
    if($resultset == true){
        header("location:".$_SERVER['HTTP_REFERER']);
    } else { echo "error :".$resultset; }
}

/* Xử lý thêm tin mới */
if(isset($_POST['themtin']))
{
    $Ngay=date("Y-m-d h:i:s",time());
    $TieuDe = stripslashes($_POST['TieuDe']);
    $TieuDe = mysqli_real_escape_string($conn, $_POST['TieuDe']);
    $TieuDe_KhongDau = stripslashes($_POST['TieuDe_KhongDau']);
    $TieuDe_KhongDau = mysqli_real_escape_string($conn, $_POST['TieuDe_KhongDau']);
    if(isset($_POST['TinNoiBat'])&&$_POST['TinNoiBat']=="on") $tnb=1; else $tnb=0;

    if(isset($_FILES['uf']))
    {
        $target="../../img/upload/";
        $filename=basename($_FILES['uf']['name']);
        $target.=$filename;
        $link="img/upload/".$filename;

        if(file_exists($target)) echo "Ảnh đã tồn tại !";
        else echo "Có thể sử dụng ảnh này !";

        if(preg_match("/\.(jpg|png|bmp|gif)$/i",basename($_FILES['uf']['name']))) echo "Day la tap tin anh!";
        else echo "Ảnh phải có định dạng jpg, png, bmp, gif";

        if(move_uploaded_file($_FILES['uf']['tmp_name'],$target))
        {
            $sql="
            insert into tin values(NULL, '{$TieuDe}',
            '{$TieuDe_KhongDau}',
            '{$_POST['TomTat']}',
            '{$link}',
            '{$Ngay}',
            {$_SESSION['id']},
            '{$_POST['Content']}',
            {$_POST['idLT']},
            0,
            {$tnb},
            {$_POST['AnHien']}) ";

            if(mysqli_query($conn, $sql))
            {
                header("location:../index.php?k=t&idTL=".$_POST['idTL']."&idLT=".$_POST['idLT']);
            }
            else echo $sql;
        }

        else echo "Upload ảnh thất bại !";
    }
}

/* Xử lý sửa Tin*/
if(isset($_POST['suatin']))
{
    if(isset($_POST['TinNoiBat'])&&$_POST['TinNoiBat']=="on") $tnb=1; else $tnb=0;
    if($_POST['AnHien']) $anhien=1; else $anhien=0;
    $ngay=date("Y-m-d h:i:s",time());
    $TieuDe = stripslashes($_POST['TieuDe']);
    $TieuDe = mysqli_real_escape_string($conn, $_POST['TieuDe']);
    $TieuDe_KhongDau = stripslashes($_POST['TieuDe_KhongDau']);
    $TieuDe_KhongDau = mysqli_real_escape_string($conn, $_POST['TieuDe_KhongDau']);

    if(isset($_FILES['ufile'])&&$_FILES['ufile']['name']!="")
    {
        /* Có thay đổi hình */
        $target="../../img/upload/";
        $filename=basename($_FILES['ufile']['name']);
        $target.=$filename;
        $link="img/upload/".$filename;

        if(move_uploaded_file($_FILES['ufile']['tmp_name'],$target))
        {

            $sl="
            update tin set TieuDe='{$TieuDe}',
            TieuDe_KhongDau='{$TieuDe_KhongDau}',
            TomTat='{$_POST['TomTat']}',
            urlHinh='$link',
            Ngay='$ngay',
            Content='{$_POST['Content']}',
            idLT={$_POST['idLT']},
            TinNoiBat=$tnb,
            AnHien=$anhien
            where idTin={$_POST['idTin']} ";

            if(mysql_query($sl)){
                header("location:../index.php?k=t&idTL=".$_POST['idTL']."&idLT=".$_POST['idLT']);
            }
            else echo $sl;
        }
    } else {
        /* Không thay đổi hình */
        $sl="
        update tin set TieuDe='{$TieuDe}',
        TieuDe_KhongDau='{$TieuDe_KhongDau}',
        TomTat='{$_POST['TomTat']}',
        Ngay='$ngay',
        Content='{$_POST['Content']}',
        idLT={$_POST['idLT']},
        TinNoiBat=$tnb,
        AnHien=$anhien where idTin={$_POST['idTin']}";

        if(mysqli_query($conn, $sl)) {
            header("location:../index.php?k=t&idTL=".$_POST['idTL']."&idLT=".$_POST['idLT']);
        }
        else echo $sl;
    }
}

/* Xử lý xóa Tin */
if(isset($_GET['idTin'])) {
    $idTin = trim($_GET['idTin']);
    $sql = "DELETE FROM tin WHERE idTin in ($idTin)";
    $resultset = mysqli_query($conn, $sql);
    if($resultset == true){
        header("location:".$_SERVER['HTTP_REFERER']);
    } else { echo "error :".$resultset; }
}

/* Xử lý cập nhật user */
if(isset($_POST['capnhatuser'])) {

    if($_POST['gioitinh'] == 1) { $gt=1; } elseif ($_POST['gioitinh'] == 2) {$gt=2; } elseif ($_POST['gioitinh'] == 3) {$gt=0; }

    $query = "
    UPDATE `users` SET `idUser` = {$_POST['idUser']},
    `HoTen` = '{$_POST['hoten']}',
    `Username` = '{$_POST['uname']}',
    `Password` = '" . md5($_POST["pass"]) . "',
    `DiaChi` = '{$_POST['diachi']}',
    `Dienthoai` = '{$_POST['dienthoai']}',
    `Email` = '{$_POST['email']}',
    `idGroup` = '{$_POST['idgroup']}',
    `NgaySinh` = '{$_POST['NgaySinh']}',
    `GioiTinh` = '{$gt}',
    `active` = 1
    WHERE idUser={$_POST['idUser']} ";
    if(mysqli_query($conn, $query)) {
        header("location: ../index.php?k=u");
    } else echo $query;
}

/* Xử lý xóa user */
if(isset($_GET['idUser'])) {
    $idUser = trim($_GET['idUser']);
    $sql = "DELETE FROM users WHERE idUser in ($idUser)";
    $resultset = mysqli_query($conn, $sql);
    if($resultset == true){
        header("location:".$_SERVER['HTTP_REFERER']);
    } else { echo "error :".$resultset; }
}

/* Xử lý đăng xuất */
if(isset($_POST['logout']))
{
    unset($_SESSION['hoten']);
    unset($_SESSION['id']);
    header("location:../index.php");
}

?>
