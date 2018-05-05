<?php
session_start();
$admin=$_SESSION["admin"];
if(isset($_GET['ss'])) {
 $key=$_GET['key'];
 $_SESSION["name"]=$key;
 echo "<script>;window.location.href='demo.php';</script>";
}
if(isset($_GET['sum'])) {
    unset($_SESSION['id']);
 echo'123';
}
if(!(isset($_SESSION["id"])&&$_SESSION["id"]==1))
{
    exit("<script>alert('当前没有登录');window.location.href='login.php';</script>");
}
$mysqli = new mysqli('localhost','root','','test');
$mysqli->query('set names utf8');
$result1 = $mysqli->query("SELECT * FROM moneydemo");
$result = $mysqli->query("SELECT * FROM moneydemo");

if(isset($_POST['monsubmit'])) {
$money=$_POST['money'];
echo $money;
$monname=$_POST['monname'];
$mysqli->autocommit(false); //开启事务
$sql1 = "UPDATE moneydemo SET money=money-'$money' where admin='$admin'";
$sql2 = "UPDATE moneydemo SET money=money+'$money' where name='$monname'";
$mysqli->query($sql1);
$r1 = $mysqli->affected_rows;
$mysqli->query($sql2);
$r2 = $mysqli->affected_rows;
if($r1>0 && $r2>0){
    $mysqli->commit(); //事务提交
    echo "<script>;window.location.href='index.php';</script>";

}else{
    $mysqli->rollback(); //事务回滚
    echo '操作失败';
}
}







?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户转账</title>
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/site.min.css" rel="stylesheet">
    <style>
        .container  .row .col-lg-4 img{ display: block; margin-left: auto; margin-right: auto; }
        .container .row .col-lg-4 h3,p{ text-align: center; }
        .row .col-lg-4 .button{ width: 360px; margin-left: 150px; margin-bottom: 10px;}
    </style>
</head>

<body>
    <!--导航栏-->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand hidden-sm" href="index.php">慕课网</a>
            </div>
            <div class="navbar-header" style="display:none;">
                <a class="navbar-brand hidden-sm" href=""><?php echo $_SESSION['name']?>,欢迎您！</a>
            </div>
        </div>
    </div>
    <!--导航栏结束-->
    <!--巨幕-->
    <div class="jumbotron masthead">
        <div class="container">
          <h1>学生转账管理系统</h1>
          <h2>实现学生转账功能</h2>
            <p class="masthead-button-links">
                <form class="form-inline" action="" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="输入搜索内容" name="key" value="">
                      <button class="btn btn-default" type="submit"name="ss">搜索</button
                        ><?php
                         if ( $_SESSION["id"]==1){
                             echo "<a href='demo.php?admin=$admin'><button type='button' class='btn btn-primary btn-default' data-toggle='modal'>用户：$admin  </button></a>
                                 
                                  <a href='index.php?sum='1'><button type='button' class='btn btn-primary btn-default' data-toggle='modal'>
                                   退出登陆
                                  </button></a>
                                  "
                                     ;

                             }else{
                        echo "<a href='register.php'><button type='button' class='btn btn-primary btn-default' data-toggle='modal'>  注册  </button></a>
                        <a href='login.php'><button type='button' class='btn btn-primary btn-default' data-toggle='modal'>  登录  </button></a>";}

                        //<a href="login.php"><button type="button" class="btn btn-primary btn-default" data-toggle="modal">  退出  </button></a>
                        //<a href="register1.php"><button type="button" class="btn btn-primary btn-default" data-toggle="modal">   个人资料  </button></a>
                        ?>

                    </div>
                </form>
            </p>
        </div>
    </div>
    <!--巨幕结束-->
    <!-- 模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="form-inline" action="" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">转账</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                          收款人：
                          <select class="form-control" name="monname">
                           <?php

                               echo "<option>请选择</option>";//变量{$data['name']}传递到这

							 while($data=$result1->fetch_assoc()){
								 if($admin==$data['admin']){
								continue;
								}
							echo "<option value='{$data['name']}'>{$data['name']}</option>";

							 }
							?>

                          </select>
                        </p>
                        <br />
                        <p>转账金额：<input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入数字" name="money"></p>
                    </div>
                    <div class="modal-footer">
                        "<button type="submit" class="btn btn-primary" name="monsubmit" id="submit" onclick="show(this)">确认转账</button>
                        <button type="reset" class="btn btn-default">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--模态框结束-->
    <div class="container projects">
        <div class="projects-header page-header">
            <h2>用户展示</h2>
            <p>将用户信息展示在页面中</p>
        </div>
        <!--信息展示-->
        <div class="row">

                <?php
				$html='';
				/**if($data['admin']==$admin){
				$html.="<button type=\"button\" class=\"btn btn-primary btn-default\" data-toggle=\"modal\" data-target=\"#myModal\">  转账                        </button>";}else{
					$html='登陆用户';
					}**/
                while ($data=$result->fetch_assoc()){
					if($data['admin']==$admin){
				    $html='登陆用户';}else
					{

					$html="<input type=\"submit\" class=\"btn btn-primary btn-default\" data-toggle=\"modal\" data-target=\"#myModal\" name=\"a\" value='转账'>";
					}
                echo "<div class=\"col-lg-4\"><img class=\"img-circle\" src=\"{$data['im']}\" alt=\"\" width=\"140\" height=\"140\">
                <h3>{$data['name']}</h3>
                <p>余额：{$data['money']}</p>
                <p>学号：{$data['xh']}</p>
                <p>个人简介：{$data['txt']}</p>
                <p>邮箱：{$data['mail']}</p>
				<div class=\"button\">

                         {$html}

				
                         </div>

				 </div>";

				}
                ?>

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
