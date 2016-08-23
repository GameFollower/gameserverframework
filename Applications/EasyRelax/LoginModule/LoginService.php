<?php

namespace LoginModule;

use \GeneralModule\Singleton;
use \LoginModule\LoginLogic;


class LoginService extends Singleton{
	
	private $login_logic = null;
	
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	
	public function __construct(){
	        echo "LoginService __construct\n";
		$this->login_logic = new LoginLogic();
		$this->login_logic->Initialize();
	}
	
	//处理玩家登陆校验，账号有效性等校验
	public function ProcessCMDRequest($client_id,$message){
		$this->login_logic->clientLogin($client_id,$message);
	}
	
	public function Run(){
		echo "LoginService Running\n";
		$this->login_logic->refreshBlockList();
		$this->login_logic->kickOffBlockPlayers();
	}
	
}
