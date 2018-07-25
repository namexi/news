<?php


require_once dirname(__FILE__).'/../function.php'; 

news_logon_cred();


//TODO： 新增数据
function add(){
//    申明
    global $imasge;
    global $categories_name;
    global $categories_slug;

    //TODO: 校验并持久化

    if(empty($_POST['name'])){
        $imasge='请输入分类名称';
        return;
    }

    $categories_name = $_POST['name'];

    if (empty($_POST['slug'])){
        $imasge='请输入别名';
        return;
    }

    $categories_slug = $_POST['slug'];

    $insert = news_dele_change("insert into categories(slug,name) value('$categories_slug','$categories_name')");

   if($insert < 1){
       $imasge = '您添加的数据已存在';
       return;
   }

    $imasge = '添加成功';
   header('Location:'.$_SERVER['PHP_SELF']);

}




if($_SERVER['REQUEST_METHOD'] !=='GET'){
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        add();
    }
}

//TODO: 查询数据
$query = news_bridege_sql("select * from categories");
$categories = news_query_all($query);

 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
<!--    抽离公共部分-->
      <?php include 'inc/navbear.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
        <?php if(isset($imasge)): ; ?>
       <div class="alert <?php echo $imasge === '添加成功'? 'alert-success':'alert-danger'; ?>">
        <strong><?php echo $imasge === '添加成功'? '':'错误！'; ?></strong><?php echo $imasge; ?>
      </div>
        <?php endif ?>

      <div class="row">
        <div class="col-md-4">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称" <?php  echo isset($categories_name)? 'value='.$categories_name:'';?> >
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" <?php  echo isset($categories_slug)? 'value='.$categories_slug:'';?>>
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $value): ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['slug']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs" data-id="<?php echo $value['id']?>">删除</a>
                </td>
              </tr>
         <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--  抽离公共部分-->
  <?php $mrke_page = "categories"; ?>
  <?php include 'inc/sidebear.php' ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>


  $(function ($) {



      //TODO: 单条删除
      var aFather = $('tbody .text-center');
      var aObj = $('tbody a:eq(1)');
      aFather.on('click',aObj,function () {
          // console.dir($(this));

       var id = $(this).children('a').eq(1)[0].dataset['id'];
          $.get('/admin/api/delete.php',{id:id},function (data) {
              if ( data < 1) {
                return;
              }
              window.location.reload();
          });
      });

    

    //TODO :全选与不全选
      var idex = 0;
      var all_check = $('.table input:first');
      var sons_check = $('.table tbody input');
      var delete_btn = $('.page-action a');

      all_check.on('click',function () {

          sons_check.prop('checked',$(this).prop('checked'));

          if ($(this).prop('checked')) {
              $('.page-action a').css('display','');
          }else {
              $('.page-action a').css('display','none');
          }
      });

      sons_check.on('click',function () {

          if( $(this).prop('checked')) {
              ++idex;
          }else{
              --idex;
          }

          if (idex ===  sons_check.length) {
              all_check.prop('checked',$(this).prop('checked'));
          }else{
              all_check.prop('checked',false);
          }

          if (idex <= sons_check.length) {
              delete_btn.fadeIn();
          }
          if(idex == 0){
              delete_btn.fadeOut();
          }
          console.log(idex);
      });

  });


  </script>
</body>
</html>
