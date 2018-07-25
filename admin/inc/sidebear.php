<?php 


require_once dirname(__FILE__).'/../../function.php';

$mrke_page = isset($mrke_page)? $mrke_page:'';
$mrke_posts = array("posts","post_add","categories");
$mrke_set = array("nav_menus","slides","settings");

//TODO: 根据用户名，变换头像和名称

$email = news_logon_cred();

?>

<div class="aside">
    <div class="profile">
      <img class="avatar" src="<?php echo $email['avatar'] ?>">
      <h3 class="name"><?php echo $email['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li <?php echo $mrke_page == "index"? 'class="active"':''; ?> >
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li <?php echo in_array($mrke_page, $mrke_posts)? 'class="active"':''; ?>>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php echo in_array($mrke_page, $mrke_posts)? "in":''; ?>">
          <li <?php echo $mrke_page == "posts"? 'class="active"':''; ?>><a href="posts.php">所有文章</a></li>
          <li <?php echo $mrke_page == "post_add"? 'class="active"':''; ?>><a href="post-add.php">写文章</a></li>
          <li <?php echo $mrke_page == "categories"? 'class="active"':''; ?>><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li <?php echo $mrke_page == "comments"? 'class="active"':''; ?>>
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li <?php echo $mrke_page == "users"? 'class="active"':''; ?>>
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li <?php echo in_array($mrke_page,$mrke_set)? 'class="active"':''; ?>>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php echo in_array($mrke_page,$mrke_set)? 'in':''; ?>">
          <li <?php echo $mrke_page == "nav_menus"? 'class="active"':'';?>><a href="nav-menus.php">导航菜单</a></li>
          <li <?php echo $mrke_page == "slides"? 'class="active"':'';?>><a href="slides.php">图片轮播</a></li>
          <li <?php echo $mrke_page == "settings"? 'class="active"':'';?>><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>