<?php

require dirname(__FILE__) . '/../base_reader.php';

class techReader extends base_reader{
	
	public function readXLSData(){
		
		$xls_name = self::getDirPath().'/../xlsx/L_GemInfo.xlsx';
		
		$this->parseExcelData($xls_name, array($this, 'readGemInfo'));
	}
	
	protected function readGemInfo($row){
		echo "callback success\n";
		
		$gem_id = $row[0];
		$gem_lv = $row[1];
		$gem_property = $row[2];
		
		echo $gem_id,$gem_lv,$gem_property;
	}
}