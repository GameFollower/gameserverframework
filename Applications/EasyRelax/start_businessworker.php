<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;
use \GeneralModule\GameService;
use \GeneralModule\DBManager;

// 自动加载类
require_once __DIR__ . '/../../Workerman/Autoloader.php';
Autoloader::setRootPath(__DIR__);


// bussinessWorker 进程
$worker = new BusinessWorker();
// worker名称
$worker->name = 'GameBusinessWorker';
// bussinessWorker进程数量
$worker->count = 4;
// 服务注册地址
$worker->registerAddress = '127.0.0.1:1238';

$worker->onBufferFull = function ($worker)
{
	echo "TcpConnection::maxSendBufferSize 缓冲区大小已满，请注意\n";
};

$worker->onWorkerStart = function ($worker){
	echo "GameBusinessWorker start worker_id = $worker->id\n";
	//if ($worker->id == 0) {
	//	$worker->game_service = new GameService();
	//	$worker->game_service->Initialize();
	//}
};

$worker->onWorkerStop = function($worker)
{
	echo "GameBusinessWorker stop worker_id = $worker->id\n";
};

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START')) {
    Worker::runAll();
}

function UnitailGameService(){
// 	GameService::getInstance()->Unitialize();
}

