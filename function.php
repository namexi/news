<?php
/**
 * Created by PhpStorm.
 * User: namexi
 * Date: 2018/7/23
 * Time: 20:43
 */
require_once  dirname(__FILE__).'/config.php'; 

session_start();

/*
 * 访问控制
 * 
 */

function news_logon_cred(){

    if (empty($_SESSION['logon_cred'])){
        header('Location: login.php');
        exit();
    }
    return $_SESSION['logon_cred'];
}


/**
 * 数据库连接
 * 需要一个查询语句  返回查询对象
 */

function news_bridege_sql($sql){

	$conne = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
	if (!$conne) {
		
		$images = '连接失败';
		return $images;
	}

    mysqli_set_charset($conne,'utf8');

	$query = mysqli_query($conne,$sql);

	if (!$query) {

        $images = '查询失败';
        return $images;
	}
	return $query;
}


/**
 * 查询数据
 * 需要一个查询对象  返回整张表数据
 */

 function news_query_all($query){

 	while ($row = mysqli_fetch_assoc($query)) {
 		$data[]=$row;
 	}
	return $data;
 }


 /*
  * 查询数据库
  *  需要一个查询对象  返回一条数据
  */

function news_query_one($query){

	$data = mysqli_fetch_assoc($query);
	return $data;
}


/**
 * 增删改
 *
 * */

function news_dele_change($sql){
    $conne = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
    if (!$conne) {

        $images = '连接失败';
        return $images;
    }
    mysqli_set_charset($conne,'utf8');
    $query = mysqli_query($conne,$sql);

    if (!$query) {
        $images = '连接失败';
        return $images;
    }
   return mysqli_affected_rows($conne);
}

//$insert = news_dele_change("insert into categories(slug,name) value('111','123')");
//$insert1 = news_dele_change("insert into categories(slug,name) value('111','123')");
//var_dump($insert);
//var_dump($insert1);

// $query = news_bridege_sql("select avatar from users where email= 'w@zce.me' limit 1");
// $data = news_query_one($query);
// var_dump($data);