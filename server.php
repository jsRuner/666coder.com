<?php
//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    $ws->push($request->fd, '{"from":"系统","type":"system","content":"hi"}');
});
//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    //需要遍历。发送给其他人。
    foreach ($ws->connections as $fd){
        $ws->push($fd, "{$frame->data}");
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();