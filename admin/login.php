<?php

require_once '../config.php';

//TODO: 校验并持久化
function login(){
    global $imasge;

    if (empty($_POST['email'])){
        $imasge = "请输入邮箱";
        return;
    }
    if(empty($_POST['password'])){
        $imasge = "请输入密码";
        return;
    }
    //接收输入的用户名与密码
    $email = $_POST['email'];
    $pwd = $_POST['password'];

 
    //TODO: 连接数据库校验用户名与密码

    $conn = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);

    if (!$conn){
        #连接数据库失败
        exit('<h1>连接失败</h1>');
    }

    mysqli_set_charset($conn,'utf8');

    $query = mysqli_query($conn,"select * from users where email= '{$email}' limit 1;");

    if (!$query){
        # 查询用户名失败
        $imasge = '登陆失败，请重试';
        return;
    }

    $user = mysqli_fetch_assoc($query);

    if (!$user){
        $imasge = '用户名不存在';
        return;
    }

    if ($pwd !== $user['password']){
        $imasge = '密码有误';
        return;
    }

//-----------------登陆成功------------------------

    //TODO: 设置访问控制

    //登陆成功 跳转页面
    header('Location: index.php');
    //利用session 记住登陆状态并传递数据
    session_start();
    $_SESSION['logon_cred'] = $user;

}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        login();

}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="login-wrap">
      <img class="avatar" src="/static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
        <?php if (isset($imasge)): ; ?>
       <div class="alert alert-danger">
        <strong>错误！</strong><?php echo $imasge; ?>
      </div>
        <?php endif ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus value="<?php echo isset($_POST['email'])? $_POST['email']:''; ?>">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block">登 录</button>
    </form>
  </div>
<script src="/static/assets/vendors/jquery/jquery.js"></script>
<script>

    $(function ($) {
        $('#email').on('blur',function () {
            var reg=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            var val = $(this).val();
           if (reg.test(val)) {

               $.get('/admin/api/avatar.php',{email:val},function (data) {
                   if (!data){
                       return;
                   }
                    console.log(data);
                    $('.avatar').attr('src',data);
               });
           }

        });
    });

</script>
</body>
</html>
