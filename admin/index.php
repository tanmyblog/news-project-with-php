<?php session_start(); ob_start(); include("libs/connect.php"); 
if(!isset($_SESSION['id'])) {
    header("location: login.php");
} elseif($_SESSION['capdo'] == 1) { ?>
<!DOCTYPE html>
<html>
<head>
    <title>CMS Tin Tức :: Designed By CLAY</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>

    <div class="side-nav">
        <div class="logo">CM<span style="color:#ff9500">S</span></div> <!-- End logo -->
        <div id="menu">
            <ul>
                <?php
                    if(isset($_GET['k'])) $key = $_GET['k'];
                    else $key = "tc";
                ?>
                <li><a href="index.php" <?php if($key=="tc") echo 'class="active"';?>>Tổng Quan</a></li>
                <li><a href="index.php?k=tl" <?php if($key=="tl"||$key=="tlt"||$key=="tls") echo 'class="active"';?>>Thể Loại</a></li>
                <li><a href="index.php?k=lt" <?php if($key=="lt"||$key=="ltt"||$key=="lts") echo 'class="active"';?>>Loại Tin</a></li>
                <li><a href="index.php?k=t" <?php if($key=="t"||$key=="tt"||$key=="ts") echo 'class="active"';?>>Tin Tức</a></li>
                <li><a href="index.php?k=u" <?php if($key=="u"||$key=="us") echo 'class="active"';?>>Users</a></li>

            </ul>
        </div>
    </div> <!-- End side-nav -->

    <div class="main-content">
        <div class="header">
            <span>Xin Chào <?php echo $_SESSION['hoten']; ?></span>
        </div>

        <div class="main">
        <?php
            if(isset($_GET['k'])){
                switch($key)
                {
                    case "tl" : include("libs/theloai.php");    break;
                    case "tlt": include("libs/themtl.php");     break;
                    case "tls": include("libs/suatl.php");      break;

                    case "lt" : include("libs/loaitin.php");    break;
                    case "ltt": include("libs/themlt.php");     break;
                    case "lts": include("libs/sualt.php");      break;

                    case "t" :  include("libs/tin.php");        break;
                    case "tt":  include("libs/themtin.php");    break;
                    case "ts":  include("libs/suatin.php");     break;

                    case "u" :  include("libs/users.php");      break;
                    case "us":  include("libs/capnhatuser.php");break;
                }
            } else { include("libs/main.php"); }
        ?>
        </div> <!-- End main -->

    </div> <!-- End main-content -->

</body>
</html>
<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
    <title>CMS Tin Tức :: Designed By CLAY</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>

    <div class="side-nav">
        <div class="logo">CM<span style="color:#ff9500">S</span></div> <!-- End logo -->
        <div id="menu">
            <ul >
            <?php
                if(isset($_GET['k'])) $key = $_GET['k'];
                else $key = "tc";
            ?>
                <li><a href="index.php" <?php if($key=="tc") echo 'class="active"'; ?>>Tổng Quan</a></li>
                <li><a href="index.php?k=t" <?php if($key=="t"||$key=="tt"||$key=="ts"||$key=="tsc") echo 'class="active"';?>>Tin Tức</a></li>
            </ul>
        </div>
    </div> <!-- End side-nav -->

    <div class="main-content">
        <div class="header">
            <span>Xin Chào <?php echo $_SESSION['hoten']; ?></span>
        </div>

        <div class="main">
            <?php
            if(isset($_GET['k'])){
                switch($key)
                {
                    case "t" :  include("thanhvien/tin.php");       break;
                    case "tt":  include("thanhvien/themtin.php");   break;
                    case "ts":  include("thanhvien/suatin.php");    break;
                    case "tsc": include("thanhvien/suatinc.php");   break;
                }
            } else { include("thanhvien/main.php"); }
            ?>
        </div> <!-- End main -->

    </div> <!-- End main-content -->

</body>
</html>
<?php } ?>