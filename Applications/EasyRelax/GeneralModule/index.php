<?php

namespace GeneralModule;

use GeneralModule\PlayerManager;

require_once '../../../../GeneralModule/Singleton.php';
require_once '../../../../GeneralModule/PlayerManager.php';
require_once '../../../../GeneralModule/DBManager.php';


echo "hello world";

$dbmanager = \DBManager::getInstance();
$result = $dbmanager->getAccountDB()->getValue('select * from user');


//数据库 增，删，改，查操作
//插入数据，多条  循环 foreach ()
$array = array(
			'playId'    => 1000001,
			'orderType'     => '1',
			'orderId'       => '1000000001',
			'channelid'     => 'appstore',
			'orderTime' 	=> date("Y-m-d H:i:s"),
			'rechargeId'	=> '10001',
			'uniquedevice'	=> 'oooxxxx',
			'originalMoney' => '10000',
			'status'    => 2,
		);
$dbmanager->getAccountDB()->insert('G_RechargeWithTX', $array);
$lastInsertId = $dbmanager->getAccountDB()->getInsertId(); //获取插入的索引号

$dbmanager->getAccountDB()->delete('G_RechargeIndex', 'PlayerID='.$lastInsertId);
//改
$dbmanager->getAccountDB()->update('G_RechargeIndex', array('lastRecordIndex'=>$lastInsertId) , " Id in(0,1)");
//获取一行数据
$one_row = $dbmanager->getAccountDB()->getOne("select id,account from G_RechargeWithTX where channelid='".'10000');
$id = $one_row['id'];
$account = $one_row['account'];

$history = $dbmanager->getAccountDB()->getAll("SELECT szid,status FROM G_OpenLogin where  appid=".'10000');
foreach ($history as $row){
	$szid = $row['szid'];
	$status = $row['status'];
	echo $szid.$status;
}


var_dump($result);

$playerManager = PlayerManager::getInstance();
for ($count = 1;$count<10;$count++){
	$playerid = 1000000 + $count;
	$playerManager->PlayerIntoGame($playerid);
}

echo 'hello world end';