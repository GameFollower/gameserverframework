<?php

namespace GeneralModule;

use \SinglePlayer\ManagerModule\GamePlayer;

class PlayerManager{
		
	private $m_playerList = array(); //玩家队列
	public $_database_manager = null;
	
	public function __construct(){

	}
	
	public function __destruct(){
		echo "PlayerManager __destruct\n";
		$this->DeleteAllInfo();
	}
	public function init($database){
		$this->_database_manager = $database;
	}
	
	public function PlayerIntoGame($playerid) {
		$player = $this->SearchPlayerInfo($playerid);
		if ($player) {
			$player->PlayerJoin();
		}
		else {
			$this->CreatePlayerInfo($playerid);
		}
	}
	
	public function PlayerLeaveGame($playerid) {
		$player = $this->SearchPlayerInfo($playerid);
		if ($player) {
			$player->PlayerLeave();
		}
		else{
			echo 'PlayerLeaveGame not exsit playerid '.$playerid;
		}
	}
	
	public function SearchPlayerInfo($playerid) {
		
		if (!empty($this->m_playerList[$playerid])) {
			return $this->m_playerList[$playerid];
		}
		return null;
	}

	
	public function SavePlayerDB($playerid,$DBIndex,$vProperty) {
		$player = $this->SearchPlayerInfo($playerid);
		if ($player) {
			$player->SavePlayerDB($DBIndex,$vProperty);
		}
		else{
			echo 'SavePlayerDB not exsit playerid '.$playerid;
		}
	}
	
	public function ProcessRequestMessage($aMsg) {
		;
	}
	public function ProcessResponseMessage($aMsg) {
		;
	}
	
	public function Run(){
		
	}

	//处理玩家心跳包
	private function  ConnectionHello($aMsg){
		
	}
	
	

	private function CreatePlayerInfo($playerid) {
		$player = new GamePlayer($playerid);
		$player->InitModule();
		$player->PlayerJoin();
		$this->m_playerList[$playerid] = $player;
	} 
	
	//删除某一个玩家的数据
	private function DeletePlayerInfo($playerid){
		unset($this->m_playerList[$playerid]);
	}
	
	//释放全部资源
	private function DeleteAllInfo(){
		unset($this->m_playerList);
	}
	
	//玩家登录游戏
	private function PlayerLogin($playerid){
		$player = $this->SearchPlayerInfo($playerid);
		if ($player) {
			$player->PlayerJoin();
		}
	}
}

