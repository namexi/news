<?php
/**
 * Created by PhpStorm.
 * User: namexi
 * Date: 2018/7/23
 * Time: 8:55
 */

//TODO: 提供头像接口

require_once '../../config.php';

if (isset($_GET['email'])){

    $email = $_GET['email'];
    $conne = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
    if (!$conne){
        exit('连接失败');
    }

    $query = mysqli_query($conne,"select avatar from users where email= '{$email}' limit 1;");

    if(!$query){
        exit('查询失败');
    }

    $data = mysqli_fetch_assoc($query);

    if (!$data){
        exit();
    }


   echo $data['avatar'];

}
