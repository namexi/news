<?php


require_once dirname(__FILE__).'/../function.php';

news_logon_cred();

// TODO: 数据库文章数据显示在页面上
$query = news_bridege_sql(
        "select posts.*,categories.name,users.nickname from posts 
INNER JOIN categories on posts.category_id= categories.id
INNER JOIN users on posts.user_id=users.id
order by created desc;"
);
$posts = news_query_all($query);

// 分类状态转义
 function status($status){
     $arr=array(
         'drafted' =>'草稿',
         'published' => '已发布',
         'trashed' => '垃圾箱'

     );
    return $arr[$status];
 }

 // 格式化时间
function convert_date($time){

  date_default_timezone_set('PRC');
  $strtime=strtotime($time);
  return date('Y-m-d<b\r>H:i:s',$strtime);
 
}

?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($posts as $value): ?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?php echo $value['title']; ?></td>
            <td><?php echo $value['nickname']; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td class="text-center"><?php echo convert_date($value['created']) ?></td>
            <td class="text-center"><?php echo status($value['status']); ?></td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
         <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

<!--抽离公共部分-->
  <?php $mrke_page = "posts"; ?>
<?php include 'inc/sidebear.php'; ?>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
