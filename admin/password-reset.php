<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
<!--   抽离公共部分-->
      <?php include 'inc/navbear.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" class="form-control" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" class="form-control" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" class="form-control" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <button type="submit" class="btn btn-primary">修改密码</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- 抽离公共部分-->
  <?php $mrke_page = "pwd_reset"; ?>
 <?php include 'inc/sidebear.php'; ?>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
