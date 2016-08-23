<?php

namespace GeneralModule;

use \GeneralModule\Singleton;
use \GeneralModule\DBManager;

require_once 'CMD.php';
		
class RegisterAccount extends Singleton{

	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	
	public function start(){
		$this->insertDBData();
	}

	private function insertDBData(){
		//数据库各个表初始化
		for ($index = 1;$index < SERVER_INI::INIT_PLAYER_COUNT;$index++){
			$player_id = SERVER_INI::SERVER_PLAYER_ID_INDEX +$index;
			$this->initPlayerBase($player_id);
		}
	}
	
	private function initPlayerBase($player_id){
		$data = array(
				'PlayerID'    => $player_id,
				'Level'     => 1,
				'Exp'       => 0,
				'Gold'     => 500,
				'Coin' 	=> 1000,
				'VIP'	=> 1,
				'VipExp'	=> 0,
				'Icon' => 1000,
				'Power'    => 1000,
				'Kills'    => 0,
				'Chip_Coin'    => 1000,
				'Recharge_Gold'    => 1000,
				'Vitality'    => 0,
		);
		DBManager::getInstance()->getGameDB()->insert('G_PlayerBase', $data);
	}
}
