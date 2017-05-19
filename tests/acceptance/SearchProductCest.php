<?php

use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Annotation\Severity;
use Yandex\Allure\Adapter\Annotation\Description;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Features;



define('NUMBER_OF_COMMENT',           '5000299223017');
define('EXPECTED_RESULT_OF_COMMENTS', 49);
define('EXPECTED_RESULT_OF_RAITING',  5);
define('CURRENT_COURSE_OF_DOLLARS',   26.5);

require_once 'Helpers/ApplicationManager.php';


/**
 * @Features({"Main page"})
 * @Stories({"Search the product"}) 
 */
class SearchProductCest
{
	
	
	/** @var string */
	private $app;
		
	
	public function __construct(){
			
		$this->app = new ApplicationManager();
	}

	public function _before(AcceptanceTester $I)
	{
		
	}

	public function _after(AcceptanceTester $I)
	{
	}

	/**
	 * @Title("Search the product")
	 * @Description("Search the product")
	 * @Severity(level = SeverityLevel::MAJOR)
	 */
	public function SearchTheProduct(AcceptanceTester $I)
	{
		$this->SearchTheProductTest($I);
	}
	
		
	private function SearchTheProductTest(AcceptanceTester $I){
		
		$I->wantTo('search the product');
		
		$I->amOnPage('/');
		
		$this->app->getMainPageHelper()->typeSearchData($I, NUMBER_OF_COMMENT);
		
		$this->app->getMainPageHelper()->clickSearchButton($I);
		
		$I->seeElement('//div[@data-location = "ProductPage"]',    ['class' => 'detail-main-col-inner']);  // checking product page
		
		$text 			   = $I->grabTextFrom('//h1[@itemprop="name"]');         // get 'Ром Captain Morgan Spiced Gold 0.7 л 35% (5000299223017)'
		$counterOfComments = $I->grabTextFrom('//*[@name = "comments"]//span');  // get counter of comments
		$raiting           = $I->grabAttributeFrom('//div[@data-location = "ProductPage"]//span[@class="g-rating-stars-i-medium"]', 'style');  // get raiting
		$price             = $I->grabTextFrom('//span[@id="price_label"]');      // get price in UAH
				
		$I->see($text);              //  Compare ->  'Ром Captain Morgan Spiced Gold 0.7 л 35% (5000299223017)'
		$I->see($counterOfComments); //  Counter of comments
				
		$raiting = trim(substr(substr(strrchr($raiting, ":"), 1), 0, -1));  // get raiting as '%'
		
		echo $price  . CURRENT_COURSE_OF_DOLLARS; //  print price in USD
		
		\PHPUnit_Framework_Assert::assertEquals($raiting / 20,       EXPECTED_RESULT_OF_RAITING);  // checking raiting as 'Star'
		\PHPUnit_Framework_Assert::assertEquals($counterOfComments,  EXPECTED_RESULT_OF_COMMENTS); // checking counter of comment
			
	}
	
	
}