<?php

class MainPage{
		
	
	public function typeSearchData(AcceptanceTester $I, $firstName){
		$I->fillField('//input[@name = "text"]', $firstName);
	}
		
	
	public function clickSearchButton(AcceptanceTester $I){
		$I->click('//button[@name = "rz-search-button"]');
	}
	
		
}