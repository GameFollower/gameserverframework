<?php

namespace LocalDataMgr\techModule;

use \LocalDataMgr\techModule\techReader;

class techMgr{
	
	private $_tech_db_reader = null;
	function __construct(){
		$this->Initialize();
	}
	
	public function Initialize(){
		$this->_tech_db_reader = new techReader($this);
		$this->_tech_db_reader->readXLSData();
	}
}