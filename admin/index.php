<?php

require_once  dirname(__FILE__).'\../function.php';

news_logon_cred();

//TODO: 查询

// 文章数
$query = news_bridege_sql("select count(1) as idx from comments;");
$data = news_query_one($query)['idx'];

//草稿箱数
$rejected = news_bridege_sql("select count(1) as idx from comments where status='rejected';");
$rej = news_bridege_sql("select count(1) as idx from comments where status='approved';");
//待审核数
$data_rej = news_query_one($rejected)['idx'];
$data_appr = news_query_one($rej)['idx'];

//分类数
$categories = news_bridege_sql("select count('idx') from categories;");
$data_cate = news_query_one($categories)["count('idx')"];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
<!-- 抽离公共部分-->
      <?php include 'inc/navbear.php';?>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo isset($data)? $data:''; ?></strong>篇文章（<strong><?php echo isset($data_rej)? $data_rej:''; ?></strong>篇草稿）</li>
              <li class="list-group-item"><strong><?php echo isset($data_cate)? $data_cate:''; ?></strong>个分类</li>
              <li class="list-group-item"><strong><?php echo isset($data)? $data:''; ?></strong>条评论（<strong><?php echo isset($data_appr)? $data_appr:''; ?></strong>条待审核）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

<!--  抽离公共部分-->
  <?php $mrke_page = "index"; ?>
  <?php include 'inc/sidebear.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
