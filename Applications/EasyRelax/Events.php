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

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use \GeneralModule\GameService;
use \GeneralModule\DBManager;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
	
//    private static $_game_service = null;
	
    public static function onConnect($client_id) {
        // 向当前client_id发送数据 
//         Gateway::sendToClient($client_id, "Hello $client_id");
//         // 向所有人发送
//         Gateway::sendToAll("$client_id login");
        
        $response = array('cmd' => '1203', 'action' => '8','targetid'=> '1000001','message' =>'great start');
        $response = json_encode($response);
        Gateway::sendToClient($client_id,$response);
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message) {
        // 向所有人发送 
   	$message = json_decode($message,true);
   	var_dump($message);
   	
//    	echo $message['cmd'];
//    	echo $message['action'];
//    	$cmd = 0x1203;
//    	$response = array('cmd' => $cmd, 'action' => 8,'name' => 'kobenini name change');
//    	$response = json_encode($response);
   	
   	//Gateway::sendToAll($response);
   	GameService::getInstance()->processCMDRequest($client_id, $message);
   	
//      var_dump(json_decode($message));
// 	Gateway::sendToAll("$client_id said $message");
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id) {
       // 向所有人发送 
       GateWay::sendToAll("$client_id logout");
       echo "$client_id logout";
   }

   //进程启动的时候
   public static function onWorkerStart(){
      //启动定时器
      //start game service
      echo "Events onWorkerStart\n";
      //self::$_game_service = new GameService();
      GameService::getInstance()->Initialize();
      //$account = "7000002";
      //$query = "select id,account from  user where account='".$account."'";
      //echo $query;
      //$result = DBManager::getInstance()->getAccountDB()->getOne($query);
   }

   //进程退出，相关保存操作
   public static function onWorkerStop(){
   	echo "Events onWorkerStop\n";
   	//GameService::getInstance()->Unitialize();
   }
}
