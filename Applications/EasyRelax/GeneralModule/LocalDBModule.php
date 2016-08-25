<?php
namespace GeneralModule;

use \GeneralModule\Singleton;
use \LocalDataMgr\techModule\techMgr;

class LocalDBModule extends Singleton
{
	private $_techmgr = null;
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	
	public function __destruct(){
		echo "LocalDBModule __destruct\n";
	}
	
	public function Initialize(){
		//初始化全局单例模块  各个模块excel reader
		echo "LocalDBModule Initialize\n";
		$this->_techmgr = new techMgr();
	}
	
	public function Unitialize(){
		echo "LocalDBModule Unitialize\n";
	}
	
}


