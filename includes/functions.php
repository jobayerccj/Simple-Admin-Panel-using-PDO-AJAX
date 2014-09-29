<?php
class File_log
{
	
	private $_FileName;
	
	private $_Data;
	
	public function write($strFileName,$strData)
	{
		
		$this->_FileName = $strFileName;
		
		$this->_Data = $strData;
		
		$this->_CheckPermission();
		
		$this->_CheckData();
		
		$handle = fopen($strFileName,'a+');
		
		fwrite($handle,$strData."\r\n");
		
		fclose($handle);		
		
	}
	
	public function readfile($strFileName)
	{
		
		$this->_FileName = $strFileName;
		
		$this->_CheckExists();
		
		$handle=fopen($strFileName,'r');
		
		return file_get_contents($strFileName);
		
	}
	
	// Check the file permissions
	
	private function _CheckPermission()
	{
		
		if(!is_writable($this->_FileName))
		{
			
			die('Change Your CHMOD permissions to'.$this->_FileName);
			
		}
		
	}
	
	private function _CheckData()
	{
		
		if(strlen($this->_Data)<1)
		{
			
			die('You must have more than one character for data');
			
		}
		
	}
	
	private function _CheckExists()
	{
		
		if(!file_exists($this->_FileName))
		{
			
			die("The File does not Exists");
			
		}
		
	}
	
}
?>
