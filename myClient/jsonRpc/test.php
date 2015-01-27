<?php
/**
 * Created by linzl
 * User: linzl<linzhenlong@smzdm.com>
 * Date: 15/1/27
 * Time: 下午4:00
 */

include_once 'client/RpcClient.php';
include_once 'client/StatisticClient.php';

$address_array = array(
	'tcp://127.0.0.1:2015',
	'tcp://127.0.0.1:2015'
);
// 配置服务端列表
RpcClient::config($address_array);

$uid = 567;

// User对应applications/JsonRpc/Services/User.php 中的User类
$user_client = RpcClient::instance('User');
$i = 0;
while ($i < 1000) {
// getInfoByUid对应User类中的getInfoByUid方法
$ret_sync = $user_client->getInfoByUid($uid);
print_r($ret_sync);
	StatisticClient::report('User', 'getInfoByUid', $i, $ret_sync['code'], $ret_sync['msg']);
	$i++;
}
