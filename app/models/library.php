<?php

class library{
	//properties
	public $books;
	private $path;

	//methods

	public function setPath($path){
	
		$this->path = $path;
	}

	public function getPath(){
	
		return $this->path;
	}
}

?>