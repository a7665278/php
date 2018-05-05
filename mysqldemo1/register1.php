<?php
session_start() ;
$id='';
if (isset($_POST['login'])) { echo "<script>;window.location.href='login.php';</script>";}
if( isset($_GET['admin'])){
     $admin1=$_GET['admin'];
     $id=$_GET['id'];
};


$mysqli = new mysqli('localhost','root','','test');
$mysqli->query('set names utf8');
if($id==1){

if (isset($_POST['submit'])) {


    $txt = $_POST['txt'];
    $mail = $_POST['mail'];
    include_once 'upload.class.php';
    $upload = new upload('im', 'imooc');
    $dest = $upload->uploadFile();
    $des=$mysqli->query("SELECT im FROM moneydemo WHERE admin='$admin1'");
    $row = $des->fetch_array();
    $des=$row['im'];

    echo $dest,$txt,$mail;
    if ($mysqli->query("UPDATE moneydemo SET txt='$txt',mail='$mail',im='$dest' WHERE admin='$admin1'")) {
        unlink (  $des );
        echo "<script>;window.location.href='msg.php';</script>";
        $_SESSION["id"] = '1';
        $_SESSION["tb"] = '修改成功<meta http-equiv="refresh" content="3;url=index.php" />';
        $_SESSION["admin"] = $admin1;
    }
}
}else {
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $money = $_POST['money'];
        $xh = $_POST['xh'];
        $txt = $_POST['txt'];
        $mail = $_POST['mail'];
        $admin = $_POST['admin'];
        $password = md5(md5(strip_tags($_POST['password'])) . 'mdzz');
        var_dump($admin, $password);

        $username = $mysqli->query("SELECT admin FROM moneydemo WHERE admin='$admin'");
        $rows = $username->fetch_array();
        echo $mail, $txt, $money, $name, $xh;
        include_once 'upload.class.php';
        $upload = new upload('im', 'imooc');
        $dest = $upload->uploadFile();
        var_dump($rows);
        if ($rows['admin'] == $admin) {
            echo "<script>alert('用户名已存在，请重新输入！');window.location.href='register1.php';</script>";
        } elseif ($mysqli->query("INSERT INTO moneydemo(txt,name,mail,xh,money,im,admin,password) VALUE ('$txt','$name','$mail','$xh','$money','$dest','$admin','$password')")) {
            echo "<script>;window.location.href='msg.php';</script>";
            $_SESSION["id"] = '1';
            $_SESSION["tb"] = '注册成功<meta http-equiv="refresh" content="3;url=index.php" />';
            $_SESSION["admin"] = $admin;
        }

        //$result = $mysqli->query("INSERT INTO moneydemo(txt,name,mail,xh,money,im,admin,password) VALUE ('$txt','$name','$mail','$xh','$money','$dest','$admin','$password')");
        //echo "<script>;window.location.href='msg.php';</script>";
        //$_SESSION["id"]='1';
        // $_SESSION["tb"]='添加成功<meta http-equiv="refresh" content="3;url=index.php" />';


    }//INSERT INTO moneydemo(name,money,txt,xh,mail) VALUE ($name,$money,$txt,$xh,$mail)\"
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/site.min.css" rel="stylesheet">
</head>

<body>
    <!--导航栏-->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand hidden-sm" href="index.php">慕课网</a>
            </div>
        </div>
    </div>
    <!--导航栏结束-->
    <!-- 注册页面 -->
    <div class="container projects">
        <div class="projects-header page-header">
            <h3><?php if ($id=="1"){echo '普通用户修改';}else{echo '注册';}?></h3>
        </div>
        <!--注册框-->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <?php
               if ($id!=='1'){
                   echo " 
                  <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-10\">
                      <button type=\"submit\" class=\"btn btn-primary btn-default\"name=\"login\">去登陆</button>
                  </div>
                  </div>
 
                    <div class=\"form-group\">
                   
                    <label for=\"inputEmail3\" class=\"col-sm-2 control-label\">账号</label>
                    <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"admin\" class=\"form-control\" placeholder=\"请输入账号\">
                    </div>
                </div>
                
                <div class=\"form-group\">
                    <label for=\"inputEmail3\" class=\"col-sm-2 control-label\">密码</label>
                    <div class=\"col-sm-10\">
                        <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"请输入密码\">
                    </div>
                </div>
              <div class=\"form-group\">
                  <label for=\"inputEmail3\" class=\"col-sm-2 control-label\">姓名</label>
                  <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"name\" class=\"form-control\" placeholder=\"请输入姓名\">
                  </div>
              </div>
              <div class=\"form-group\">
                  <label for=\"inputPassword3\" class=\"col-sm-2 control-label\">学号</label>
                  <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"xh\" class=\"form-control\" placeholder=\"请输入学号\">
                  </div>
              </div>
              <div class=\"form-group\">
                  <label for=\"inputPassword3\" class=\"col-sm-2 control-label\">金钱</label>
                  <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"money\" class=\"form-control\" placeholder=\"请输入数字\">
                  </div>
              </div>";
               }
              ?>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
                  <div class="col-sm-10">
                      <input type="email" name="mail" class="form-control" placeholder="请输入正确邮箱">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">头像</label>
                  <div class="col-sm-10">
                      <input type="file" name="im">
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">个人简介</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="2" name="txt" placeholder="不超过50字"></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary btn-default"name="submit">提交</button>
                      <button type="submit" class="btn btn-default">重置</button>
                  </div>
              </div>
              </form>
          </div>
        </div>

        <!--登录框-->
        <!-- 登录页面 -->

        <div class="projects-header page-header" style="display:none;">
            <h3>登录</h3>
        </div>
        <!-- 登录框 -->
        <div class="row" style="display:none">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" action="register.class.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="请输入姓名,字数不超过10位" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">学号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="请输入学号,数字不超过8位" name="number">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-default">提交</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer  container">
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <h4><a href="http://class.imooc.com" target="_blank">class.imooc.com</a> | 慕课网</h4>
            </ul>
        </div>
    </footer>
    <script src="style/js/jquery.min.js"></script>
    <script src="style/js/bootstrap.min.js"></script>
</body>

</html>
