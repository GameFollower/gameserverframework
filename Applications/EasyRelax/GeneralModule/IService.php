<?php

namespace GeneralModule;

use \GeneralModule\Singleton;
use \GatewayWorker\Lib\Gateway;

class IService extends Singleton{
	
	private $player_id_to_client_id = array();
	
	private $player_id_to_token_id = array();
	private $client_id_to_player_id = array();
	
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	
	public function SetClientIDTokenPlayerID($client_id,$token,$player_id)
	{
		$this->player_id_to_token_id[$player_id] = $token;
		
		$this->player_id_to_client_id[$player_id] = $client_id;
		$this->client_id_to_player_id[$client_id] = $player_id;
	}
	
	public function ClientOnClose($client_id)
	{
		if(!empty($this->client_id_to_player_id[$client_id])){
			$player_id = $this->client_id_to_player_id[$client_id];
			$this->player_id_to_client_id[$player_id] = null;
			$this->client_id_to_player_id[$client_id] = null;
		}
	}
	
	public function GetPlayerIDWithToken($token)
	{
		if (isset($this->player_id_to_token_id[$token])) {
			return $this->player_id_to_token_id[$token];
		}
		return 0;
	}
	
	public function ResponseMsg($player_id,$message)
	{
		$client_id = $this->GetClientIDWithPlayerID($player_id);
		Gateway::sendToClient($client_id, $message);
	}
	
	public function BroadcastMsg($message)
	{
		Gateway::sendToAll($message);
	}
	
	public function KickOffPlayerConnect($player_id)
	{
	        $client_id = $this->GetClientIDWithPlayerID($player_id);
	        Gateway::closeClient($client_id);
	}
	
	private function GetClientIDWithPlayerID($player_id)
	{
		if (isset($this->player_id_to_client_id[$player_id])) {
			return $this->player_id_to_client_id[$player_id];
		}
		return 0;
	}
}
