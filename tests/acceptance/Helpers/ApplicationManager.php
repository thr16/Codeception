<?php

require_once 'MainPage.php';

class ApplicationManager{
	
	private $mainPage;
	
	public function __construct(){
		 
		$this->mainPage = new MainPage();
	}
		
	public function getMainPageHelper(){
		return $this->mainPage;
	}
	
}