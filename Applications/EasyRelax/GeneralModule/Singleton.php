<?php

namespace GeneralModule;

abstract  class  Singleton
{
	private  static $instances = array();
	
	public static function getInstance($class_name = __CLASS__){
		if (isset(self::$instances[$class_name])) {
			return self::$instances[$class_name];
		}else{
			$instance = self::$instances[$class_name] = new $class_name(null);
			return $instance;
		}
	}
	private function __construct(){

	}
	private  function __clone(){

	}
}
