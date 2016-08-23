<?php
namespace GeneralModule;

use \GeneralModule\Singleton;

class SaveDBModule extends Singleton
{
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
    public function test(){
        echo "SaveDBModule test";
    }
}


