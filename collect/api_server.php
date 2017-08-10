<?php
/**
 * Created by PhpStorm.
 * User: 付 hi_php@163.com
 * Date: 2017/8/10
 * Time: 下午8:45
 */

require 'vendor/autoload.php';


//获取数据。ip地址。时间。接口参数。
//$db = new Workerman\MySQL\Connection("mysql", "3306", "root", "123456", "collect");
$db = new Workerman\MySQL\Connection("mysql", "3306", "root", "CSvaKnnf", "collect");

header("Content-type: application/json");


$key = isset($_GET['key'])?$_GET['key']:''; //key值。
$secret = isset($_GET['secret'])?$_GET['secret']:""; //密钥

if ($key !='htt_qsbk' || $secret !="123456"){

    $data = [
        'success'=>false,
        'code'=>"key_error",
        "message"=>"密钥错误"
    ];
}else{


    //读取最新25条。返回。

        $result = $db->select('id,content,href')->from('swoole_qsbk')->limit(25)->orderByDESC(['id'])->query();


        $data = [
            'success'=>true,
            'code'=>"action_success",
            "message"=>"请求成功",
            "result"=>$result
        ];

}

//返回结果。
echo json_encode($data);

//做个记录。记录请求的时间。来源。ip。
$log_data =[
    "ip"=> $_SERVER["REMOTE_ADDR"],
    'dt_add'=>date('Y-m-d H:i:s'),
    'data'=>json_encode($data)
];
$db->insert('swoole_qsbk_log')->cols($log_data)->query();
