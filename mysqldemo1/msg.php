<?php
session_start() ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="./static/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./static/css/done.css"/>
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
</div>
<div class="content">
    <div class="center">
        <div class="image_center">

            <?php

            if($_SESSION["id"]==1&&!empty($_SESSION["id"]))
            {

                echo'<span class="smile_face">:)</span> ';
            }else{
                echo '<span class="smile_face">:(</span>';
            }

            ?>

        </div>
        <div class="code">
            <?php
            if($_SESSION["id"]==1&&!empty($_SESSION["id"]))
            {

                echo  $_SESSION["tb"];
            }else{
                echo $_SESSION["type"];
            }

            ?>

        </div>
        <div class="jump">
            页面在 <strong id="time" style="color: #009f95">3</strong> 秒 后跳转

        </div>
    </div>

</div>
<div class="footer">
    <p><span>M-GALLARY</span>©2017 POWERED BY IMOOC.INC</p>
</div>
</body>
<script src="./static/js/jquery-1.10.2.min.js"></script>
<script>

    $(function () {
        var time = 3;
        setInterval(function () {
            if (time > 1) {
                time--;
                console.log(time);
                $('#time').html(time);
            }
            else {
                $('#time').html(0);

            }
        }, 1000);

    })
</script>
</html>
