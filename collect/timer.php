<?php
/**
 * Created by PhpStorm.
 * User: 付 hi_php@163.com
 * Date: 2017/8/9
 * Time: 下午9:52
 */
include "qsbk.php";
//定时器。一小时。
//swoole_timer_tick(1000*2, function ($timer_id) {
swoole_timer_tick(1000*60*60, function ($timer_id) {
    qsbk();
});