<?php

namespace LoginModule;

use \GeneralModule\SERVER_INI;
use \GeneralModule\GAME_CMD;
use \GeneralModule\DBManager;
use \GeneralModule\IService;

class LoginLogic{
	
	private $block_id_list = array();

	public function Initialize(){
		$this->refreshBlockList();
	}
	
	public function refreshBlockList(){
		$this->block_id_list = DBManager::getInstance()->getAccountDB()->getAll("select PlayerID from block_users");
		//var_dump($this->block_id_list);
	}
	
	public function kickOffBlockPlayers(){
	        foreach ($this->block_id_list as $value){
	                IService::getInstance()->KickOffPlayerConnect($value['PlayerID']);
	        }
	}
	
	public function isBlockID($player_id){
	        foreach ($this->block_id_list as $value){
	                if($player_id == $value['PlayerID']){
	                        return true;
	                }
	        }
		return false;
	}
	
	public function clientLogin($client_id,$message){
		$token = $message['token']; //唯一识别码，广告id或者gamecenter id等
		if (isset($token)) {
			$player_id = $this->checkLoginUserInfo($client_id,$token);
                        
			$response_message = array();
			$response_message["cmd"] = GAME_CMD::CMD_GAME_LOGIN;
			$response_message["action"] = GAME_CMD::STC_ACTION_LOGIN;
			$response_message["result"] = GAME_CMD::CMD_RESPONSE_SUCCESS;
			
			if($this->isBlockID($player_id)){
			        $response_message["result"] = GAME_CMD::CMD_RESPONSE_FAILED;
			        $response_message["error_code"] = GAME_CMD::ERROR_BLOCK_USER;
			}
			$response_message = json_encode($response_message);

                        IService::getInstance()->SetClientIDTokenPlayerID($client_id,$token,$player_id);
			IService::getInstance()->ResponseMsg($player_id,$response_message);
		}
	}
	
	public function checkLoginUserInfo($client_id,$token){
		$player_id = IService::getInstance()->GetPlayerIDWithToken($token);;
		if($player_id == 0)
		{
			//查看数据库，没找到则新建一个号
			$player_id = $this->queryUserInfo($token);
			if($player_id == 0){
				$player_id = $this->createUser($token);
			}
		}
		echo "checkLoginUserInfo".$player_id;
		return $player_id;
	}
	
	private function queryUserInfo($account){
		$result = DBManager::getInstance()->getAccountDB()->getOne("select id,account from  user where account='".$account."'");
		if (isset($result)) {
		        return $result['id'];
		}
		return 0;
	}
	
	private function createUser($token){
		//超过单服最高注册上限 返回0，客户端根据返回值做出反应
		$register_account_count = $this->queryPlayerIDIndex();
		
		if(SERVER_INI::SERVER_PLAYER_MAX_COUNT <= $register_account_count)
			return 0;
		
		echo "createUser account = ".$token." player_id = ".$player_id;
		
		$player_id = SERVER_INI::SERVER_PLAYER_ID_INDEX + $register_account_count;
		$data = array(
					'id'    => $player_id,
					'account'     => $token,
				);
		DBManager::getInstance()->getAccountDB()->insert('user', $data);
		return $player_id;
	}

	
	private function queryPlayerIDIndex(){
		//if($this->cur_player_id_index == 0){
		//	//查询数据库注册个数
		//	$account_count = DBManager::getInstance()->getAccountDB()->getOne("select count(*) from  user");
		//	if(is_array($account_count))
		//	        $this->cur_player_id_index = $account_count["count(*)"];
		//	echo $this->cur_player_id_index;
		//}
				
		$key = SERVER_INI::SERVER_INDEX.'_PLAYER_INDEX';
		$index = DBManager::getInstance()->getRedisDB()->get($key);
		if(!is_bool($index)){
		        $index = DBManager::getInstance()->getRedisDB()->incr($key);
		}else{
		        DBManager::getInstance()->getRedisDB()->setnx($key,0);
		}
		echo "LoginLogic queryPlayerIDIndex index=$index\n";
		return $index;
		
	}
	
}
