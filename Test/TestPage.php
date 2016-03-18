<?php

require 'UnitTest/phpunit-5.2.12.phar';
require 'database/Classes/TourClass.php';

/**
* 
*/
class ClassName extends PHPUnit_FrameWork_TestCase
{

	public function TestTourCalssInsertTour(){


		$tour = new TourClass();

		$expected = ture;

		$this->assertEquals($expected,$tour->insertTour('TORTEST','TOURNAME','00-00-0000','Username'));
	}
}





?>