<?php
/**
 * Created by PhpStorm.
 * User: 付 hi_php@163.com
 * Date: 2017/8/3
 * Time: 下午9:48
 */

//每隔2000ms触发一次
//1分钟执行一次。

require 'vendor/autoload.php';


//发送一封邮件。
use Nette\Mail\Message;

use GuzzleHttp\Client;


function qsbk()
{



    $client = new Client();

    $response = $client->get('https://www.qiushibaike.com/text/');


//200
    if ($response->getStatusCode() != 200) {
        echo '采集失败';
        return;
    }

    $body = $response->getBody();

    phpQuery::newDocument($body);

    $articles = pq('article');
    $datas =[];
    foreach ($articles as $article) {
        $data = array();
        $data['content'] = pq($article)->find(".text")->text();
        $data['href'] = pq($article)->find(".text")->attr('href');
        if (empty($data['content']) || empty($data['href'])) {
            continue;
        }
        $datas[] = $data;
    }



    $db = new Workerman\MySQL\Connection("mysql", "3306", "root", "CSvaKnnf", "collect");

// Insert.
    $num = 0;
    foreach ($datas as $data) {
        $insert_id = $db->insert('swoole_qsbk')->cols($data)->query();
        if ($insert_id > 0) {
            $num++;
        }
    }


    $mail = new Message;
    $mail->setFrom('hi_php@163.com')
        ->addTo('doudouchidou@yeah.net')
        ->setSubject(date('Y-m-d-H-i-s') . "糗事百科" . $num . "条")
        ->setBody(date('Y-m-d H:i:s') . "糗事百科" . $num . "条");

    $mailer = new Nette\Mail\SmtpMailer([
        'host' => 'smtp.163.com',
        'username' => 'hi_php@163.com',
        'password' => 'xxoo123',
        'secure' => 'ssl', //使用465端口发送邮件。
    ]);
    $mailer->send($mail);

}
?>
