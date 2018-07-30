<?php
/**
 * Created by PhpStorm.
 * User: namexi
 * Date: 2018/7/25
 * Time: 10:42
 */


require_once  dirname(__FILE__).'/../../function.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    if (!is_numeric($id)){
        exit('请输入正确参数');
    }
    $dele =  news_dele_change("delete from categories where id='{$id}'");;
    if (!$dele){
        exit();
    }
    echo $dele;
}
