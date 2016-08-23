<?php
namespace GeneralModule;

use \GeneralModule\Singleton;

class LocalDBModule extends Singleton
{
	public static function getInstance($class_name = __CLASS__){
		return parent::getInstance($class_name);
	}
	
    public function parseXMLConfig($param) 
    {
//         $reader = new XMLReader();   
//         $reader->open($param);   
//         $countElements = 0;   
          
//         while ($reader->read())
//         {   
//                 if($reader->nodeType == XMLReader::ELEMENT){   
//                     $nodeName = $reader->name;   
//                 }   
//                 if($reader->nodeType == XMLReader::TEXT && !empty($nodeName)){   
//                     switch($nodeName){   
//                         case 'name':   
//                             $name = $reader->value;   
//                             break;   
//                         case 'channel':   
//                             $channel = $reader->value;   
//                             break;   
//                         case 'start':   
//                             $start = $reader->value;   
//                             break;   
//                         case 'duration':   
//                             $duration = $reader->value;   
//                             break;   
//                     }   
//                     echo $reader->value; 
//                 }   
//          }   
//         $reader->close();   
    }
}


