<?php

/**
* 
*/
class locationCLassTest extends PHPUnit_Framework_TestCase
{
	//initialise location class.
	public function setUp(){

		$this->locationClass = new LocationClass();
	}

	//get Locations for an exsiting tour, to prefrom the following test, tour code should exsits.
	public function getLocationTest(){
		$results = $this->locationClass->getLocation('TOR124');
		$this->assertNotEmpty($stack);

	}

	//insert array of locations for a tour, to prefrom the following test, the locaitons code should exsits.
	public function insertLocationsTest(){

		$results = $this->locationClass->insertLocations('TOR124',array('1','2','3'));
		$this->assertEquals(true,$results);

	}

	//delete array of locations, to prefrom the following test, the locaitons code should exsits.
	public function deleteLocationsTest(){

		$locationArrays = array('1','2','3');

		$results = $this->locationClass->deleteLocations($locationArrays,$dbconn);
		$this->assertEquals(true,$results);

	}

    public function editLocaitonNameTest(){

		$results = $this->locationClass->editLocaitonName('LocationNewNameTest', '4',$dbconn);
		$this->assertEquals(true,$results);

	}




}



?>