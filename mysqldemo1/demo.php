<?php
/**
 * Created by PhpStorm.
 * User: HT
 * Date: 2018/4/24 0024
 * Time: 20:55
 *
 */
session_start() ;
$mysqli = new mysqli('localhost','root','root','test');
$mysqli->query('set names utf8');

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
            <a class="navbar-brand hidden-sm" href="index.html">慕课网</a>
        </div>
        <div class="navbar-header" style="display:none;">
            <a class="navbar-brand hidden-sm" href=""><?php echo $_SESSION['name']?>,欢迎您！</a>
        </div>
    </div>
</div>
<!--导航栏结束-->
<!--巨幕-->

<!--模态框结束-->
<div class="container projects">
    <div class="projects-header page-header">
        <h2>用户展示</h2>
        <p>将用户信息展示在页面中</p>
    </div>
    <!--信息展示-->
    <div class="row">
     <?php
     if(isset($_GET['admin'])) {
         $admin=$_GET['admin'];
         $admin1=$mysqli->query("SELECT * FROM moneydemo WHERE admin='{$admin}' LIMIT 1");
         $data = $admin1->fetch_assoc();
         if(is_array($data)&&!empty($data)){
             echo "<div class=\"col-lg-4\"><img class=\"img-circle\" src=\"{$data['im']}\" alt=\"\" width=\"140\" height=\"140\">
                <h3>{$data['name']}</h3>
                <p>余额：{$data['money']}</p>
                <p>学号：{$data['xh']}</p>
                <p>个人简介：{$data['txt']}</p>
                <p>邮箱：{$data['mail']}</p>
                <a class=\"button\">
                  <a href='register1.php?id=1&admin=$admin'> <button type=\"button\" class=\"btn btn-primary btn-default\" data-toggle=\"modal\" data-target=\"#myModal\">  编辑  </button></a>
                </div>
                </div>";
         }
     }elseif(isset($_SESSION["name"])&&!empty($_SESSION["name"])){
       $name= $_SESSION["name"];
       $name=$mysqli->query("SELECT * FROM moneydemo WHERE name='{$name}' LIMIT 1");
	    $data= $name->fetch_assoc();
		if(is_array($data)&&!empty($data)){
			if($data['admin']==$_SESSION["admin"]){
				    $html='登陆用户';}else
					{
					$html="<button type=\"button\" class=\"btn btn-primary btn-default\" data-toggle=\"modal\" data-target=\"#myModal\">  转账                        </button>";
					}
             echo "<div class=\"col-lg-4\"><img class=\"img-circle\" src=\"{$data['im']}\" alt=\"\" width=\"140\" height=\"140\">
                <h3>{$data['name']}</h3>
                <p>余额：{$data['money']}</p>
                <p>学号：{$data['xh']}</p>
                <p>个人简介：{$data['txt']}</p>
                <p>邮箱：{$data['mail']}</p>
                 <p>{$html}</p>
                </div>
                </div>";
         
     }
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

