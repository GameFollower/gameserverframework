<?php

namespace GeneralModule;

use \GeneralModule\Singleton;
use \GeneralModule\DBManager;
use \GeneralModule\LocalDBModule;
use \GeneralModule\PlayerManager;
use \GeneralModule\SaveDBModule;
use \GeneralModule\RegisterAccount;
use \GeneralModule\GAME_CMD;
use \LoginModule\LoginService;

use \Workerman\Lib\Timer;
use \GatewayWorker\Gateway;



class GameService extends Singleton{
	
	const GAME_SERVICE_INTERVAL = 1;
	private static $_player_managers = null;
	private static $_database_manager = null;
	private $interval = 0;
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	public function __destruct(){
		echo "GameService __destruct\n";
	}
	
	public function Initialize(){
		
		//初始化全局单例模块
// 		SaveDBModule::getInstance();
// 		LocalDBModule::getInstance();
		LoginService::getInstance();
//		self::$_database_manager = new DBManager();
//		self::$_player_managers = new PlayerManager();
//		self::$_player_managers->_database_manager = self::$_database_manager;
		
		Timer::add(self::GAME_SERVICE_INTERVAL, array($this, 'Run'));	
// 		for ($count = 1;$count < 50000;$count++){
// 			$player_id = 1000001+$count;
// 			self::$_player_managers->PlayerIntoGame($player_id);
// 		}
	}
	
	public function Unitialize(){
		//savedb
		echo "GameService Unitialize\n";
	}
	
	public function processCMDRequest($client_id,$message){
		$cmd = $message['cmd'];
		switch ($cmd) {
			case GAME_CMD::CMD_GAME_LOGIN:
				LoginService::getInstance()->ProcessCMDRequest($client_id,$message);
				break;
			default:
				$this->_player_managers->ProcessRequestMessage(aMsg);
				break;
		}
	}
	
	public function Run() {
		$this->interval = $this->interval + 1;
		if($this->interval >= 60){
		        LoginService::getInstance()->Run();
		        $this->interval = 0;
		}
	}
}


