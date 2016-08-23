<?php

namespace SinglePlayer\ManagerModule;

class GamePlayer {
	
	public function __construct($playerid) {
		$this->_playID = $playerid;
	}
	
	public function __destruct() {
		echo 'GamePlayer __destruct';
	}
	
	public function Run() {
		echo 'GamePlayer Running...';;
	}
	

	//初始化数据
	public function InitModule(){
		echo 'GamePlayer InitModule..';
	}
	
	//玩家登录
	public function PlayerJoin(){
		echo 'PlayerJoin game'.$this->_playID;
	}
	//玩家离开
	public function PlayerLeave(){
		echo 'PlayerLeave game'.$this->_playID;
	}
	
	public function ProcessRequestMessage($aMsg){
		
	}
	public function ProcessResponseMessage($aMsg){
		
	}

	public function SaveDB($DBIndex,$vProperty){
		
	}
	
	public function testinit(){
		
		$count = 100;
		while($count > 1){
			$hero = array(
						"id" => 10000,
						"level" => 1000,
						"exp"=>1000000,
						"weapon"=>array(
							"slot1" => 100001,
							"slot2" => 100001,
							"slot3" => 100001,
							"slot4" => 100001,
							"slot5" => 100001,
							"slot6" => 100001,
						),
					);
			
			array_push($this->_hero, $hero);
		}
		
		$goods_count = 1000;
		while ($goods_count > 1){
			$good_id = $goods_count;
			$this->_storage[$good_id] = 100;
			$this->_technical[$good_id] = 100;
			$this->_buildings[$good_id] = 30;
			
			$timer = array(
					"timerid" => 1,
					"type" => 1,
					"bufferid" => 1,
					"seconds" => 10000000,
			);
			array_push($this->_timerqueues, $timer);
			
			$this->_soldier[$good_id] = 1000000;
			
			$task = array(
					"taskid" => 1,
					"type" => 1,
					"target" => array(
							"targetid" => 1,
							"progress" => 1,
							"claimed" => 1,
					),
					"seconds" => 10000000,
			);
			array_push($this->_task, $task);
		}
	}
	
	private $_playID = 10000001;
	private $_level = 200;
	private $_exp = 1000000000;
	private $_gold = 100000000;
	private $_name = "kobenini00000000001";
	private $_food = 1000000000;
	private $_stone = 100000000;
	private $_iron = 100000000;
	private $_wood = 100000000;
	
	private $_hero = array();
	private $_storage = array();
	private $_technical = array();
	private $_buildings = array();
	private $_timerqueues = array();
	private $_soldier = array();
	private $_task = array();
}

?>