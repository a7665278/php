<?php
session_start() ;
$mysqli = new mysqli('localhost','root','','test');
$mysqli->query('set names utf8');
$password="";
$admin="";
if(isset($_POST['re'])){
	 echo "<script>;window.location.href='register1.php';</script>";
	}
if (isset($_POST['submit']))
{    
    if (!empty($_POST['admin'])&&!empty($_POST['password']))//判断数据不能为空
    {
        $admin = $_POST['admin'];
        $password = md5(md5(strip_tags($_POST['password'])) . 'mdzz');
        $admin=$mysqli->query("SELECT * FROM moneydemo WHERE admin='{$admin}' LIMIT 1");
        //$sql = "SELECT * FROM mall WHERE username='{$username}' LIMIT 1";
        //$obj=mysqli_query($conn,$sql);
        $result = $admin->fetch_assoc();
        var_dump($result);
        if(is_array($result)&&!empty($result))
        {
            if ($password == $result['password'])
            {
                echo "<script>;window.location.href='msg.php';</script>";
                $_SESSION["id"]='1';
                $_SESSION["tb"]='登陆成功<meta http-equiv="refresh" content="3;url=index.php" />';
                $_SESSION["admin"]=$_POST['admin'];
            } else {
                echo "<script>;window.location.href='msg.php';</script>";
                $_SESSION["id"]='2';
                $_SESSION["type"]='密码错误登陆失败<meta http-equiv="refresh" content="3;url=login.php" />';  }

        }else
        {
            echo "<script>;window.location.href='msg.php';</script>";
            $_SESSION["id"]='2';
            $_SESSION["type"]='用户名不存在<meta http-equiv="refresh" content="3;url=login.php" />';
        }
    } else
    {
        echo "<script>;window.location.href='msg.php';</script>";
        $_SESSION["id"]='2';
        $_SESSION["type"]='登录失败，不能为空<meta http-equiv="refresh" content="3;url=login.php" />';
    };


}

?>
<!DOCTYPE html>
<html>	
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
    <link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<!--//webfonts-->
    <script src="http://ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<script>$(document).ready(function(c) {
	$('.close').on('click', function(c){
		$('.login-form').fadeOut('slow', function(c){
	  		$('.login-form').remove();
		});
	});	  
});
</script>
 <!--SIGN UP-->
 <h1>klasikal Login Form</h1>
<div class="login-form">
	<div class="close"> </div>
		<div class="head-info">
			<label class="lbl-1"> </label>
			<label class="lbl-2"> </label>
			<label class="lbl-3"> </label>
		</div>
			<div class="clear"> </div>
	<div class="avtar">
		<img src="images/avtar.png" />
	</div>
			<form action="login.php"method="post" name="">
					<input type="text" class="text"name="admin" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" >
						<div class="key">
					<input type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
						</div>
                <div class="signin">
                    <input type="submit" value="登陆"name="submit" >
                    <input type="submit" value="注册"name="re" >
                </div>
			</form>

</div>
 <div class="copy-rights">
					<p>Copyright &copy; 2015.Company name All rights reserved.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="ģ��֮��">ģ��֮��</a> - Collect from <a href="http://www.cssmoban.com/" title="��ҳģ��" target="_blank">��ҳģ��</a></p>
			</div>

</body>
</html>