<?php

namespace GeneralModule;

use \GeneralModule\Singleton;
// use redis;
require_once 'database.class.php';
require_once 'RedisCluster.php';

class DBManager extends Singleton{
	
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	// 数据库实例1
	protected  static $_account_db = null;
	protected  static $_game_db = null;
	protected  static $_redis_db = null;
	
	private static $account_db_config = array(
			'host'    => '127.0.0.1',
			'port'    => 3306,
			'user'    => 'root',
			'password' => '123',
			'dbname'  => 'GameAccount1000',
			'charset'    => 'utf8',
	);
	
	// 数据库实例2
	private static $game_db_config = array(
			'host'    => '127.0.0.1',
			'port'    => 3306,
			'user'    => 'root',
			'password' => '123',
			'dbname'  => 'GameData1000',
			'charset'    => 'utf8',
	);
	
	// redis数据库实例
	private static $redis_db_config = array(
			'host'    => '127.0.0.1',
			'port'    => 6379,
	);
	
	public function __construct(){
		echo "DBManager __construct\n";
		$this->initDBModule();
	}
	
	public function __destruct(){
		echo "DBManager __destruct\n";
	}
	
	private function initDBModule(){
		
		if (self::$_account_db == null) {
			self::$_account_db = new Database(self::$account_db_config['host'], self::$account_db_config['user'],
					self::$account_db_config['password'], self::$account_db_config['dbname']);
			self::$_game_db = new Database(self::$game_db_config['host'], self::$game_db_config['user'],
					self::$game_db_config['password'], self::$game_db_config['dbname']);
	                
// 	        self::$_redis_db = new redis();
// 	        $result = self::$_redis_db->connect(self::$redis_db_config['host'], self::$redis_db_config['port']);
			self::$_redis_db = new RedisCluster();
			self::$_redis_db->connect(self::$redis_db_config, false);
		}
	}
	
	public static function getAccountDB(){
		return self::$_account_db;
	}
	public static function getGameDB(){
		return self::$_game_db;
	}
	public static function getRedisDB(){
	    return self::$_redis_db;
	}
}




