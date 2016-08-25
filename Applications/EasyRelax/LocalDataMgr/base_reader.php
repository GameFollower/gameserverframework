<?php

// namespace LocalDataMgr;

require_once dirname(__FILE__) . '/../Lib/PHPExcel/Classes/PHPExcel.php';

// use Exception;

class base_reader{
	
	private static $_php_excel_reader = null;
	protected static $_dir_path = null;
	protected  $_mgr = null;
	
	private static function getExcelReader(){
		if (self::$_php_excel_reader == null) {
			$type = 'Excel2007';
			self::$_php_excel_reader = PHPExcel_IOFactory::createReader($type);
			self::$_php_excel_reader->setReadDataOnly(true);
			self::$_php_excel_reader->setLoadSheetsOnly(true);
		}
		return self::$_php_excel_reader;
	}
	
	protected static function  getDirPath(){
		if (self::$_dir_path == null) {
			self::$_dir_path = dirname( __FILE__);
		}
		return self::$_dir_path;
	}
	
	protected function parseExcelData($file_path,$call_back){
		
		$sheets = self::getExcelReader()->load($file_path);
		$dataArray = $sheets->getSheet(0)->toArray();
		
		if (is_array($dataArray) && count($dataArray) > 1) {
			unset($dataArray[0]);//剔除excel列名项
			foreach ($dataArray as $value){
				call_user_func($call_back, $value);
			}
		}
	}
	
	function __construct($mgr){
		$this->_mgr = $mgr;
	}
}


